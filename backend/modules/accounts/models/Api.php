<?php 
namespace backend\modules\accounts\models;

use League\Flysystem\Exception;
use Yii;
use \backend\modules\accounts\models\Transaction as T;
use yii\base\InvalidParamException;

/**
* 	Api is the class for other parts of the applications to pass transactions
* 	@author Ejoo
*/
class Api extends \yii\base\Component	
{
	/**
	 * Set some constants equal to transactions ones
	 */
	const DR = 'dr';
	const CR  = 'cr';


	/**
	 * API function.
     * ``` Making a transaction
	 * @param $arr array of 
	 * @throws Exception
	 */

	public function entry($arr=[])
    {
        # I'm not serioulsy ready to 
        if(empty($arr) || !isset($arr[self::DR]) || !isset($arr[self::CR])) {
            throw new InvalidParamException("Parameter is invalid" );
        }

        # get debit and credit account(s)
        $debit  =   $arr[self::DR];
        $credit  =   $arr[self::CR];

        if($debit === $credit) {
        	throw new \Exception("There's no way to pass an entry on same accounts");
        	
        }
        # here, if the programmer has issued amount and debit and credit keys with simple 
        # string (account code) we will just pass simple transaction.

        if(isset($arr['amount']) && !is_array($debit) && !is_array($credit)) {

            $accounts = $this->findAccounts([$arr[self::DR], $arr[self::CR]]);
            # if accounts is null or any of the account asked were not found.
            if($accounts === null || !isset($accounts[$debit]) || !isset($accounts[$credit]) ) {
                throw new \Exception("Accounts were not found. Please make sure you have provided account that exists");
            }

            # now accounts are in our hands. Try to get some other information.

            $narration		= 	isset($arr['narration']) ? $arr['narration'] : false;
            $mode 				= 	isset($arr['mode']) ? $arr['mode'] : T::MODE_CASH;
						$last_id 			= 	$this->getLastID();
						$amount 			=		$arr['amount'];
						$debit_acc		=		$accounts[$debit];
						$credit_acc		=		$accounts[$credit];
						// $narration 		= 	isset($arr[''])
						# we would definitely need branch_id or store_id, we will force
						# developer to pass it.

						if(!isset($arr['branch_id'])) {
							throw new \Exception("Brach ID or Store ID must be passed");
						}

						$branch_id 		=		$arr['branch_id'];

						if(!is_numeric($amount)) {
							throw new \Exception("Amount cannot be other than a number (float)");
						}
						
						$t 						= 	new T;

						$dr 						=		$t
														->narration(!$narration ? $this->narration($credit_acc) : $narration)
														->mode($mode)->amount($amount)
														->account($debit_acc->id)
														->debit()
                            ->active()
														->group($last_id + 1)
														->branch($branch_id);

						# now it's credit.
						
						$cr 					=		clone $dr; #that's cloned object, we only need to set credit()
						$cr 					=		$cr->cr()
														->narration(!$narration ? $this->narration($debit_acc) : $narration)
														->account($credit_acc->id);


						# saving those both objects can now give us an entry.
						if($dr->save() && $cr->save()) {
							return $last_id + 1;
						}
					
						return implode("<br>", array_join($dr->getErrors(), $cr->getErrors));

        } else if(is_array($debit) && is_array($credit)){
           
          # Generate group 
          
          // if(empty($debit) || empty($credit)) {
          //   throw new InvalidParamException("Both credit and debit should contain valid accounts");
          // }

          $last_id    =   $this->getLastID();
          $group      =   $last_id++;

          #generate narration
          
          $narration  =   isset($arr['narration']) ? $arr['narration'] : 'System Transaction';
          // $store_id   =   $arr['store_id'];
          $branch_id  =   $arr['branch_id'];
          #generate debits transactions
          

          // debit accounts save.
          $success    =   []; # that is our success models container

          foreach ($debit as $code => $details) {
            $account    =   $this->findAccount($code);

            if($account == null) { # if any of the provided codes doesn't exists.
              
              if(!empty($success)) {
                # if there were few transactions saved, clear them up.
                
                foreach ($success as $m) {
                  $m->delete();
                }
                # empty the success;
                $success = [];
              }

              throw new InvalidParamException("Some of the accounts you provided doesn't exists on DEBIT. Please check the codes");

            }

            #pass the transactions.
            
            $t  = new T;

            $dr =   $t
                    ->narration($narration)
                    ->mode(T::MODE_TRANSFER)
                    ->amount($details['amount'])
                    ->account($account->id)
                    ->debit()
                    ->group($group)
                    ->active()
                    ->branch($branch_id)
                    ->save(false);
            $success[] = $t;

          }

          // credit accounts save.
          $debits = $success;
          $success    =   []; # that is our success models container

          foreach ($credit as $code => $details) {
            $account    =   $this->findAccount($code);

            if($account == null) { # if any of the provided codes doesn't exists.
              
              if(!empty($success)) {
                # if there were few transactions saved, clear them up.
                
                foreach ($success as $m) {
                  $m->delete();
                }
                # empty the success;
                $success = [];
              }

              throw new InvalidParamException("Some of the accounts you provided doesn't exists on CREDIT. Please check the codes");

            }

            #pass the transactions.
            
            $t  = new T;

            $dr =   $t
                    ->narration($narration)
                    ->mode(T::MODE_TRANSFER)
                    ->amount($details['amount'])
                    ->account($account->id)
                    ->cr()
                    ->active()
                    ->group($group)
                    ->branch($branch_id)
                    ->save(false);
            $success[] = $t;
            
          }

          

          return ['dr' => $debits, 'cr' => $success, 'group' => $group];
        }

      return $this;
    }


    /**
     * Finds accounts
     * @param  array  $codes [description]
     * @return [type]        [description]
     */
    private function findAccounts($codes=[])
    {
        # if $codes isn't an array
        if(empty($codes)) {
            throw new InvalidParamException("Invalid parameter issued to findAccounts in Transactions.php");
        }

        $accounts = Account::find()->indexBy('code')->where(['code' => $codes])->all();

        if(empty($accounts)) {
            return null;
        }

        return $accounts;


    }


    private function findAccount($code)
    {
      if(!$code) {
        throw new InvalidParamException("Invalid param ID issued");
        
      }

      return Account::findOne(['code' => $code]);
    }

    /**
     * Get ID of the last transaction inserted in the database.
     */
    
    private function getLastID()
    {
    	$t = T::find()->orderBy('id DESC')->select('id')->one();
    	return $t ? $t->id : 0;
    }

    private function narration($account)
    {
    	return "System Transaction against account: " . $account->name;
    }

  /**
   * Simple update transaction API
   * @param $group
   * @param $amount
   * @return boolean
   */
    public function updateTransaction($group, $amount) {
      if($group === null) {
        throw new InvalidParamException("No group number is provided.");
      }


    }


    /**
     * Delete transaction
     * @param integer $group
     * @return boolean
     */

    public function delByGroup($group)
    {

      if($group === null) {
        throw new \Exception("Invalid Paramter");
      }

      $sql = "UPDATE `transactions` set status='0' WHERE `group`='$group'";

      return Yii::$app->db->createCommand($sql)->execute();
    }


}