<?php

use yii\db\Migration;

/**
 * Handles adding received_and_paid to table `payments`.
 */
class m160623_165633_add_received_and_paid_to_payments extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('payments', 'received', $this->float());
        $this->addColumn('payments', 'remaining', $this->float());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('payments', 'received');
        $this->dropColumn('payments', 'remaining');
    }
}
