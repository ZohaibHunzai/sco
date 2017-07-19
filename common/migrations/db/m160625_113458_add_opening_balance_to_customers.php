<?php

use yii\db\Migration;

/**
 * Handles adding opening_balance to table `customers`.
 */
class m160625_113458_add_opening_balance_to_customers extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('customers', 'opening_balance', $this->float());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('customers', 'opening_balance');
    }
}
