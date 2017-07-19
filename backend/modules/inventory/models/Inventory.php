<?php

namespace backend\modules\inventory\models;

use Yii;
use \backend\modules\inventory\models\base\Inventory as BaseInventory;
use \backend\modules\price\models\Price;
use \backend\modules\product\models\Product;
use \backend\modules\locations\models\Location;
/**
 * This is the model class for table "inventories".
 */
class Inventory extends BaseInventory
{
    
    /**
     * @inheritdoc
     */
    public $price_changed = false;
    public $selling_price;
    public $purchase_price;

    const EVENT_INVENTORY_CREATED = 'e_ic';

    public function init()
    {
        parent::init();

        $this->on(self::EVENT_INVENTORY_CREATED, [$this, 'savePrice']);
    }
    public function rules()
    {
        return [
            [['product_id', 'quantity', 'store_id'], 'required'],
            [['selling_price', 'purchase_price'], 'required', 'when' => function($model){
                return $model->price_changed == true || (int) $model->price_changed == 1;
            }, 'whenClient' => "function(){
                return  $('#inventory-price_changed').is(':checked');
            }"

            ],
            [['product_id', 'quantity', 'store_id', 'created_by', 'updated_by', 'price_id', 'supplier_id'], 'integer'],
            [['created_at', 'updated_at', 'mfg_date', 'expirity_date', 'price_changed'], 'safe'],

        ];
    }


    /** EVENT INVENTORY CREATED HANDLERS SHOULD WRITTEN BELOW **/

    /**
     * Save price handler
     * @author Ejoo
     * @return true
     */
    public function savePrice($event)
    {
        $model = $event->sender;

        if($model->price_changed !== false && $model->isNewRecord) {
            Price::inventoryPrice($model->id, $model->selling_price, $model->purchase_price);
        } else if($model->price_changed !== false && !$model->isNewRecord) {
            Price::updateInventoryPrice($model->id, $model->selling_price, $model->purchase_price, $model->price_id);
        }



        return true;
    }




    /** INVENTORY RELATIONSHIPS STARTS **/

    /**
     * Get prices of the inventory
     * @return mixed
     * @author Ejoo
     */

    public function getPrice()
    {
        if( $this->price_id == null ) {
            # inventory doesn't have its own price, so need to get back product's price.
            return $this->product ? $this->product->price : null;
        }

        return $this->hasOne(Price::className(), ['id' => 'price_id']);
    }


    /**
     * Relationship to the product. 
     * @return mixed
     * @author Ejoo
     */
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }

    /**
     * Has one relationship to the Location
     */

    public function getLocation()
    {
        return $this->hasOne(Location::className(), ['id' => 'store_id']);
    }
	
}
