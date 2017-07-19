<?php

use yii\db\Migration;

/**
 * Handles the creation for table `acc_groups`.
 */
class m160712_103043_create_acc_groups extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('acc_groups', [
            'id' => $this->primaryKey(),
            'name' => $this->string(20),
            'code' => $this->integer(11),
            'status' => $this->integer(10),
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
        $this->dropTable('acc_groups');
    }
}
