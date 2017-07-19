<?php

namespace backend\modules\customers\models\query;

/**
 * This is the ActiveQuery class for [[\backend\modules\customers\models\query\Customer]].
 *
 * @see \backend\modules\customers\models\query\Customer
 */
class CustomerQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return \backend\modules\customers\models\query\Customer[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \backend\modules\customers\models\query\Customer|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}