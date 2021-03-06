<?php

namespace backend\modules\init\models\query;

/**
 * This is the ActiveQuery class for [[\backend\modules\init\models\query\Unit]].
 *
 * @see \backend\modules\init\models\query\Unit
 */
class UnitQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return \backend\modules\init\models\query\Unit[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \backend\modules\init\models\query\Unit|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}