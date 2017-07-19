<?php

namespace backend\modules\dispacthe\models;

use Yii;
use \backend\modules\dispacthe\models\base\DispactheItem as BaseDispactheItem;

/**
 * This is the model class for table "dispacthes_items".
 */
class DispactheItem extends BaseDispactheItem
{
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['dispatches_id', 'quantity', 'status', 'product_id'], 'integer'],
            ['status', 'default', 'value' => 1],
        ];
    }

    /**
     * @return products name array
     * @author zohaib
     */
    public function getProducts()
    {
        return $this->hasOne(\backend\modules\product\models\Product::className(),['id'=>'product_id']);
    }

    public function getDispatch()
    {
        return $this->hasOne(Dispacthe::className(), ['id' => 'dispatches_id']);
    }
	
}
