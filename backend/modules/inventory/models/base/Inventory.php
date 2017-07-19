<?php

namespace backend\modules\inventory\models\base;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;

/**
 * This is the base model class for table "inventories".
 *
 * @property string $id
 * @property string $product_id
 * @property string $quantity
 * @property string $location_id
 * @property string $created_by
 * @property string $updated_by
 * @property string $created_at
 * @property string $updated_at
 * @property integer $price_id
 * @property integer $supplier_id
 * @property string $mfg_date
 * @property string $expirity_date
 */
class Inventory extends \yii\db\ActiveRecord
{

    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'inventories';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'product_id' => 'Product',
            'quantity' => 'Quantity',
            'location_id' => 'Location',
            'price_id' => 'Price ID',
            'supplier_id' => 'Supplier',
            'mfg_date' => 'Menufacture Date',
            'expirity_date' => 'Expiry Date',
            'same_price' => 'Is price changed?'
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

    
}
