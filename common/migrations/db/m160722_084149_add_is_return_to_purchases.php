<?php

use yii\db\Migration;

/**
 * Handles adding is_return to table `purchases`.
 */
class m160722_084149_add_is_return_to_purchases extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('purchases', 'is_return', $this->integer());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('purchases', 'is_return');
    }
}
