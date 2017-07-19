<?php

use yii\db\Migration;

class m160305_093359_add_created_at_to_customers extends Migration
{
    public function up()
    {
        $this->addColumn('customers', 'created_at', $this->timestamp());
        $this->addColumn('customers', 'updated_at', $this->timestamp());
        $this->addColumn('customers', 'created_by', $this->integer());
        $this->addColumn('customers', 'updated_by', $this->integer());
    }

    public function down()
    {
        $this->dropColumn('customers', 'created_at');
        $this->dropColumn('customers', 'updated_at');
        $this->dropColumn('customers', 'created_by');
        $this->dropColumn('customers', 'updated_by');
    }
}
