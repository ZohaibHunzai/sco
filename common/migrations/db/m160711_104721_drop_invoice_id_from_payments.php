<?php

use yii\db\Migration;

/**
 * Handles dropping invoice_id from table `payments`.
 */
class m160711_104721_drop_invoice_id_from_payments extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->dropColumn("payments", "invoice_id");
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->addColumn("payments", "invoice_id", $this->integer());
    }
}
