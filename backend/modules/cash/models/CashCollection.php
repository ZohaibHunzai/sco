<?php

namespace backend\modules\cash\models;

use Yii;
use \backend\modules\cash\models\base\CashCollection as BaseCashCollection;
use yii\helpers\ArrayHelper;
use backend\modules\accounts\models\AccGroup;
/**
 * This is the model class for table "cash_collections".
 */
class CashCollection extends BaseCashCollection
{
    
    /**
     * @inheritdoc
     */
    const STATUS_ACTIVE = 1;

    const TYPE_CASH = 20;
    const TYPE_BANK = 30;

    /**
     * 
     * @var $bank_account A debit bank account This is optional, user can either press on cash or bank.
     * @var $narration to store information of the transaction.
     */
    public $bank_account;
    public $narration;


    /**
     * Rules
     */
    public function rules()
    {
        return [
            ['amount', 'required'],
            [['customer_id', 'sales_person_id', 'created_by', 'updated_by', 'status', 'sale_id'], 'integer'],
            [['date', 'created_at', 'updated_at', 'bank_account', 'narration', 'type'], 'safe'],
            [['amount'], 'number'],
            [['amount'], 'validateAmount'],
            ['transaction_group', 'integer'],
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['transaction_group', 'integer'],
            // ['transaction_group', 'processTransaction'],
        ];
    }
	
    public function getCustomer()
    {
        return $this->hasOne("\backend\modules\customers\models\Customer", ['id' => 'customer_id']);
    }

    public function validateAmount($attr, $value)
    {

        if($this->customer->balance < $this->amount) {
            $this->addError($attr, "Amount received is greater than balance.");
        }
    }

    /**
     * Accounts entry. This function updates bills receiveables and cash in hand account
     * @return [type] [description]
     */
    public function processTransaction()
    {

        try {
            $dr = $this->type == self::TYPE_BANK && $this->bank_account ?  $this->bank_account : 15001;
            $narration = $this->type == self::TYPE_BANK && $this->narration ? $this->narration : null;
            $group =  Yii::$app->t->entry([
                'dr' => $dr, # that's cash in hand account
                'cr' => 15060, # that's cash receiveables account
                'amount' => $this->amount,
                'branch_id' => 1,
                'narration' => $narration,
            ]);

           
            $this->transaction_group = $group;
            return true;

        } catch (Exception $e) {
            $this->addError("amount", "There was problem posting accounts transaction. Please consult developer.");
        }
    }

    /**
     * Get types of the cash collection.
     * There could be only two type of cash collections: cash or bank
     * @return array
     */
    public static function getTypes()
    {
        return [
            self::TYPE_CASH => "Cash Collection",
            self::TYPE_BANK => "Bank Collection",
        ];
    }

    public function getBankAccounts()
    {
        # that's bank accounts
        return ArrayHelper::map(AccGroup::findOne(['code' => 10])->mainAccounts, 'code', 'name');
    }

    /**
     * Get transactions
     * @return array
     */
    public function getTransactions()
    {
        return $this->hasMany('\backend\modules\accounts\models\Transaction', ['group' => 'transaction_group']);
    }

    public static function customerIDs()
    {
        $all = self::find()->all();
        $result = [];

        foreach ($all as $_) {
            $result[]  = $_->customer_id;
        }

       return $result;
    }


   public function getStudents()
   {
       return [
        'seema',
        'amjad',
        'sabirah',
        'zahid',
        'naeem',
        'etcetra'
       ];
   }

   
}
