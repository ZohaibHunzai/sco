<?php

use yii\db\Migration;

class m160301_144844_add_name_to_account_settings extends Migration
{
    public function up()
    {
        $this->addColumn('account_settings', 'name', $this->string());
    }

    public function down()
    {
        $this->dropColumn('account_settings', 'name');
    }
}
