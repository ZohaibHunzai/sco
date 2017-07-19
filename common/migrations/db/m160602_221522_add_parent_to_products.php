<?php

use yii\db\Migration;

class m160602_221522_add_parent_to_products extends Migration
{
    public function up()
    {
        $this->addColumn('products', 'parent', $this->integer());
    }

    public function down()
    {
        $this->dropColumn('products', 'parent');
    }
}
