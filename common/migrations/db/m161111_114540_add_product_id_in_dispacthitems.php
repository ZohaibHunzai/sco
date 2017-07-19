<?php

use yii\db\Migration;

class m161111_114540_add_product_id_in_dispacthitems extends Migration
{
    public function up()
    {
        $this->addColumn('dispacthes_items','product_id', $this->integer());

    }

    public function down()
    {
        $this->dropColumn('dispacthes_items', 'product_id', $this->integer());
                
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
