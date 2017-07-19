<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `products`.
 */
class m160615_123935_add_columns_to_products extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn("products", "unit_id", $this->float());
        $this->addColumn("products", "units_per_carton", $this->float());
        $this->addColumn("products", "minimum_stock_level", $this->float());
        $this->addColumn("products", "unit_weight", $this->float());
        $this->addColumn("products", "total_weight", $this->float());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn("products", 'total_weight');
        $this->dropColumn("products", 'unit_weight');
        $this->dropColumn("products", 'minimum_stock_level');
        $this->dropColumn("products", 'units_per_carton');
        $this->dropColumn("products", 'unit_id');
    }
}
