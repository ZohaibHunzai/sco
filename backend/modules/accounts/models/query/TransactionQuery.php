<?php

namespace backend\modules\accounts\models\query;

/**
 * This is the ActiveQuery class for [[\backend\modules\accounts\models\query\Transaction]].
 *
 * @see \backend\modules\accounts\models\query\Transaction
 */
class TransactionQuery extends \yii\db\ActiveQuery
{
    public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }

    public function deleted()
    {
        $this->andWhere('[[status]]=0');
        return $this;
    }


    /**
     * @inheritdoc
     * @return \backend\modules\accounts\models\query\Transaction[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \backend\modules\accounts\models\query\Transaction|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}