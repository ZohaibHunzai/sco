<?php

use yii\db\Migration;

/**
 * Handles adding purchase_return to table `payments`.
 */
class m160722_084547_add_purchase_return_to_payments extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('payments', 'purchase_return', $this->money());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('payments', 'purchase_return');
    }
}
