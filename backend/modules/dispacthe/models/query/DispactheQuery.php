<?php

namespace backend\modules\dispacthe\models\query;

/**
 * This is the ActiveQuery class for [[\backend\modules\dispacthe\models\query\Dispacthe]].
 *
 * @see \backend\modules\dispacthe\models\query\Dispacthe
 */
class DispactheQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return \backend\modules\dispacthe\models\query\Dispacthe[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \backend\modules\dispacthe\models\query\Dispacthe|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}