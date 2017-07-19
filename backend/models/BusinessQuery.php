<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[\app\models\Business]].
 *
 * @see \app\models\Business
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
     * @return \app\models\Business[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \app\models\Business|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}