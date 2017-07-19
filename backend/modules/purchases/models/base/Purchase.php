<?php

namespace backend\modules\purchases\models\base;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;

/**
 * This is the base model class for table "purchases".
 *
 * @property integer $id
 * @property integer $order_id
 * @property string $date
 * @property integer $store_id
 * @property string $comments
 * @property integer $supplier_id
 * @property integer $payment_id
 * @property integer $status
 * @property double $net_total
 * @property double $discount
 * @property double $grand_total
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created_at
 * @property string $updated_at
 */
class Purchase extends \yii\db\ActiveRecord
{

    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'purchases';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'bill_no' => 'Bill#',
            'order_id' => 'Order ID',
            'date' => 'Receive Date',
            'issue_date'=> 'Issue Date',
            'store_id' => 'Store ID',
            'comments' => 'Comments',
            'supplier_id' => 'Supplier ID',
            'payment_id' => 'Payment ID',
            'status' => 'Status',
            'net_total' => 'Net Total',
            'discount' => 'Discount',
            'grand_total' => 'Grand Total',
            'is_paid' => "Cash Paid for this purchase",
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
     * @return \backend\modules\purchases\models\query\PurchaseQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \backend\modules\purchases\models\query\PurchaseQuery(get_called_class());
    }
}
