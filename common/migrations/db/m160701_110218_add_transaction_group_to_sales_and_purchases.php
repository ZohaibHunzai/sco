<?php

use yii\db\Migration;

/**
 * Handles adding transaction_group to table `sales_and_purchases`.
 */
class m160701_110218_add_transaction_group_to_sales_and_purchases extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('sales', 'transaction_group', $this->integer());
        $this->addColumn('purchases', 'transaction_group', $this->integer());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('sales', 'transaction_group');
        $this->dropColumn('purchases', 'transaction_group');
    }
}
