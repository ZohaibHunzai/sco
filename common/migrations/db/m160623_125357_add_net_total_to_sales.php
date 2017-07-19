<?php

use yii\db\Migration;

/**
 * Handles adding net_total to table `sales`.
 */
class m160623_125357_add_net_total_to_sales extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('sales', 'net_total', $this->float());
        $this->addColumn('sales', 'discount', $this->float());
        $this->addColumn('sales', 'grand_total', $this->float());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('sales', 'net_total');
        $this->dropColumn('sales', 'discount');
        $this->dropColumn('sales', 'grand_total');
    }
}
