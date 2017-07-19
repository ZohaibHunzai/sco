<?php

use yii\db\Migration;

class m160301_091418_add_code_to_primary_accounts extends Migration
{
    public function up()
    {
        $this->addColumn('primary_accounts', 'code', $this->integer());
    }

    public function down()
    {
        $this->dropColumn('primary_accounts', 'code');
    }
}
