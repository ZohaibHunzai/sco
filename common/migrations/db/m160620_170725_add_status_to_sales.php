<?php

use yii\db\Migration;

/**
 * Handles adding status to table `sales`.
 */
class m160620_170725_add_status_to_sales extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('sales', 'status', $this->integer());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('sales', 'status');
    }
}
