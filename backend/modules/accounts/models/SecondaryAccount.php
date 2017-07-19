<?php

namespace backend\modules\accounts\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
// use backend\modules\accounts\models\PrimaryAccount;
use yii\helpers\ArrayHelper;
use common\Constants;

/**
 * This is the model class for table "secondary_accounts".
 *
 * @property string $id
 * @property string $name
 * @property integer $status
 * @property integer $primary_account_id
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created_at
 * @property string $updated_at
 */
class SecondaryAccount extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'secondary_accounts';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'primary_account_id', 'code'], 'required'],
            [['code', 'name'], 'unique'],
            [['status', 'primary_account_id', 'created_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name'], 'string', 'max' => 255],
            ['status', 'default', 'value' => Constants::STATUS_ACTIVE]
        ];
    }
     public function behaviors()
    {
        return [
            [
              'class' => BlameableBehavior::className(),
              'createdByAttribute' => 'created_by',
              'updatedByAttribute' => 'updated_by',
          ],
              [
              'class' => TimestampBehavior::className(),
              'createdAtAttribute' => 'created_at',
              'updatedAtAttribute' => 'updated_at',
              'value' => new Expression('NOW()'),
          ],
        ];
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
            'primary_account_id' => 'Primary Account',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
    public function getPrimaryAccount()
    {
      return $this->hasOne(PrimaryAccount::className(), ['id' => 'primary_account_id']);
    }


    /**
     * Returns balance for this account
     * @param integer account_id if null, will return balance of current instance.
     * @author Zohaib
     * @return boolean|float if ID is not valid will return false.
     */
    public function getBalance($account_id = null)
    {
      //agar account_id may id araha hai to theek nhe to model->id kar do 
      $id = $account_id ? : $this->id;

      if($id == null || $id === '' || $id === false) {
        return false;
      }

      $accounts = Account::find()->where(['secondary_account_id' => $id])->all();
      $result = [];

      foreach ($accounts as $model) {
        $result[] = $model->id;
      }


      if(empty($result))
        return null;

      $credit = Transaction::find()->where(['account_id' => $result,'type'=>Transaction::CR])->sum('amount');
      $debit  = Transaction::find()->where(['account_id' => $result, 'type'=>Transaction::DBT])->sum('amount');


      return $credit - $debit;
    }

   /*
    * This function is created for the balance sheet to show income and loss 
    * @author Zohaib 
    */
    public function getProfitLoss()
    {
        $total_expenses = 0;
        $total_income = 0;

        $expense = Self::find()->where(['primary_account_id' => 11])->all();

        foreach ($expense as $exp) {
            $total_expenses+= $exp->getBalance($exp->id);
        }
        
        $income = Self::find()->where(['primary_account_id' => 8])->all();

        foreach ($income as $inc) {
            $total_income+= $inc->getBalance($inc->id);
        }
        return $total_income - abs($total_expenses);
    }
}
