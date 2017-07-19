<?php

namespace backend\modules\sales\models;

use Yii;
use \backend\modules\sales\models\base\Sale as BaseSale;
use \backend\modules\payments\models\Payment;
use \backend\modules\product\models\Product;
/**
 * This is the model class for table "invoices".
 */
class Sale extends BaseSale
{

    public $payment_type;
    public $products;
    public $cash;
    public $change;
    public $print = true;
    

    const LAST_AUTO_CREATED  = 1000;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['customer_id', 'sales_person_id', 'store_id', 'date', 'payment_type', 'items'], 'required'],
            [['customer_id', 'transaction_group', 'created_by', 'updated_by'], 'integer'],
            ['customer_id','default', 'value'=> '1' ],
            [['created_at', 'updated_at', 'is_return', 'comments', 'grand_total', 'net_total', 'discount', 'cash', 'change', 'print'], 'safe'],

            ['status', 'default', 'value' => 1], #that's active.

        ];
    }

    public function getItems()
    {
        return $this->hasMany(SaleItem::className(), ['sale_id' => 'id']);
    }

    /**
     * Get customer
     */
    
    public function getCustomer()
    {
        return $this->hasOne('\backend\modules\customers\models\Customer', ['id' => 'customer_id']);
    }

    public function getPaymentType()
    {
        return $this->hasOne(Payment::className(), ['id' => 'payment_id']);
    }


    public static function totalCost($sale_id)
    {
        $items   =   SaleItem::find()->where(['sale_id' => $sale_id])->all();

        $total_cost     =   0;
        foreach ($items as $item) {
            $purchase_cost  =  (float) $item->product->price->purchase_price;
            $qty            =  (integer) $item->quantity;
            // return $qty;
            $total_cost     +=  $purchase_cost * $qty; //(float) ($item->product->price->purchase_price * $item->quantity);
        }

        return $total_cost;
        
    }

    public function getItemsDiscount()
    {
        return $this->hasMany(SaleItem::className(), ['sale_id' => 'id'])->sum('discount');
    }

    public function getItemsTotal()
    {
        return $this->hasMany(SaleItem::className(), ['sale_id' => 'id'])->sum('total');
    }



    public function getSalesPerson()
    {
        return $this->hasOne('\common\models\User', ['id' => 'sales_person_id']);
    }

    public function getSaleQuantity()
    {
        return $this->getItems()->sum('quantity');
    }
}
