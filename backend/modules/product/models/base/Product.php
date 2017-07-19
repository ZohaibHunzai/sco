<?php

namespace backend\modules\product\models\base;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;

/**
 * This is the base model class for table "products".
 *
 * @property string $id
 * @property string $name
 * @property string $barcode
 * @property string $description
 * @property string $category_id
 * @property string $image_id
 * @property integer $unit
 * @property integer $price_id
 */
class Product extends \yii\db\ActiveRecord
{

    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'products';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Article Name',
            'barcode' => 'Barcode',
            'description' => 'Description',
            'category_id' => 'Category',
            'image_id' => 'Image ID',
            'unit' => 'Unit',
            'price_id' => 'Price ID',
            'code' => "SKU",
            'unit_id' => 'Unit Type',
            'brand_id' => 'Brand',
            'unit_weight' => 'Unit Weight (KG)',
            
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
     * @return \app\models\ProductQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\ProductQuery(get_called_class());
    }
}
