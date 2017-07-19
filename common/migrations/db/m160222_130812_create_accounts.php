<?php

use yii\db\Schema;
use yii\db\Migration;

class m160222_130812_create_accounts extends Migration
{
   public function up()
    {
        $this->createTable('{{%accounts}}', [
                'id'                => $this->bigPrimaryKey(),
                'name'              => $this->string(),
                'status'            => $this->integer(),
                'primary_account_id'=> $this->integer(),
                'secondary_account_id'=> $this->integer(),
                'created_by'        => $this->integer(),
                'updated_by'        => $this->integer(),
                'created_at'        => $this->date(),
                'updated_at'        => $this->date(),
            ]);
    }

    public function down()
    {
       $this->dropTable('{{%accounts}}');
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
