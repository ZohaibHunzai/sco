<?php

namespace backend\modules\customers\models;

use Yii;
use \backend\modules\customers\models\base\Customer as BaseCustomer;
use \backend\modules\payments\models\Payment;
use \backend\modules\customers\models\Customer;
use \backend\modules\sales\models\Sale;

/**
 * This is the model class for table "customers".
 * @author Ejoo <ejazkarimhunzai@gmail.com
 */
class Customer extends BaseCustomer
{
    
    /**
     * @inheritdoc
     */

    const TYPE_REGULAR = 1;
    const TYPE_VISITOR = 2;
    public function rules()
    {
        return [
            [['name', 'address', 'type', 'town_id', 'region_id', 'opening_balance', 'sales_person_id'], 'required'],
            [['type'], 'integer'],
            ['email', 'email'],
            [['name', 'email'], 'string', 'max' => 128],
            [['phone_no', 'mobile_no'], 'string', 'max' => 14],
            [['address'], 'string', 'max' => 1000],
            [['cnic'], 'string', 'max' => 20]
        ];
    }

    /**
     * Types of the customer for dropdowns
     * @return array
     */
    public function getTypes()
    {
        return [
            self::TYPE_VISITOR => "Visitor",
            self::TYPE_REGULAR => "Regular",
        ];
    }
	
    public function getSales()
    {
        return $this->hasMany(Sale::className(), ['customer_id' => 'id']);
    }

    public function getPayments()
    {
        return $this->hasMany(Payment::className(), ['id' => 'payment_id'])
                ->viaTable('sales', ['customer_id' => 'id']);
    }

    public function getCreditSales()
    {
        return $this->hasMany(Payment::className(), ['id' => 'payment_id'])
                ->via('sales')->joinWith('sale')->andWhere(['sales.status' => 1])->sum('remaining');
    }

    public function getSalesReturnTotal()
    {
        return $this->hasMany(Payment::className(), ['id' => 'payment_id'])
                ->viaTable('sales', ['customer_id' => 'id'])->sum('sales_return');
    }



    public function getCashSales()
    {
        return $this->hasMany(Payment::className(), ['id' => 'payment_id'])
                ->via('sales')->joinWith('sale')->andWhere(['sales.status' => 1])->sum('received');
    }

    public function getTown()
    {
        return $this->hasOne("\backend\modules\init\models\Town", ['id' => 'town_id']);
    }

    public function getPerson()
    {
        return $this->hasOne("\common\models\User", ['id' => 'sales_person_id']);
    }

    public function getBalance()
    {
        return ($this->opening_balance + $this->creditSales ) - $this->salesReturnTotal - $this->received;
    }

    public static function asSalesOptions()
    {
        $all = self::find()->all();

        $result = [];

        foreach ($all as $customer) {
            $result[$customer->id] = ucwords($customer->name) . " ({$customer->balance})";
        }

        return $result;
    }

    public function getReceived()
    {
        return $this->hasMany("\backend\modules\cash\models\CashCollection", ['customer_id' => 'id'])->where(['status' => 1])->sum('amount');
    }

    public function getReturned()
    {
        return $this->salesReturnTotal;
    }

    public function getCollections()
    {
        return $this->hasMany(\backend\modules\cash\models\CashCollection::className(), [
            'customer_id' => 'id',
        ]);
    }
}
