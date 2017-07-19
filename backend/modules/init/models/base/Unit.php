<?php

namespace backend\modules\init\models\base;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;

/**
 * This is the base model class for table "units".
 *
 * @property integer $id
 * @property string $name
 * @property string $symbol
 * @property integer $status
 */
class Unit extends \yii\db\ActiveRecord
{

    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'units';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'symbol' => 'Symbol',
            'status' => 'Status',
        ];
    }


    /**
     * @inheritdoc
     * @return \backend\modules\init\models\query\UnitQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \backend\modules\init\models\query\UnitQuery(get_called_class());
    }
}
