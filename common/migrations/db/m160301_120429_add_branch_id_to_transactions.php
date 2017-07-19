<?php

use yii\db\Migration;

class m160301_120429_add_branch_id_to_transactions extends Migration
{
    public function up()
    {
    	$this->addColumn("transactions", "branch_id", $this->integer());
    }

    public function down()
    {
    	$this->removeColumn("transactions", "branch_id");
    }
}
