<?php

namespace backend\modules\init\models;

use Yii;
use \backend\modules\init\models\base\Region as BaseRegion;

/**
 * This is the model class for table "regions".
 */
class Region extends BaseRegion
{
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'status', 'code'], 'required'],
            ['code', 'unique'],
            [['status'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['code'], 'string', 'max' => 128],
            // [['lock'], 'default', 'value' => '0'],
            // [['lock'], 'mootensai\components\OptimisticLockValidator']
        ];
    }
	
}
