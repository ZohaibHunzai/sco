<?php

namespace backend\modules\business\models\base;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use mootensai\behaviors\UUIDBehavior;

/**
 * This is the base model class for table "businesses".
 *
 * @property integer $id
 * @property string $name
 * @property string $address
 * @property integer $phone_number
 * @property integer $photo_id
 * @property string $invoice_header
 * @property string $invoice_footer
 * @property string $created_at
 * @property integer $created_by
 * @property string $updated_at
 * @property integer $updated_by
 */
class Business extends \yii\db\ActiveRecord
{

    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'businesses';
    }

    /**
     * 
     * @return string
     * overwrite function optimisticLock
     * return string name of field are used to stored optimistic lock 
     * 
     */
    // public function optimisticLock() {
    //     return 'lock';
    // }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'address' => 'Address',
            'phone_number' => 'Phone Number',
            'photo_id' => 'Photo ID',
            'invoice_header' => 'Invoice Header',
            'invoice_footer' => 'Invoice Footer',
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
            // [
            //     'class' => UUIDBehavior::className(),
            //     'column' => 'id',
            // ],
        ];
    }

    /**
     * @inheritdoc
     * @return \backend\modules\business\models\query\BusinessQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \backend\modules\business\models\query\BusinessQuery(get_called_class());
    }
}
