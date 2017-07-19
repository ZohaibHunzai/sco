<?php

use yii\db\Schema;
use yii\db\Migration;

class m160222_130745_create_primary_accounts extends Migration
{
      public function up()
    {
        $this->createTable('{{%primary_accounts}}', [
                'id'             => $this->bigPrimaryKey(),
                'name'           => $this->string(),
                'status'         => $this->integer(),
                'created_by'     => $this->integer(),
                'updated_by'     => $this->integer(),
                'created_at'     => $this->date(),
                'updated_at'     => $this->date(),
            ]);
    }

    public function down()
    {
       $this->dropTable('{{%primary_accounts}}');
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
