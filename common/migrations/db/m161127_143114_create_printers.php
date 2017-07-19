<?php

use yii\db\Migration;

/**
 * Handles the creation for table `printers`.
 */
class m161127_143114_create_printers extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('printers', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'description' => $this->string(),
            'type' => $this->integer(),
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
        $this->dropTable('printers');
    }
}
