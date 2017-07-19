<?php

namespace backend\modules\accounts\models\search;

use backend\modules\accounts\models\Account;
use backend\modules\customers\models\base\Customer;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\accounts\models\Transaction;

/**
 * TransactionSearch represents the model behind the search form about `backend\modules\accounts\models\Transaction`.
 */
class TransactionSearch extends Transaction
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'status', 'account_id', 'created_by', 'updated_by', 'deleted_by', 'mode', 'type', 'approved_by', 'group', 'branch_id'], 'integer'],
            [['name', 'narration', 'created_at', 'updated_at', 'deleted_at', 'approved_at'], 'safe'],
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
        $query = Transaction::find()->active();

        $query->orderBy('created_at DESC, type');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'status' => $this->status,
            'account_id' => $this->account_id,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'deleted_at' => $this->deleted_at,
            'deleted_by' => $this->deleted_by,
            'mode' => $this->mode,
            'type' => $this->type,
            'approved_by' => $this->approved_by,
            'approved_at' => $this->approved_at,
            'group' => $this->group,
            'branch_id' => $this->branch_id,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'narration', $this->narration]);

        return $dataProvider;
    }


    /**
     *
     */
    public function getSomething(){
        
    }

    
}
