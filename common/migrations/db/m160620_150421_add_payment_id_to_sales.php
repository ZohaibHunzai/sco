<?php

use yii\db\Migration;

/**
 * Handles adding payment_id to table `sales`.
 */
class m160620_150421_add_payment_id_to_sales extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('sales', 'payment_id', $this->integer());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('sales', 'payment_id');
    }
}
