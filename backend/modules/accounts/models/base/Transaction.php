<?php

namespace backend\modules\accounts\models\base;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;

/**
 * This is the base model class for table "transactions".
 *
 * @property string $id
 * @property string $name
 * @property string $narration
 * @property integer $status
 * @property integer $account_id
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property integer $deleted_by
 * @property integer $mode
 * @property integer $type
 * @property integer $approved_by
 * @property string $approved_at
 * @property integer $group
 * @property integer $branch_id
 */
class Transaction extends \yii\db\ActiveRecord
{

    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'transactions';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'narration' => 'Narration',
            'status' => 'Status',
            'account_id' => 'Account',
            'mode' => 'Mode',
            'type' => 'Type',
            'approved_by' => 'Approved By',
            'approved_at' => 'Approved At',
            'group' => 'Group',
            'branch_id' => 'Branch',
            'tranfer_account_id' =>'Transfer Account',
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
     * @return \backend\modules\accounts\models\query\TransactionQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \backend\modules\accounts\models\query\TransactionQuery(get_called_class());
    }
}
