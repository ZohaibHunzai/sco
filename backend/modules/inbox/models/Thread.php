<?php

namespace backend\modules\inbox\models;

use Yii;

/**
 * This is the model class for table "threads".
 *
 * @property integer $id
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created_at
 * @property string $updated_at
 * @property integer $created_for
 * @property integer $deleted_by
 * @property integer $status
 */
class Thread extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    const STATUS_ACTIVE = 1; # static variables
    const STATUS_DELETED = 0;


    public static function tableName()
    {
        return 'threads';
    }

    /**
     * @inheritdoc
     * third type of the fuction
     * @return  this should always return an array
     */
    public function rules()
    {
        return [
            [['created_for'], 'required'],
            [['created_by', 'updated_by', 'created_for', 'deleted_by', 'status'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['status'], 'default', 'value' => self::STATUS_ACTIVE]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_for' => 'To',
            'deleted_by' => 'Deleted By',
            'status' => 'Status',
        ];
    }

    public function behaviors()
    {
        return [
            [
                'class' => 'yii\behaviors\BlameableBehavior'
            ],
            [
                'class' => 'yii\behaviors\TimestampBehavior',
                'value' => new \yii\db\Expression("NOW()"),
            ],


        ];
    }


    public function beforeSave($param)
    {
        parent::beforeSave($param);
        // $this->status = self::STATUS_ACTIVE;
        return true;
    }   


    public function getToUsers()
    {
        $users = \common\models\User::find()->all();

        $_ = [];

        foreach ($users as $user) {
            $_[$user->id] = ucwords($user->username);
        }

        return $_;
    }
    /**
     * Relationship to the createfor user
     * @return Query|User
     */
    public function getCreatedFor()
    {
        return $this->hasOne('\common\models\User', ['id' => 'created_for']);
    }
    
    /**
     * Relationship to the createfor user
     * @return Query|User
     */
    public function getCreatedBy()
    {
        return $this->hasOne('\common\models\User', ['id' => 'created_by']);
    }

}
