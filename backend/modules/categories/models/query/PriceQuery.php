<?php

namespace backend\modules\categories\models\query;

/**
 * This is the ActiveQuery class for [[\backend\modules\categories\models\query\Price]].
 *
 * @see \backend\modules\categories\models\query\Price
 */
class PriceQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return \backend\modules\categories\models\query\Price[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \backend\modules\categories\models\query\Price|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}