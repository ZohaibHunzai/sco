<?php

namespace backend\modules\sales\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\sales\models\SaleItem;

/**
 * backend\modules\sales\models\SaleItemSearch represents the model behind the search form about `backend\modules\sales\models\SaleItem`.
 */
 class SaleItemSearch extends SaleItem
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'sale_id', 'product_id', 'created_by', 'updated_by', 'quantity', 'quantity_unit'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['discount', 'total', 'tonnage'], 'number'],
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
        $query = SaleItem::find();

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
            'sale_id' => $this->sale_id,
            'product_id' => $this->product_id,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'quantity' => $this->quantity,
            'discount' => $this->discount,
            'total' => $this->total,
            'quantity_unit' => $this->quantity_unit,
            'tonnage' => $this->tonnage,
        ]);

        return $dataProvider;
    }
}
