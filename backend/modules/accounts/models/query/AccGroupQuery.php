<?php

namespace backend\modules\accounts\models\query;

/**
 * This is the ActiveQuery class for [[\backend\modules\accounts\models\query\AccGroup]].
 *
 * @see \backend\modules\accounts\models\query\AccGroup
 */
class AccGroupQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return \backend\modules\accounts\models\query\AccGroup[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \backend\modules\accounts\models\query\AccGroup|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}