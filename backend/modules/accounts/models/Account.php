<?php

namespace backend\modules\accounts\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use backend\modules\accounts\models\PrimaryAccount;
use backend\modules\accounts\models\SecondaryAccount;
use yii\helpers\ArrayHelper;
use common\Constants;
use common\models\User;
/**
 * This is the model class for table "accounts".
 *
 * @property string $id
 * @property string $name
 * @property integer $status
 * @property integer $primary_account_id
 * @property integer $secondary_account_id
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created_at
 * @property string $updated_at
 */
class Account extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $account_balance;

    public static function tableName()
    {
        return 'accounts';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'primary_account_id', 'code', 'secondary_account_id', 'is_system_account'], 'required'],
            [['name', 'code'], 'unique'],
            [['status', 'created_by', 'updated_by', 'group_id'], 'integer'],
            [['created_at', 'updated_at', 'primary_account_id', 'secondary_account_id'], 'safe'],
            [['name'], 'string', 'max' => 255],
            [[ 'name','primary_account_id', 'secondary_account_id'] , 'required'],
            ['status', 'default', 'value' => Constants::STATUS_ACTIVE],
            ['is_system_account', 'default', 'value' => Constants::NO]
            
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
            'secondary_account_id' => 'Secondary Account',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }


    /** RELATIONSHIPS STARTS HERE **/

    /**
     * Relationship to the PrimaryAccount model
     * @return mixed
     */

    public function getPrimaryAccount()
    {
      return $this->hasOne(PrimaryAccount::className(), ['id' => 'primary_account_id']);
    }

    /**
     * Relationship to the SecondaryAccount model
     * @return mixed
     */

    public function getSecondaryAccount()
    {
      return $this->hasOne(SecondaryAccount::className(), ['id' => 'secondary_account_id']);
    }

    /**
     * Relationship to User model for creator
     */
    public function getCreatedBy()
    {
      return $this->hasOne(User::className(), ['id' => 'created_by']);
    }
    /**
     * Relationship to User model
     */
    public function getUpdatedBy()
    {
      return $this->hasOne(User::className(), ['id' => 'updated_by']);
    }


    //**  ATTRIBUTES **// 
    public function getNameTree()
    {
      $name =  ucwords($this->primaryAccount->name);

      if($this->secondaryAccount !== null)
        return $name . " / " . ucwords($this->secondaryAccount->name);

      return $name;
    }
    /**
    * The function created for to get balances of account model
    * @author zohaib
    */
    public function getBalance($account_id = null)
    {
      $id = $account_id ? : $this->id;
      
      if ($id === null || $id === '' || $id === false) {
          return false;
      }

      $accounts = Account::find()->where(['id' => $id])->all();
  
      // $credit = Transaction::find()->where(['id' => $id, 'type' => Transaction::CR])->sum('amount');
      // $debit = Transaction::find()->where(['id' => $id,'type'=>Transaction::DBT])->sum('amount');
      
       return abs($this->credits - $this->debits);
    }


    public function getTodayBalance()
    {
      $date = date('Y-m-d');

      $start = $date . ":00:00:00";
      $end = $date . ":23:23:59";

      $credits = $this->getTransactions()->where(['date(created_at)' => $date, 'type' => Transaction::CR])->sum("amount");
      
      $debits = $this->getTransactions()->where(['date(created_at)' => $date, 'type' => Transaction::DBT])->sum("amount");

      if ($this->primaryAccount->code == 10000 || $this->primaryAccount->code == 20000) {
        return $debits - $credits;
      } else {
        return $credits - $debits;
      }
    }
    /**
     * returns month balance
     * @param  string $month example: febuary 2016
     * @return float 
     */
    public function getMonthBalance($month = null)
    {

      if ($month == null) {
        $start_date = date('Y-m-01');
        $end_date = date('Y-m-t');
      } else {
        $start_date = date('Y-m-01', strtotime($month));
        $end_date = date('Y-m-t', strtotime($month));

      }



      $credits = $this->getTransactions()->where([ 'between', 'date(created_at)', $start_date, $end_date])->andWhere([ 'type' => Transaction::CR])->sum("amount");
      
      $debits = $this->getTransactions()->where([ 'between', 'date(created_at)', $start_date, $end_date])->andWhere([ 'type' => Transaction::DBT])->sum("amount");

      if ($this->primaryAccount->code == 10000 || $this->primaryAccount->code == 20000) {
        return $debits - $credits;
      } else {
        return $credits - $debits;
      }
    }



    /**
     * get transactions
     */
    public function getTransactions()
    {
      return $this->hasMany(Transaction::className(), ['account_id' => 'id']);
    }

    public function getCredits()
    {
      return $this->hasMany(Transaction::className(), ['account_id' => 'id'])->where(['type' => Transaction::CR, 'status' => 1])->sum('amount');
    }

    public function getDebits()
    {
      return $this->hasMany(Transaction::className(), ['account_id' => 'id'])->where(['type' => Transaction::DBT, 'status' => 1])->sum('amount');
    }
    

    public function setAccountBalance()
    {
      $this->account_balance = $this->balance;
    }
}
