<?php

namespace backend\modules\sales\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\sales\models\Sale;

/**
 * backend\modules\sales\models\SaleSearch represents the model behind the search form about `backend\modules\sales\models\Sale`.
 */
 class SaleSearch extends Sale
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'order_id', 'store_id', 'created_by', 'updated_by', 'customer_id'], 'integer'],
            [['date', 'created_at','is_return', 'updated_at', 'comment'], 'safe'],
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
        $query = Sale::find()->active();
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
            'order_id' => $this->order_id,
            'store_id' => $this->store_id,
            // 'date' => $this->date,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'is_return' => $this->is_return,
            'customer_id' => $this->customer_id,
        ]);

        $query->andFilterWhere(['like', 'comment', $this->comment]);
        // $this->is_return = 0;
        return $dataProvider;
    }
}
