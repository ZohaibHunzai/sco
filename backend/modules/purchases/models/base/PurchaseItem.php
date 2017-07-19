<?php

namespace backend\modules\purchases\models\base;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;

/**
 * This is the base model class for table "purchase_items".
 *
 * @property integer $id
 * @property integer $purchase_id
 * @property integer $product_id
 * @property integer $quantity
 * @property double $unit_cost
 * @property double $discount
 * @property double $total
 */
class PurchaseItem extends \yii\db\ActiveRecord
{

    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'purchase_items';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'purchase_id' => 'Purchase ID',
            'product_id' => 'Product ID',
            'quantity' => 'Quantity',
            'unit_cost' => 'Unit Cost',
            'discount' => 'Discount',
            'total' => 'Total',
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
     * @return \backend\modules\purchases\models\query\PurchaseItemQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \backend\modules\purchases\models\query\PurchaseItemQuery(get_called_class());
    }
}
