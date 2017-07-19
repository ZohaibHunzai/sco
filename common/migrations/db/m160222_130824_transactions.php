<?php

use yii\db\Schema;
use yii\db\Migration;

class m160222_130824_transactions extends Migration
{
   public function up()
    {
        $this->createTable('{{%transactions}}', [
                'id'                => $this->bigPrimaryKey(),
                'name'              => $this->string(),
                'narration'              => $this->string(),
                'status'            => $this->integer(),
                'account_id'        => $this->integer(),
                'transaction_type'  => $this->integer(),
                'created_by'        => $this->integer(),
                'updated_by'        => $this->integer(),
                'created_at'        => $this->timestamp(),
                'updated_at'        => $this->timestamp(),
                'deleted_at'        => $this->timestamp(),
                'deleted_by'        => $this->integer(),
                'mode'              => $this->integer(),
                'type'              => $this->integer(),
                'approved_by'       => $this->integer(),
                'approved_at'       => $this->timestamp(),
                'group'             => $this->integer(),
            ]);
    }

    public function down()
    {
       $this->dropTable('{{%transactions}}');
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
