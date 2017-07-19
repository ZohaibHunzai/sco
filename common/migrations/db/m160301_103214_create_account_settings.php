<?php

use yii\db\Migration;

class m160301_103214_create_account_settings extends Migration
{
    public function up()
    {
        $this->createTable('account_settings', [
            'id' => $this->primaryKey(),
            'key' => $this->integer(),
            'value' => $this->integer(),
            'type' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer(),
            'created_at' => $this->timestamp(),
            'updated_at' => $this->timestamp(),
        ]);
    }

    public function down()
    {
        $this->dropTable('account_settings');
    }
}
