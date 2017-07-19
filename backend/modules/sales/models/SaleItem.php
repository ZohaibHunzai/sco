<?php

namespace backend\modules\sales\models;

use Yii;
use \backend\modules\sales\models\base\SaleItem as BaseSaleItem;
use \backend\modules\sales\models\Sale;
use \backend\modules\product\models\Product;
use backend\modules\price\models\Price;

/**
 * This is the model class for table "sale_items".
 */
class SaleItem extends BaseSaleItem
{
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sale_id',  'product_id', 'created_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['quantity', 'quantity_unit', 'discount', 'total', 'tonnage', 'price'], 'number'],
        ];
    }

    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }

    public function getPrice()
    {
        return $this->hasMany(Price::className(), ['id' => 'price_id'])
                ->viaTable('products', ['id' => 'product_id']);
    }

    public function getSale()
    {
        return $this->hasOne(Sale::className(), ['id' => 'sale_id']);
    }
	


}
