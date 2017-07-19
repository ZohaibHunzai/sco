<?php

namespace backend\modules\expenses\models;

use Yii;
use \backend\modules\expenses\models\base\Expense as BaseExpense;
use common\Constants;
use yii\helpers\ArrayHelper;
use backend\modules\accounts\models\Account;
use backend\modules\accounts\models\AccGroup;

/**
 * This is the model class for table "expenses".
 */
class Expense extends BaseExpense
{

  /**
   * @inheritdoc
   */
  const CASH = 10;
  const PAYABLE = 20;


  public $expense_account;
  public $payment_account;


  public function rules()
  {
    return [
      [['amount',  'comment'], 'required'],
      [['amount'], 'number'],
      [['payment_type', 'transaction_group', 'created_by', 'updated_by', 'status'], 'integer'],
      [['created_at', 'updated_at'], 'safe'],
      [['comment'], 'string', 'max' => 255],
      ['payment_type', 'default', 'value' => self::CASH],
      ['status', 'default', 'value' => Constants::STATUS_ACTIVE],
      ['date', 'safe'],


      # custom attributes
      [['expense_account', 'payment_account'], 'required'],
      ['status', 'default', 'value' => 1],
    ];
  }

  public function getPaymentOptions()
  {
    return [
      self::CASH => "Cash",
      self::PAYABLE => "Payble"
    ];
  }

  /**
   * @return string
   */
  public function getExpenseAccounts()
  {
    $accounts = Account::find()
      ->joinWith("primaryAccount pa")
      ->where([
        'pa.code' => 20000
      ])
      ->all();

    return ArrayHelper::map($accounts, 'code', function($item){
      return $item->name . " ( " . $item->balance . " )";
    });
  }

  /**
   * This method updates transaction amount. Because, when a person updates a model
   *  in the table, changes should be reflected to the transaction table.
   * @return boolean
   */
  public function updateTransaction()
  {
    return Yii::$app->db->createCommand("UPDATE `transactions` set amount={$this->amount} WHERE `group` = '{$this->transaction_group}")->execute();
  }

  /**
   * Transaction of the expense payment
   * @return boolean
   */
  
  public function transaction()
  {
    if($this->validate()) {

      $group = Yii::$app->t->entry([
        'dr' => $this->expense_account,
        'cr' => $this->payment_account,
        'amount' => $this->amount,
        'branch_id' => 1,

      ]);

      $this->transaction_group = $group;
      return true;
    }
    
    $this->transaction_group = null;
    return false;
  }


  /**
   * Get payment accounts
   */

  public function getPaymentAccounts()
  {
    $group = AccGroup::findOne(['status' => 1, 'code' => 30]); # 30 => payment accounts
    if($group && !empty($group->mainAccounts)) {
      return ArrayHelper::map($group->mainAccounts, 'code', function($item){
        return $item->name . " ( " . $item->balance . " )";
      });
    }

    $accounts = Account::find()
      ->joinWith("primaryAccount pa")
      ->where([
        'pa.code' => 10000 // that's assets
      ])
      ->all();

    return ArrayHelper::map($accounts, 'code', function($item){
      return $item->name . " ( " . $item->balance . " )";
    });

  }


   /**
     * Get transactions
     * @return array
     */
    public function getTransactions()
    {
        return $this->hasMany('\backend\modules\accounts\models\Transaction', ['group' => 'transaction_group']);
    }
}
