<?php

use yii\db\Migration;

class m160331_075540_add_date_to_invoices extends Migration
{
    public function up()
    {
        $this->addColumn('invoices', 'date', $this->date());
    }

    public function down()
    {
        $this->dropColumn('invoices', 'date');
    }
}
