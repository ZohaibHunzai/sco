<?php

use yii\db\Migration;

/**
 * Handles the creation for table `dispacthes`.
 */
class m161110_112607_create_dispacthes extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('dispacthes', [
            'id' => $this->primaryKey(),
            'store_id'  => $this->integer(),
            'type'      => $this->integer(),
            'status'    => $this->integer(),
            'comments'  => $this->string(300),
            'date'      => $this->timestamp(),
            'created_at' => $this->timestamp(),
            'created_by' => $this->integer(),
            'updated_at'=> $this->timestamp(),
            'updated_by'=> $this->integer(),
            'deleted_at'=> $this->timestamp(),
            'deleted_by'=> $this->integer(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('dispacthes');
    }
}
