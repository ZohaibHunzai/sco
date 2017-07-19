<?php

namespace backend\modules\price\models;

use Yii;
use \backend\modules\price\models\base\Price as BasePrice;
use \backend\modules\product\models\Product;
use \backend\modules\inventory\models\Inventory;
/**
 * This is the model class for table "price".
 */
class Price extends BasePrice
{
    
    /**
     * @inheritdoc
     */
    const PRICE_PRODUCT = 45;
    const PRICE_INVENTORY = 46;
    public $price_type;
    public function rules()
    {
        return [
            [['selling_price', 'unit_selling_price', 'unit_purchase_price', 'total_units'], 'required'],
            [['selling_price', 'purchase_price'], 'number'],
            [['date', 'created_at', 'updated_at', 'date'], 'safe'],
            [['created_by', 'updated_by'], 'integer'],
            ['price_type', 'default', 'value' => self::PRICE_PRODUCT]
        ];
    }


    public function followUp($ids=null)
    {
        # save price_id in equilent model
        if(is_null($ids)) return false;

        if($this->price_type == self::PRICE_PRODUCT) {
            $products = Product::find()->where(['id' => $ids])->one();
            $products->price_id = $this->id;

            return $products->update(['price_id']) ? true : false;

        } else if($this->price_type == self::PRICE_INVENTORY) {
            $inventory = Inventory::findOne($ids);
            $inventory->price_id = $this->id;
            return $inventory->update(['price_id']);
        }
        # else part is empty now.

        return false;
    }

    /**
     * Margin of a between selling and purchase price.
     */

    public function getMargin()
    {
        if($this->selling_price && $this->purchase_price) {
            return (float) $this->selling_price - (float) $this->purchase_price;
        }

        return 0.0;
    }

    /**
     * Saves inventory price
     * @author Ejoo
     * @return boolean
     */

    public static function inventoryPrice($inventory_id, $selling_price, $purchase_price)
    {
        $model = new static;

        $model->price_type = self::PRICE_INVENTORY;
        $model->selling_price = $selling_price;
        $model->purchase_price = $purchase_price;
        if( $model->save() ) {
            # calling followUp method. That method follow process when price gets saved. It does rest of job like 
            # savign price_id in corrosponding model.
            return $model->followUp($inventory_id);
        } 

        return false;


    }

    /**
     * updates inventory price
     * @author Ejoo
     * @return boolean
     */

    public static function updateInventoryPrice($inventory_id, $selling_price, $purchase_price, $price_id)
    {
        $model = self::findOne($price_id);

        if(!$model) return false;

        $model->price_type = self::PRICE_INVENTORY;
        $model->selling_price = $selling_price;
        $model->purchase_price = $purchase_price;
        if( $model->save() ) {
            # calling followUp method. That method follow process when price gets saved. It does rest of job like 
            # savign price_id in corrosponding model.
            return $model->followUp($inventory_id);
        } 

        return false;


    }


	
}
