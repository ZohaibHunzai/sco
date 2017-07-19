<?php

use yii\db\Migration;

/**
 * Handles adding quantity_unit to table `sale_items`.
 */
class m160630_081058_add_quantity_unit_to_sale_items extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('sale_items', 'quantity_unit', $this->integer());
        $this->addColumn('sale_items', 'tonnage', $this->float());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('sale_items', 'quantity_unit');
        $this->dropColumn('sale_items', 'tonnage');
    }
}
