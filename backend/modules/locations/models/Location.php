<?php

namespace backend\modules\locations\models;

use Yii;
use \backend\modules\locations\models\base\Location as BaseLocation;

/**
 * This is the model class for table "locations".
 */
class Location extends BaseLocation
{
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'address'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['created_by', 'updated_by'], 'integer'],
            [['name'], 'string', 'max' => 256],
            [['address'], 'string', 'max' => 1000]
        ];
    }
	
}
