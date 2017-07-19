<?php

use yii\db\Migration;

class m160331_075430_add_location_id_to_invoices extends Migration
{
    public function up()
    {
        $this->addColumn('invoices', 'location_id', $this->integer());
    }

    public function down()
    {
        $this->dropColumn('invoices', 'location_id');
    }
}
