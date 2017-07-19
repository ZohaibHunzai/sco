<?php

namespace backend\modules\purchases\models;

use Yii;
use \backend\modules\purchases\models\base\PurchaseItem as BasePurchaseItem;
use \backend\modules\purchases\models\Purchase;
use backend\modules\product\models\Product;


/**
 * This is the model class for table "purchase_items".
 */
class PurchaseItem extends BasePurchaseItem
{
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['purchase_id', 'product_id', 'quantity'], 'integer'],
            [['unit_cost', 'discount', 'total'], 'number']
        ];
    }

    public function getPurchase()
    {
        return $this->hasOne(Purchase::className(), ['id' => 'purchase_id']);
    }
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }

	
}
