<?php

namespace backend\modules\supplier\models;

use Yii;
use \backend\modules\supplier\models\base\Supplier as BaseSupplier;

/**
 * This is the model class for table "suppliers".
 */
class Supplier extends BaseSupplier
{
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            ['email', 'email'],
            ['credit_limit', 'safe'],
            [['name', 'email', 'fax_number'], 'string', 'max' => 128],
            [['phone_no', 'mobile_no'], 'string', 'max' => 14],
            [['address'], 'string', 'max' => 1000],
            ['opening_balance', 'number'],
        ];
    }
	

    public function getPayments()
    {
        return $this->hasMany("\backend\modules\cash\models\SupplierPayment", ['supplier_id' => 'id'])->sum('amount');
    }

    public function getBalance()
    {
        return ($this->opening_balance + $this->totalPurchases) - $this->payments;
    }

    public function getPurchases()
    {
        return $this->hasMany("\backend\modules\purchases\models\Purchase", ['supplier_id' => 'id']);
    }

    public function getTotalPurchases()
    {
        return $this->getPurchases()->sum("grand_total");
    }
}
