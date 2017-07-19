<?php

namespace backend\modules\product\models\base;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;

/**
 * This is the base model class for table "product_variants_list".
 *
 * @property integer $id
 * @property string $name
 * @property integer $status
 */
class ProductVariantList extends \yii\db\ActiveRecord
{

    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_variants_list';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'status' => 'Status',
        ];
    }


    /**
     * @inheritdoc
     * @return \backend\modules\product\models\query\ProductVariantListQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \backend\modules\product\models\query\ProductVariantListQuery(get_called_class());
    }
}
