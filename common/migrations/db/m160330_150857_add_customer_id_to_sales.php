<?php

use yii\db\Migration;

class m160330_150857_add_customer_id_to_sales extends Migration
{
    public function up()
    {
        $this->addColumn('sales', 'customer_id', $this->integer());
    }

    public function down()
    {
        $this->dropColumn('sales', 'customer_id');
    }
}
