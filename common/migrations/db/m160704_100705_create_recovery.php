<?php

use yii\db\Migration;

/**
 * Handles the creation for table `recovery`.
 */
class m160704_100705_create_recovery extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('cash_collections', [
            'id' => $this->primaryKey(),
            'customer_id' => $this->integer(),
            'date' => $this->date(),
            'amount' => $this->float(),
            'sales_person_id' => $this->integer(),
            'created_at' => $this->timestamp(),
            'updated_at' => $this->timestamp(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer(),
            'status' => $this->integer(),
            'sale_id' => $this->integer(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('cash_collections');
    }
}
