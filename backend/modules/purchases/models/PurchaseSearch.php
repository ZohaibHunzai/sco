<?php

namespace backend\modules\purchases\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\purchases\models\Purchase;

/**
 * backend\modules\purchases\models\PurchaseSearch represents the model behind the search form about `backend\modules\purchases\models\Purchase`.
 */
 class PurchaseSearch extends Purchase
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'order_id', 'bill_no', 'store_id', 'supplier_id', 'payment_id', 'status', 'created_by', 'updated_by'], 'integer'],
            [['date', 'comments', 'created_at', 'updated_at'], 'safe'],
            [['net_total', 'discount', 'grand_total'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Purchase::find()->active();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'bill_no' => $this->bill_no,
            'order_id' => $this->order_id,
            'date' => $this->date,
            'store_id' => $this->store_id,
            'supplier_id' => $this->supplier_id,
            'payment_id' => $this->payment_id,
            'status' => $this->status,
            'net_total' => $this->net_total,
            'discount' => $this->discount,
            'grand_total' => $this->grand_total,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'comments', $this->comments]);
        $query->orderBy("date DESC");
        return $dataProvider;
    }
}
