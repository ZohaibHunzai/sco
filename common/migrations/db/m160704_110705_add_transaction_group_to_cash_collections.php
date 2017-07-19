<?php

use yii\db\Migration;

/**
 * Handles adding transaction_group to table `cash_collections`.
 */
class m160704_110705_add_transaction_group_to_cash_collections extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('cash_collections', 'transaction_group', $this->integer());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('cash_collections', 'transaction_group');
    }
}
