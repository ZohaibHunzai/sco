<?php

namespace backend\modules\business\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\business\models\Business;

/**
 * backend\modules\business\models\BusinessSearch represents the model behind the search form about `backend\modules\business\models\Business`.
 */
 class BusinessSearch extends Business
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'phone_number', 'photo_id', 'created_by', 'updated_by'], 'integer'],
            [['name', 'address', 'invoice_header', 'invoice_footer', 'created_at', 'updated_at'], 'safe'],
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
        $query = Business::find();

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
            'phone_number' => $this->phone_number,
            'photo_id' => $this->photo_id,
            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
            'updated_at' => $this->updated_at,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'invoice_header', $this->invoice_header])
            ->andFilterWhere(['like', 'invoice_footer', $this->invoice_footer]);

        return $dataProvider;
    }
}
