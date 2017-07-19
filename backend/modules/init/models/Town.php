<?php

namespace backend\modules\init\models;

use Yii;
use \backend\modules\init\models\base\Town as BaseTown;

/**
 * This is the model class for table "towns".
 */
class Town extends BaseTown
{
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['region_id', 'created_by', 'updated_by', 'status'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name'], 'string', 'max' => 255]
        ];
    }
	
    /**
     * Relationship with Region
     */
    
    public function getRegion()
    {
        return $this->hasOne(Region::className(), ['id' => 'region_id']);
    }

    public function getCustomers()
    {
        return $this->hasMany('backend\modules\customers\models\Customer', ['town_id' => 'id' ]);
    }


    public function getBalance()
    {
        $total = 0;
        foreach ($this->customers as $customer) {
            $total += $customer->balance;
        }

        return $total;
    }
}
