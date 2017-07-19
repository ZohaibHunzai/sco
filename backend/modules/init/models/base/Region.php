<?php

namespace backend\modules\init\models\base;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use mootensai\behaviors\UUIDBehavior;

/**
 * This is the base model class for table "regions".
 *
 * @property integer $id
 * @property string $name
 * @property string $code
 * @property integer $status
 */
class Region extends \yii\db\ActiveRecord
{

    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'regions';
    }

    /**
     * 
     * @return string
     * overwrite function optimisticLock
     * return string name of field are used to stored optimistic lock 
     * 
     */
    // public function optimisticLock() {
    //     return 'lock';
    // }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'code' => 'Code',
            'status' => 'Status',
        ];
    }



    /**
     * @inheritdoc
     * @return \backend\modules\init\models\query\RegionQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \backend\modules\init\models\query\RegionQuery(get_called_class());
    }
}
