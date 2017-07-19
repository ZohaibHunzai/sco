<?php

use yii\db\Migration;

/**
 * Handles the creation for table `stores`.
 */
class m160615_153042_create_stores extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('stores', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'code' => $this->integer(),
            'status' => $this->integer(),
            'created_at' => $this->timestamp(),
            'updated_at' => $this->timestamp(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('stores');
    }
}
