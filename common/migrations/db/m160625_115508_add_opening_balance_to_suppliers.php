<?php

use yii\db\Migration;

/**
 * Handles adding opening_balance to table `suppliers`.
 */
class m160625_115508_add_opening_balance_to_suppliers extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('suppliers', 'opening_balance', $this->float());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('suppliers', 'opening_balance');
    }
}
