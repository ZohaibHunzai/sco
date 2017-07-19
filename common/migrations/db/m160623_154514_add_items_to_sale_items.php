<?php

use yii\db\Migration;

/**
 * Handles adding items to table `sale_items`.
 */
class m160623_154514_add_items_to_sale_items extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn("sale_items", "discount", $this->float());
        // $this->addColumn("sale_items", "discount", $this->float());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn("sale_items", "discount");
    }
}
