<?php

use yii\db\Migration;

/**
 * Handles dropping column from table `accounts`.
 */
class m161115_085125_drop_column_from_accounts extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->dropColumn('accounts','group_id', $this->integer());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('accounts','group_id', $this->integer());
        
    }
}
