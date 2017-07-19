<?php

namespace backend\modules\dispacthe\models;

use Yii;
use \backend\modules\dispacthe\models\base\Dispacthe as BaseDispacthe;
use yii\data\ActiveDataProvider;
use backend\modules\product\models\Product as product;

/**
 * This is the model class for table "dispacthes".
 */
class Dispacthe extends BaseDispacthe
{
    public $product_typeahead;

    const TYPE_RECEIVED = 1;
    const TYPE_SENT = 2;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['store_id', 'type', 'bill_no'], 'required'],
            [['store_id', 'type', 'status', 'created_by', 'updated_by', 'deleted_by','transaction_group'], 'integer'],
            [['date', 'created_at','transaction_group', 'updated_at', 'deleted_at'], 'safe'],
            [['store_id','type','date'],'required'],
            [['comments'], 'string', 'max' => 300],
            ['status', 'default', 'value' => 1],
        ];
    }

    public function getItems()
    {
        return $this->hasMany(DispactheItem::className(), [ 'dispatches_id' => 'id' ]);
    }
    /**
     * @return array
     * @author zohaib
     */
    public function typeOptions()
    {
        return [

            self::TYPE_RECEIVED => 'Recived',
            self::TYPE_SENT => 'Send',

        ];
    }

    public function getTypeText()
    {
        $types = $this->typeOptions();
        return isset($types[$this->type]) ? $types[$this->type] : null;
    }
    /**
    *@return name
    *to get name od the store
    */
    public function getStores()
    {
        return $this->hasOne(\backend\modules\init\models\Store::className(),['id'=>'store_id']);
    }


    /**
     *@return query of dispacthesitems
     *@author zohaib
     */
    public function runQuery($id)
    {
        $dataProvider   = new ActiveDataProvider([
            'query'     => DispactheItem::find()->select(['product_id','dispatches_id','quantity','status'])->where(['dispatches_id'=>$id]),
            'pagination' => [
             'pageSize' => 20,
                          ],
            ]);
        return $dataProvider;
    }

    

    public function getSum()
    {
        $total  = 0;
        $find   = DispactheItem::find()->where(['dispatches_id'=>$this->id])->all();
        foreach ($find as $items) {
            $total += $items->products->price->selling_price;
        }

        return $total;
    }	


    public function transaction($amount, $transaction_type)
    {

        if ($transaction_type == 1) {
        
            $group = Yii::$app->t->entry([
                'dr' => 15015,
                'cr' => 40066,
                'amount' => $amount,
                'branch_id' => 1,
            ]);
            $this->transaction_group = $group;
            return true;
        }

        if ($transaction_type == 2) {
            $group = Yii::$app->t->entry([
                'dr' => 40066,
                'cr' => 15015,
                'amount' => $amount,
                'branch_id' => 1,
            ]);
            $this->transaction_group = $group;
            $this->save(false);
            return true; 

        } else {
            $this->transaction_group = null;
            return false;
        }
    }

    public function getDispatchQuantity()
    {
        return $this->getItems()->sum('quantity');
    }

    public function getTotal()
    {   
        $total = 0;
        foreach ($this->items as $item) {
            $total += ($item->products->price->selling_price * $item->quantity);
        }

        return $total;
    }
}
