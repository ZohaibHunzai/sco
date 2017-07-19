<?php

use yii\db\Migration;

/**
 * Handles adding return to table `payments`.
 */
class m160722_065239_add_return_to_payments extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('payments', 'sales_return', $this->money());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('payments', 'sales_return');
    }
}
