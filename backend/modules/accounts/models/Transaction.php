<?php

namespace backend\modules\accounts\models;

use Yii;
use \backend\modules\accounts\models\base\Transaction as BaseTransaction;
use \backend\modules\accounts\models\Account;
use \backend\modules\accounts\models\AccountSetting;
use yii\base\InvalidParamException;
/**
 * This is the model class for table "transactions".
 */
class Transaction extends BaseTransaction
{
    
    /** Transaction mode CONSTANTS **/
    const MODE_CASH = 1;
    const MODE_TRANSFER = 2;

    /** DEBIT AND CREDIT COSNTANTS **/
    const DBT = 10;
    const CR = 20;


    public $use_in_api = false;


    public $target_account;
   
    /**
     * @var $integer tranfser account id
     */
    
    public $transfer_account_id;
    public $transfer_narration;
    public $transfer_amount;
    

    /**
     * @var Account instance of current account
     */
    private $_account;



    /** EVENT CONSTANTS **/

    
    /**
     * @inheritdoc
     */

    public function rules()
    {
        return [
            [['account_id', 'amount', 'mode', 'type', 'account_id'], 'required'],
            [['status', 'account_id', 'created_by', 'updated_by', 'deleted_by', 'mode', 'type', 'approved_by', 'group', 'target_account'], 'integer'],
            [['created_at', 'updated_at', 'deleted_at', 'approved_at', 'transfer_narration'], 'safe'],
            [['name', 'narration'], 'string', 'max' => 255],
            [['amount', 'branch_id'], 'number'],

            # rules for Transfers

            [['transfer_amount', 'transfer_account_id'], 'required', 
                'when' => function($model) {
                    return $model->mode == self::MODE_TRANSFER && $model->use_in_api === true;
                }, 
                'whenClient' => "function(attribute, value){
                    return $('#transaction-mode').val() == " . self::MODE_TRANSFER . ";
                }",

            ],

            # branch_id needs to exist in the table stores.

            // ['branch_id', 'exist', 'targetClass' => '\backend\modules\init\models\Store', 'targetAttribute'=> 'id'],

            ['status', 'default', 'value' => 1], #that's active.
        ];
    }
	
    /**
     * Transaction mode types
     */

    public function getModes()
    {
        return [
            self::MODE_CASH => "Cash",
            self::MODE_TRANSFER => "Transfer",
        ];
    }

    /**
     * Types
     */

    public function getTypes()
    {
        return [
            self::DBT => "Debit",
            self::CR => "Credit",
        ];
    }


    /**
     * Transaction create API
     */

    public function create()
    {
        # code...
    }



    /**
     * helper functions
     */

    public function debit()
    {
        $this->type = self::DBT;
        return $this;
    }

    public function cr()
    {
        $this->type = self::CR;
        return $this;
    }
    /**
     * Set narration of an account. 
     * @param string|boolean if string provided will use it as a narration. If set to false
     * @return $this
     */
    public function narration($str=false)
    {

       
        if($str === false) { # auto generate

            

            if($this->mode == self::MODE_TRANSFER) {
                $this->narration = "By Transfer: ";
            }


            $this->narration .= "Account #" . $this->getAccount2()->code . " ";
            if($this->type == self::CR) {
                $this->narration .= "is being Credited with amount ". $this->amount;
            } else {
                $this->narration .= "is being Debited with amount ". $this->amount;

            }


            # set against account.
            if($this->target_account != null) {
                $target_account = Account::findOne($this->target_account);
                $this->narration .= " against " . $target_account->name;
            } 


            return $this;
        }



        $this->narration = $str;
        return $this;
    }


  

    public function getAccount2()
    {
        $this->_account =  $this->_account ? : Account::findOne($this->account_id);
        return $this->_account;
    }


    /**
     * @inheritdoc
     */

    public function beforeSave($param)
    {
        parent::beforeSave($param);

        # if no narration, generate automatically.
        if( $this->isNewRecord) {
            if($this->narration == '') {
                $this->narration(false);
            }
        }

        return true; 
    }

    /**
     * @inheritdoc
     */

    public function beforeValidate()
    {
        parent::beforeValidate();

        if($this->mode == self::MODE_CASH) {
            $this->target_account = AccountSetting::getAccount(1111);
        }

        return true;
    }

    /**
     * The next entry of the transaction.
     * @return boolean
     */
    public function nextTransaction()
    {

        $model = new static;
        $model->account_id = $this->mode == self::MODE_CASH ? $this->target_account : $this->transfer_account_id;
        $model->amount = $this->mode == self::MODE_CASH ? $this->amount : $this->transfer_amount;
        $model->mode = $this->mode;
        $model->target_account = $this->account_id;
        $model->type = $this->type == self::DBT ? self::CR : self::DBT;
        $model->narration(false);



        if( $model->save(false)) {
            
            
            
            $this->group = $this->id;
            $model->group = $this->id;

            if($this->id == null) {
                $model->group = $model->id;
                $this->group = $model->group;
            }

            if($this->id == null) {
                $model->update(['group']);
            } else {
                $this->update(['group']);
                $model->update(['group']);
            }


            return true;
        } 

        # rollback transaction.
        $model->delete();
        $this->delete();

        # add error.
        $this->addError("account_id", "Coundn't complete the transaction.");
        return false;
    }


    /** RELATIONSHIPS STARTS HERE **/

    /**
     * Relationship with Account. 
     * @return Account
     */
    public function getAccount()
    {
        return $this->hasOne(Account::className(),['id' => 'account_id']);
    }

    /**
     * Processes transactions. This makes sure to record 
     * correct order of transactions.*
     * @return boolean
     */

    public function processTransactions()
    {
        if( $this->type == self::CR) {
            return $this->nextTransaction() && $this->save();
        } else {
            return $this->save() && $this->nextTransaction();
        }
    }
    /**
    * the function is created for to manage accounts againts sale/inventory/other hits
    * @author zohaib 
    * @return arrayObject[]
    */
    public static function entry($data)
    {
        
        if ($data === null|| $data === '' || $data === false) {
            return false;
        }
        else{
            $debits_acc                      = $data[self::DBT];
            $credit_acc                      = $data[self::CR];
            $acc_id                    = Account::find()->select(['id'])->
                                         where(['code'=>$debits_acc['code']])->one();
            $debit_transaction               = new Transaction();
            $debit_transaction->name         = $debits_acc['acc_name'];
            $debit_transaction->narration    = 'Account bieng debited by: '.$debits_acc['acc_name'].' and Credited by: '.$credit_acc['acc_name'];

            $debit_transaction->status       = $debits_acc['status'];
            $debit_transaction->account_id   = $acc_id->id;
            $debit_transaction->mode         = $debits_acc['mode'];
            $debit_transaction->type         = self::DBT;
            $debit_transaction->amount       = $debits_acc['amount'];
            $debit_transaction->save();
            

            /**
            * now this code is for to save credit data in transaction
            */
            $credit_acc_id              = Account::find()->select(['id'])->
                                         where(['code'=>$credit_acc['code']])->one();
            $credit_transaction                = new Transaction();
            $credit_transaction->name          = $credit_acc['acc_name'];
            $credit_transaction->narration     = 'Account bieng Credited by: '.$credit_acc['acc_name'].$credit_acc['code'].'and Debited by: '.$debits_acc['acc_name'].$debits_acc['code'];

            $credit_transaction->status        = $credit_acc['status'];
            $credit_transaction->account_id    = $credit_acc_id->id;
            $credit_transaction->mode          = $credit_acc['mode'];
            $credit_transaction->type          = self::CR;
            $credit_transaction->amount        = $credit_acc['amount'];
            $credit_transaction->save();

        }
    }
    
    
    public function mode($mode)
    {
        $this->mode = $mode;

        return $this;
    }

    public function branch($branch)
    {
        $this->branch_id = $branch;
        return $this;
    }

    public function amount($amount) {
        $this->amount = $amount;
        return $this;
    }

    public function account($account)
    {
        $this->account_id = $account;
        return $this;
    }

    public function group($group)
    {
        $this->group = $group;
        return $this;
    }
    
    public function active()
    {
        $this->status = 1;
        return $this;
    }

}
