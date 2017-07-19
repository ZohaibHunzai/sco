<?php

use yii\db\Schema;
use yii\db\Migration;

class m160222_130802_create_secondary_accounts extends Migration
{
     public function up()
    {
        $this->createTable('{{%secondary_accounts}}', [
                'id'                => $this->bigPrimaryKey(),
                'name'              => $this->string(),
                'status'            => $this->integer(),
                'primary_account_id'=> $this->integer(),
                'created_by'        => $this->integer(),
                'updated_by'        => $this->integer(),
                'created_at'        => $this->date(),
                'updated_at'        => $this->date(),
            ]);
    }

    public function down()
    {
       $this->dropTable('{{%secondary_accounts}}');
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
