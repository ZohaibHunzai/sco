<?php

use yii\db\Migration;

class m160301_121134_add_amount_to_transactions extends Migration
{
    public function up()
    {
        $this->addColumn('transactions', 'amount', $this->float());
    }

    public function down()
    {
        $this->dropColumn('transactions', 'amount');
    }
}
