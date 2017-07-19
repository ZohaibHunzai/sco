<?php

namespace backend\modules\accounts\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use common\Constants;
/**
 * This is the model class for table "primary_accounts".
 *
 * @property string $id
 * @property string $name
 * @property intege
 r $status
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created_at
 * @property string $updated_at
 */
class PrimaryAccount extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'primary_accounts';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'code'], 'required'],
            [['status', 'created_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_at', 'created_by', 'updated_by'], 'safe'],
            [['name'], 'string', 'max' => 255],
            [['status'], 'default', 'value' => Constants::STATUS_ACTIVE]
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
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }


    /** EVENTS **/

    public function afterFind()
    {
      $this->name = ucwords(strtolower($this->name));
    }
/**
     * Returns balance for this account
     * @param integer account_id if null, will return balance of current instance.
     * @author Zohaib
     * @return boolean|float if ID is not valid will return false.
*/
    public function getBalance($account_id = null)
    {
      $id = $account_id ? : $this->id;
      
      if ($id === null|| $id === ''|| $id === false) {
          return false;
      }
      
      $accounts = Account::find()->where(['primary_account_id' => $id])->all();
      $result = [];

       foreach ($accounts as $model) {
         $result[] = $model->id;
       }

       if (empty($result)) {
         return null;
       }

       $credit = Transaction::find()->where(['account_id' => $result, 'type' => Transaction::CR])->sum('amount');
       $debit = Transaction::find()->where(['account_id' => $result,'type'=>Transaction::DBT])->sum('amount');
       return $credit - $debit;
    }

    public function getTodayBalance()
    {
      $date = date('Y-m-d');

      $start = $date . ":00:00:00";
      $end = $date . ":23:23:59";



      $credits = Transaction::find()->where(['date(created_at)' => $date, 'type' => Transaction::CR, 'account_id' => Account::find()->select('id')->where(['primary_account_id' => $this->id])])->sum("amount");
      
      $debits = Transaction::find()->where(['date(created_at)' => $date, 'type' => Transaction::DBT, 'account_id' => Account::find()->select('id')->where(['primary_account_id' => $this->id])])->sum("amount");

      if ($this->code == 10000 || $this->code == 20000) {
        return $debits - $credits;
      } else {
        return $credits - $debits;
      }
    }


    public function getTransactions($value='')
    {
      return $this->hasMany();
    }
}
