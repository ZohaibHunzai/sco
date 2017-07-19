<?php

namespace backend\modules\init\models;

use Yii;
use \backend\modules\init\models\base\Brand as BaseBrand;

/**
 * This is the model class for table "brands".
 */
class Brand extends BaseBrand
{
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'status'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['created_by', 'updated_by', 'status'], 'integer'],
            [['name'], 'string', 'max' => 255]
        ];
    }
	

    public function getBrandSector()
    {
        return $this->hasOne(BrandSector::className(), ['id' => 'brand_sector_id']);
    }

    
}
