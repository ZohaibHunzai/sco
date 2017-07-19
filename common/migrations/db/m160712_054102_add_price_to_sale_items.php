<?php

use yii\db\Migration;

/**
 * Handles adding price to table `sale_items`.
 */
class m160712_054102_add_price_to_sale_items extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('sale_items', 'price', $this->money()) . " DEFAULT NULL";
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('sale_items', 'price');
    }
}
