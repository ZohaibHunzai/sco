<?php

namespace backend\modules\init\models\query;

/**
 * This is the ActiveQuery class for [[\backend\modules\init\models\query\BrandSector]].
 *
 * @see \backend\modules\init\models\query\BrandSector
 */
class BrandSectorQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return \backend\modules\init\models\query\BrandSector[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \backend\modules\init\models\query\BrandSector|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}