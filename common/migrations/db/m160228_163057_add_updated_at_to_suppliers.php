<?php

use yii\db\Migration;

class m160228_163057_add_updated_at_to_suppliers extends Migration
{
    public function up()
    {
        $this->addColumn('suppliers', 'created_at', $this->timestamp());
        $this->addColumn('suppliers', 'updated_at', $this->timestamp());
        $this->addColumn('suppliers', 'created_by', $this->integer());
        $this->addColumn('suppliers', 'updated_by', $this->integer());
    }

    public function down()
    {
        $this->dropColumn('suppliers', 'created_at');
        $this->dropColumn('suppliers', 'updated_at');
        $this->dropColumn('suppliers', 'created_by');
        $this->dropColumn('suppliers', 'updated_by');
    }
}
