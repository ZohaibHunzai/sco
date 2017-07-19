<?php

namespace backend\modules\expenses\models\base;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;

/**
 * This is the base model class for table "expenses".
 *
 * @property integer $id
 * @property string $comment
 * @property string $amount
 * @property integer $payment_type
 * @property integer $transaction_group
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created_at
 * @property string $updated_at
 * @property integer $status
 */
class Expense extends \yii\db\ActiveRecord
{

    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'expenses';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'comment' => 'Comment',
            'amount' => 'Amount',
            'payment_type' => 'Payment Type',
            'transaction_group' => 'Transaction Group',
            'status' => 'Status',
            'is_payble' => 'Check this if you\'re not paying cash.'
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
     * @return \backend\modules\expenses\models\query\ExpenseQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \backend\modules\expenses\models\query\ExpenseQuery(get_called_class());
    }
}
