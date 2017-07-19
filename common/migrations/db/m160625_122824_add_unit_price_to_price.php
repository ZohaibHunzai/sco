<?php

use yii\db\Migration;

/**
 * Handles adding unit_price to table `price`.
 */
class m160625_122824_add_unit_price_to_price extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('price', 'unit_selling_price', $this->float());
        $this->addColumn('price', 'unit_purchase_price', $this->float());
        $this->addColumn('price', 'total_units', $this->integer());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('price', 'unit_selling_price');
        $this->dropColumn('price', 'unit_purchase_price');
        $this->dropColumn('price', 'total_units');
    }
}
