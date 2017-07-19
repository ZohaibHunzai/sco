<?php

namespace backend\modules\payments\models;

use Yii;
use \backend\modules\payments\models\base\Payment as BasePayment;
use backend\modules\sales\models\Sale;
/**
 * This is the model class for table "payments".
 */
class Payment extends BasePayment
{
    const CASH = 10;
    const CREDIT = 11;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['customer_id', 'payment_date', 'payment_type_id', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'required'],
            [['invoice_id', 'customer_id', 'payment_type_id', 'created_by', 'updated_by'], 'integer'],
            [['payment_date', 'created_at', 'updated_at'], 'safe'],
            ['invoice_id', 'default', 'value' => NULL],
        ];
    }
	public static function getPaymentTypes()
    {
        return [
            self::CASH => 'Cash',
            // self::CREDIT => 'Credit',
        ];  
    }   

    public function getToString()
    {
        return $this->payment_type_id === self::CASH ? "Cash" : "Credit";
    }

    public function getSale()
    {
        return $this->hasOne(Sale::className(), ['payment_id' => 'id']);
    }
}
