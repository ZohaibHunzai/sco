<?php

namespace backend\modules\cash\models;

use Yii;
use \backend\modules\cash\models\base\SupplierPayment as BaseSupplierPayment;

/**
 * This is the model class for table "supplier_payments".
 */
class SupplierPayment extends BaseSupplierPayment
{
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date', 'amount', 'supplier_id'], 'required'],
            [['date', 'created_at', 'updated_at'], 'safe'],
            [['amount'], 'number'],
            [['supplier_id', 'created_by', 'updated_by', 'transaction_group'], 'integer'],
            ['status', 'default', 'value' => 1]
        ];
    }
    
     /**
     * accounts transaction for the payment.
     * @author Ejoo
     * @return boolean
     * @throws Execption
     */
    
    public function transaction()
    {
        try {
            $group =  Yii::$app->t->entry([
                'dr' => 40066, # that's cash in hand account
                'cr' => 15001, # that's cash receiveables account
                'amount' => $this->amount,
                'branch_id' => 1,
            ]);

           
            $this->transaction_group = $group;

            return true;

        } catch (Exception $e) {
            $this->addError("amount", "There was problem posting accounts transaction. Please consult developer.");
        }
    }	
}
