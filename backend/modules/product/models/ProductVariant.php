<?php

namespace backend\modules\product\models;

use Yii;
use \backend\modules\product\models\base\ProductVariant as BaseProductVariant;

/**
 * This is the model class for table "product_variants".
 */
class ProductVariant extends BaseProductVariant
{
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_id', 'variant_id'], 'integer']
        ];
    }
	
}
