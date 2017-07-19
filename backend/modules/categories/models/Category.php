<?php

namespace backend\modules\categories\models;

use Yii;
use \backend\modules\categories\models\base\Category as BaseCategory;
use \backend\modules\init\models\Brand;
/**
 * This is the model class for table "categories".
 */
class Category extends BaseCategory
{
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent_id'], 'integer'],
            [['name'], 'string', 'max' => 128]
        ];
    }
public function getBrand()
{
    return $this->hasOne(Brand::className(),['id'=>'parent_id']);
}
	
}
