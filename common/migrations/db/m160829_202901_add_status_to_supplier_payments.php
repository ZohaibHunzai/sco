<?php

use yii\db\Migration;

/**
 * Handles adding status to table `supplier_payments`.
 */
class m160829_202901_add_status_to_supplier_payments extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('supplier_payments', 'status', $this->integer());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('supplier_payments', 'status');
    }
}
