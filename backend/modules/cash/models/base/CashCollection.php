<?php

namespace backend\modules\cash\models\base;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;

/**
 * This is the base model class for table "cash_collections".
 *
 * @property integer $id
 * @property integer $customer_id
 * @property string $date
 * @property double $amount
 * @property integer $sales_person_id
 * @property string $created_at
 * @property string $updated_at
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $status
 * @property integer $sale_id
 */
class CashCollection extends \yii\db\ActiveRecord
{

    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cash_collections';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'customer_id' => 'Customer',
            'date' => 'Date',
            'amount' => 'Amount',
            'sales_person_id' => 'Sales Person ID',
            'status' => 'Status',
            'sale_id' => 'Sale ID',
            'type' => 'Receiving Mode',
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
     * @return \backend\modules\cash\models\query\CashCollectionQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \backend\modules\cash\models\query\CashCollectionQuery(get_called_class());
    }
}
