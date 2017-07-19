<?php

use yii\db\Migration;

/**
 * Handles the creation for table `group_accounts`.
 */
class m160828_160850_create_group_accounts extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('group_accounts', [
            'id' => $this->primaryKey(),
            'account_id' => $this->integer(),
            'group_id' => $this->integer(),
            'status' => $this->integer(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('group_accounts');
    }
}
