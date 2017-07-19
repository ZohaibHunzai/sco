<?php

namespace backend\modules\product\models\query;

/**
 * This is the ActiveQuery class for [[\backend\modules\product\models\query\ProductVariantList]].
 *
 * @see \backend\modules\product\models\query\ProductVariantList
 */
class ProductVariantListQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return \backend\modules\product\models\query\ProductVariantList[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \backend\modules\product\models\query\ProductVariantList|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}