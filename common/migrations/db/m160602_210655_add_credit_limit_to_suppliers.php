<?php

use yii\db\Migration;

class m160602_210655_add_credit_limit_to_suppliers extends Migration
{
    public function up()
    {
        $this->addColumn('suppliers', 'credit_limit', $this->float());
    }

    public function down()
    {
        $this->dropColumn('suppliers', 'credit_limit');
    }
}
