<?php

namespace backend\modules\dispacthe\models\base;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;

/**
 * This is the base model class for table "dispacthes_items".
 *
 * @property integer $id
 * @property integer $dispatches_id
 * @property integer $quantity
 * @property integer $status
 */
class DispactheItem extends \yii\db\ActiveRecord
{

    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'dispacthes_items';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'dispatches_id' => 'Dispatches ID',
            'quantity' => 'Quantity',
            'status' => 'Status',
        ];
    }

// /**
//      * @inheritdoc
//      * @return type mixed
//      */ 
//     public function behaviors()
//     {
//         return [
//             [
//                 'class' => TimestampBehavior::className(),
//                 'createdAtAttribute' => 'created_at',
//                 'updatedAtAttribute' => 'updated_at',
//                 'value' => new \yii\db\Expression('NOW()'),
//             ],
//             [
//                 'class' => BlameableBehavior::className(),
//                 'createdByAttribute' => 'created_by',
//                 'updatedByAttribute' => 'updated_by',
//             ],
//         ];
//     }

    /**
     * @inheritdoc
     * @return \backend\modules\dispacthe\models\query\DispactheItemQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \backend\modules\dispacthe\models\query\DispactheItemQuery(get_called_class());
    }
}
