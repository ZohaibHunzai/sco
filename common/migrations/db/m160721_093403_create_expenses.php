<?php

use yii\db\Migration;

/**
 * Handles the creation for table `expenses`.
 */
class m160721_093403_create_expenses extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('expenses', [
            'id' => $this->primaryKey(),
            'comment' => $this->string(),
            'amount' => $this->money(),
            'payment_type' => $this->integer(),
            'transaction_group' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer(),
            'created_at' => $this->timestamp(),
            'updated_at' => $this->timestamp(),
            'status' => $this->integer(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('expenses');
    }
}
