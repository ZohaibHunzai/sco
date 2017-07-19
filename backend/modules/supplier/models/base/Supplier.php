<?php

namespace backend\modules\supplier\models\base;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;

/**
 * This is the base model class for table "suppliers".
 *
 * @property string $id
 * @property string $name
 * @property string $email
 * @property string $phone_no
 * @property string $mobile_no
 * @property string $fax_number
 * @property string $address
 */
class Supplier extends \yii\db\ActiveRecord
{

    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'suppliers';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'email' => 'Email',
            'phone_no' => 'Phone No',
            'mobile_no' => 'Mobile No',
            'fax_number' => 'Fax Number',
            'address' => 'Address',
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
     * @return \backend\modules\categories\models\query\SupplierQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \backend\modules\categories\models\query\SupplierQuery(get_called_class());
    }
}
