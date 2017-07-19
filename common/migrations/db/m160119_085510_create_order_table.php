<?php

use yii\db\Schema;
use yii\db\Migration;

class m160119_085510_create_order_table extends Migration
{
    public function up()
    {
        $this->createTable('{{%order}}', [
                'id'             => $this->bigPrimaryKey(),
                'order_id'       => $this->integer(),
                'type'           => $this->smallInteger(),
                'status'         => $this->smallInteger(),
                'date'           => $this->date('d/m/y'),
                'is_delivered'   => $this->smallInteger(),
                'created_by'     => $this->integer(),
                'updated_by'     => $this->integer(),
                'created_at'     => $this->date(),
                'updated_at'     => $this->date(),
            ]);
    }

    public function down()
    {
       $this->dropTable('{{%order}}');
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
