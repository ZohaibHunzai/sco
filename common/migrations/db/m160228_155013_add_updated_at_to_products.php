<?php

use yii\db\Migration;

class m160228_155013_add_updated_at_to_products extends Migration
{
    public function up()
    {
        $this->addColumn('products', 'created_at', $this->timestamp());
        $this->addColumn('products', 'updated_at', $this->timestamp());
        $this->addColumn('products', 'created_by', $this->integer());
        $this->addColumn('products', 'updated_by', $this->integer());
    }

    public function down()
    {
        $this->dropColumn('products', 'created_at');
        $this->dropColumn('products', 'updated_at');
        $this->dropColumn('products', 'created_by');
        $this->dropColumn('products', 'updated_by');
    }
}
