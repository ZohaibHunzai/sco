<?php

use yii\db\Migration;

/**
 * Handles adding status to table `suppliers`.
 */
class m160829_194243_add_status_to_suppliers extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('suppliers', 'status', $this->integer());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('suppliers', 'status');
    }
}
