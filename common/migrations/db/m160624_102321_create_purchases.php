<?php

use yii\db\Migration;

/**
 * Handles the creation for table `purchases`.
 */
class m160624_102321_create_purchases extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('purchases', [
            'id' => $this->primaryKey(),
            'order_id' => $this->integer(),
            'date' => $this->date(),
            'store_id' => $this->integer(),
            'comments' => $this->string(),
            'supplier_id' => $this->integer(),
            'payment_id' => $this->integer(),
            'status' => $this->integer(),
            'net_total' => $this->float(),
            'discount' => $this->float(),
            'grand_total' => $this->float(),

            'created_by' => $this->integer(),
            'updated_by' => $this->integer(),
            'created_at' => $this->timestamp(),
            'updated_at' => $this->timestamp(),

        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('purchases');
    }
}
