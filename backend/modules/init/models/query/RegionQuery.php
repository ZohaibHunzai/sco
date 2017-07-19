<?php

namespace backend\modules\init\models\query;

/**
 * This is the ActiveQuery class for [[\backend\modules\init\models\query\Region]].
 *
 * @see \backend\modules\init\models\query\Region
 */
class RegionQuery extends \yii\db\ActiveQuery
{
    public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }

    /**
     * @inheritdoc
     * @return \backend\modules\init\models\query\Region[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \backend\modules\init\models\query\Region|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}