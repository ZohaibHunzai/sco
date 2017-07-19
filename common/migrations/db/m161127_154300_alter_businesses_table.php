<?php

use yii\db\Migration;

class m161127_154300_alter_businesses_table extends Migration
{
    public function up()
    {
        $this->dropColumn("businesses", "phone_number");
        $this->addColumn("businesses", "phone_number", $this->string());
    }

    public function down()
    {
        $this->dropColumn("businesses", "phone_number");
        $this->addColumn("businesses", "phone_number", $this->integer());

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
