<?php

namespace backend\modules\business\models\query;

/**
 * This is the ActiveQuery class for [[\backend\modules\business\models\query\Business]].
 *
 * @see \backend\modules\business\models\query\Business
 */
class BusinessQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return \backend\modules\business\models\query\Business[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \backend\modules\business\models\query\Business|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}