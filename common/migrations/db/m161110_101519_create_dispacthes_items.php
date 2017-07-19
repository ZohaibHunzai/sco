<?php

use yii\db\Migration;

/**
 * Handles the creation for table `dispacthes_items`.
 */
class m161110_101519_create_dispacthes_items extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('dispacthes_items', [
            'id' => $this->primaryKey(),
            'dispatches_id' => $this->integer(),
            'quantity' => $this->integer(),
            'status' => $this->integer (),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('dispacthes_items');
    }
}
