<?php

namespace backend\modules\product\models;

use Yii;
use \backend\modules\product\models\base\ProductVariantList as BaseProductVariantList;

/**
 * This is the model class for table "product_variants_list".
 */
class ProductVariantList extends BaseProductVariantList
{
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status'], 'integer'],
            [['name'], 'string', 'max' => 255]
        ];
    }
	
}
