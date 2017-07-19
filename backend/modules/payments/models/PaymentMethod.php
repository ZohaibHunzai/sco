<?php

namespace backend\modules\payments\models;

use Yii;
use \backend\modules\payments\models\base\PaymentMethod as BasePaymentMethod;

/**
 * This is the model class for table "payment_methods".
 */
class PaymentMethod extends BasePaymentMethod
{
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 128]
        ];
    }
	
}
