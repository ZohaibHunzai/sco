<?php

namespace backend\modules\purchases\models;

use Yii;
use \backend\modules\purchases\models\base\Purchase as BasePurchase;
use \backend\modules\payments\models\Payment;
/**
 * This is the model class for table "purchases".
 */
class Purchase extends BasePurchase
{

    public $product_typeahead;
    public $is_paid = false;

    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['store_id','bill_no','issue_date', 'supplier_id', 'is_paid', 'grand_total'], 'required'],
            [['order_id', 'store_id', 'supplier_id', 'payment_id', 'status', 'created_by', 'updated_by', 'transaction_group'], 'integer'],
            [['date', 'created_at', 'updated_at', 'is_return'], 'safe'],
            [['net_total', 'discount', 'grand_total'], 'number'],
            [['comments'], 'string', 'max' => 255],
            [['bill_no'], 'string'],
            [['bill_no'], 'unique'],

            ['status', 'default', 'value' => 1],
        ];
    }

    public function getItems()
    {
        return $this->hasMany(PurchaseItem::className(), ['purchase_id' => 'id']);
    }
    

    public function payment()
    {
        $payment    =   new Payment;

        if($this->is_return !== 1) {

            if((bool)$this->is_paid == false) {
                $payment->payment_type_id = Payment::CREDIT;
                $payment->remaining = $this->grand_total;
                $payment->received = 0;
            } else {
                $payment->payment_type_id = Payment::CASH;
                $payment->remaining = 0;
                $payment->received = $this->grand_total;

            }
        } else {
            $payment->payment_type_id = Payment::CASH;
            $payment->purchase_return = $this->grand_total;
            // $payment->received = $this->grand_total;
        }

        $result =  $payment->save(false);

        if($result){
            $this->payment_id = $payment->id;
            $this->save(['payment_id']);
            return true;
        }

        // $this->payment_id = $result->id;
        return false;

    }


    // public function beforeSave($insert)
    // {
    //     parent::beforeSave($insert);
    //     $this->payment();
    //     return true;
    // }

    /**
     * Get payment
     */
    public function getPayment()
    {
        return $this->hasOne(Payment::className(), ['id' =>  'payment_id']);
    }

    public function transaction()
    {
        $debits = [
            15015 => [ // that's inventory account.
                'amount' => $this->grand_total,

            ]
        ];


        $credits = [];


        if($this->payment->remaining > 0) {
            $credits[40066] = [ // that's purchase payable
                'amount' => $this->payment->remaining,
            ];
        }
        if ($this->payment->received > 0) {
            $credits[15001] = [ // that's cash in hand
                'amount' => $this->payment->received,
            ];
        }

        $group = Yii::$app->t->entry([
            'dr' => $debits,
            'cr' => $credits,
            'narration' => 'Purchase System Entry on ' . $this->date,
            'branch_id' => 1,
        ]);

        $this->transaction_group = $group['group'];
        $this->save(['transaction_group']);
        return true;
    }

    public function returnTransaction()
    {
        $group = Yii::$app->t->entry([
            'dr' => 40066,
            'cr' => 15015,
            'branch_id' => 1,
            'amount' => $this->payment->purchase_return
        ]);
    }


    

    public function getSupplier()
    {
        return $this->hasOne('backend\modules\supplier\models\Supplier', ['id' => 'supplier_id']);       
    }    

    public function getAuthor()
    {
        return $this->hasOne('common\models\User', ['id' => 'created_by']);
    }

    public function getPurchaseCount()
    {
        return $this->getItems()->count('id');
    }
    public function getPurchaseQuantity()
    {
        return $this->getItems()->sum('quantity');
    }

}
