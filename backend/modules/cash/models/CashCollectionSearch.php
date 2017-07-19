<?php

namespace backend\modules\cash\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\cash\models\CashCollection;

/**
 * backend\modules\cash\models\CashCollectionSearch represents the model behind the search form about `backend\modules\cash\models\CashCollection`.
 */
 class CashCollectionSearch extends CashCollection
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'customer_id', 'sales_person_id', 'created_by', 'updated_by', 'status', 'sale_id'], 'integer'],
            [['date', 'created_at', 'updated_at'], 'safe'],
            [['amount'], 'number'],
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
        $query = CashCollection::find()->active();
        $query->orderBy('date DESC, created_by DESC');
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query = dateRangeFilter($query, $this, 'date');
        
        $query->andFilterWhere([
            'id' => $this->id,
            'customer_id' => $this->customer_id,
            'amount' => $this->amount,
            'sales_person_id' => $this->sales_person_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'status' => $this->status,
            'sale_id' => $this->sale_id,
        ]);
        return $dataProvider;
    }
}
