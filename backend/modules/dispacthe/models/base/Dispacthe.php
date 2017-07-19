<?php

namespace backend\modules\dispacthe\models\base;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;

/**
 * This is the base model class for table "dispacthes".
 *
 * @property integer $id
 * @property integer $store_id
 * @property integer $type
 * @property integer $status
 * @property string $comments
 * @property string $date
 * @property string $created_at
 * @property integer $created_by
 * @property string $updated_at
 * @property integer $updated_by
 * @property string $deleted_at
 * @property integer $deleted_by
 */
class Dispacthe extends \yii\db\ActiveRecord
{

    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'dispacthes';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'store_id' => 'Store Name',
            'type' => 'Dispacth Type',
            'status' => 'Status',
            'comments' => 'Comments',
            'date' => 'Date',
            'product_typeahead'=> 'Dispacthes'
        ];
    }

/**
     * @inheritdoc
     * @return type mixed
     */ 
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => new \yii\db\Expression('NOW()'),
            ],
            [
                'class' => BlameableBehavior::className(),
                'createdByAttribute' => 'created_by',
                'updatedByAttribute' => 'updated_by',
            ],
        ];
    }

    /**
     * @inheritdoc
     * @return \backend\modules\dispacthe\models\query\DispactheQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \backend\modules\dispacthe\models\query\DispactheQuery(get_called_class());
    }
}
