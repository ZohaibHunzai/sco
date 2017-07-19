<?php

use yii\db\Migration;

/**
 * Handles the creation for table `towns`.
 */
class m160615_171624_create_towns extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('towns', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'region_id' => $this->integer(),
            'created_at' => $this->timestamp(),
            'updated_at' => $this->timestamp(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer(),
            'status' => $this->integer(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('towns');
    }
}
