<?php

use yii\db\Migration;

/**
 * Handles the creation for table `supplier_payments`.
 */
class m160712_073059_create_supplier_payments extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('supplier_payments', [
            'id' => $this->primaryKey(),
            'date' => $this->date(),
            'amount' => $this->money(),
            'supplier_id' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer(),
            'created_at' => $this->timestamp(),
            'updated_at' => $this->timestamp(),
            'transaction_group' => $this->integer() . " DEFAULT NULL",
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('supplier_payments');
    }
}
