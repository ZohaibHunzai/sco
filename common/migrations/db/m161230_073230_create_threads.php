<?php

use yii\db\Migration;

/**
 * Handles the creation for table `threads`.
 */
class m161230_073230_create_threads extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('threads', [
            'id' => $this->primaryKey(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer(),
            'created_at' => $this->timestamp(),
            'updated_at' => $this->timestamp(),
            'created_for' => $this->integer(),
            'deleted_by' => $this->integer(),
            'status' => $this->integer(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('threads');
    }
}
