<?php

namespace backend\modules\customers\models\base;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;

/**
 * This is the base model class for table "customers".
 *
 * @property string $id
 * @property string $name
 * @property string $phone_no
 * @property string $mobile_no
 * @property string $email
 * @property integer $type
 * @property string $address
 */
class Customer extends \yii\db\ActiveRecord
{

    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'customers';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'phone_no' => 'Phone No',
            'mobile_no' => 'Mobile No',
            'email' => 'Email',
            'type' => 'Type',
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
     * @return \backend\modules\customers\models\query\CustomerQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \backend\modules\customers\models\query\CustomerQuery(get_called_class());
    }
}
