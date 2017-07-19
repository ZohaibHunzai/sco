<?php

use yii\db\Migration;

/**
 * Handles adding total_tonnage to table `sales`.
 */
class m160630_123638_add_total_tonnage_to_sales extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('sales', 'total_tonnage', $this->float());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('sales', 'total_tonnage');
    }
}
