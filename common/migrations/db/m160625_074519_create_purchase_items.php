<?php

use yii\db\Migration;

/**
 * Handles the creation for table `purchase_items`.
 */
class m160625_074519_create_purchase_items extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('purchase_items', [
            'id' => $this->primaryKey(),
            'purchase_id' => $this->integer(),
            'product_id' => $this->integer(),
            'quantity' => $this->integer(),
            'unit_cost' => $this->float(),
            'discount' => $this->float(),
            'total' => $this->float(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('purchase_items');
    }
}
