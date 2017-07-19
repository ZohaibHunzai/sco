<?php

use yii\db\Migration;

class m160305_095632_add_code_to_products extends Migration
{
    public function up()
    {
        $this->addColumn('products', 'code', $this->integer());
    }

    public function down()
    {
        $this->dropColumn('products', 'code');
    }
}
