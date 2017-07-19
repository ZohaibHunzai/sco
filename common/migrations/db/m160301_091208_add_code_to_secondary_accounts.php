<?php

use yii\db\Migration;

class m160301_091208_add_code_to_secondary_accounts extends Migration
{
    public function up()
    {
        $this->addColumn('secondary_accounts', 'code', $this->integer());
    }

    public function down()
    {
        $this->dropColumn('secondary_accounts', 'code');
    }
}
