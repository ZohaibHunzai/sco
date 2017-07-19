<?php

use yii\db\Migration;

class m160228_134300_add_code_to_accounts extends Migration
{
    public function up()
    {
        $this->addColumn('accounts', 'code', $this->integer());
        $this->addColumn('accounts', 'is_system_account', $this->boolean());
    }

    public function down()
    {
        $this->dropColumn('accounts', 'code');
        $this->dropColumn('accounts', 'is_system_account');
    }
}
