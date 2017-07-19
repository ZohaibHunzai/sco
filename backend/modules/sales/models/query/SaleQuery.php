<?php

namespace backend\modules\sales\models\query;

/**
 * This is the ActiveQuery class for [[\backend\modules\sales\models\query\Sale]].
 *
 * @see \backend\modules\sales\models\query\Sale
 */
class SaleQuery extends \yii\db\ActiveQuery
{
    public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }

    /**
     * @inheritdoc
     * @return \backend\modules\sales\models\query\Sale[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \backend\modules\sales\models\query\Sale|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}