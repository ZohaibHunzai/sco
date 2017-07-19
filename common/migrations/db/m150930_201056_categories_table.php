<?php

use yii\db\Schema;
use yii\db\Migration;

class m150930_201056_categories_table extends Migration
{
    public function up()
    {
        $this->createTable('{{%categories}}', [
                'id'            => $this->bigPrimaryKey(),
                'name'          => $this->string(128),
                'parent_id'     => $this->bigInteger(),
            ]);
    }

    public function down()
    {
        $this->dropTable('{{%categories}}');
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
