<?php

namespace backend\modules\accounts\models\base;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;

/**
 * This is the base model class for table "group_accounts".
 *
 * @property integer $id
 * @property integer $account_id
 * @property integer $group_id
 * @property integer $status
 */
class GroupAccount extends \yii\db\ActiveRecord
{

    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'group_accounts';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'account_id' => 'Account ID',
            'group_id' => 'Group ID',
            'status' => 'Status',
        ];
    }

/**
     * @inheritdoc
     * @return type mixed
     */ 
    // public function behaviors()
    // {
    //     return [
    //         [
    //             'class' => TimestampBehavior::className(),
    //             'createdAtAttribute' => 'created_at',
    //             'updatedAtAttribute' => 'updated_at',
    //             'value' => new \yii\db\Expression('NOW()'),
    //         ],
    //         [
    //             'class' => BlameableBehavior::className(),
    //             'createdByAttribute' => 'created_by',
    //             'updatedByAttribute' => 'updated_by',
    //         ],
    //     ];
    // }

    /**
     * @inheritdoc
     * @return \backend\modules\accounts\models\query\GroupAccountQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \backend\modules\accounts\models\query\GroupAccountQuery(get_called_class());
    }
}
