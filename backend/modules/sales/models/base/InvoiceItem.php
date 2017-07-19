<?php

namespace backend\modules\sales\models\base;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;

/**
 * This is the base model class for table "invoice_items".
 *
 * @property string $id
 * @property string $invoice_id
 * @property string $product_id
 * @property integer $quantity
 * @property string $comment
 * @property integer $discount_percent
 * @property string $created_at
 * @property string $updated_at
 * @property string $created_by
 * @property string $updated_by
 */
class InvoiceItem extends \yii\db\ActiveRecord
{

    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'invoice_items';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'invoice_id' => 'Invoice ID',
            'product_id' => 'Product ID',
            'quantity' => 'Quantity',
            'comment' => 'Comment',
            'discount_percent' => 'Discount Percent',
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
     * @return \backend\modules\sales\models\query\InvoiceItemQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \backend\modules\sales\models\query\InvoiceItemQuery(get_called_class());
    }
}
