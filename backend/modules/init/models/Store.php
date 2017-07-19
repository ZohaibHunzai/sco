<?php

namespace backend\modules\init\models;

use Yii;
use \backend\modules\init\models\base\Store as BaseStore;

/**
 * This is the model class for table "stores".
 */
class Store extends BaseStore
{
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['code', 'status', 'name'], 'required'],
            [['code', 'status', 'created_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name'], 'string', 'max' => 255]
        ];
    }
	
}
