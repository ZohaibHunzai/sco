<?php

namespace backend\modules\init\models;

use Yii;
use \backend\modules\init\models\base\BrandSector as BaseBrandSector;

/**
 * This is the model class for table "brand_sectors".
 */
class BrandSector extends BaseBrandSector
{
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created_by', 'updated_by', 'status'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name'], 'string', 'max' => 255]
        ];
    }
	
}
