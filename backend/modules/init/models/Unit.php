<?php

namespace backend\modules\init\models;

use Yii;
use \backend\modules\init\models\base\Unit as BaseUnit;

/**
 * This is the model class for table "units".
 */
class Unit extends BaseUnit
{
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'status', 'symbol'], 'required'],
            [['status'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['symbol'], 'string', 'max' => 10],
            ['tonnage_unit', 'safe'],
        ];
    }
	
}
