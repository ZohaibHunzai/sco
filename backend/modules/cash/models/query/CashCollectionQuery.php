<?php

namespace backend\modules\cash\models\query;

/**
 * This is the ActiveQuery class for [[\backend\modules\cash\models\query\CashCollection]].
 *
 * @see \backend\modules\cash\models\query\CashCollection
 */
class CashCollectionQuery extends \yii\db\ActiveQuery
{
    public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }

    /**
     * @inheritdoc
     * @return \backend\modules\cash\models\query\CashCollection[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \backend\modules\cash\models\query\CashCollection|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}