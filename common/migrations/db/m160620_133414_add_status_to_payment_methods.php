<?php

use yii\db\Migration;

/**
 * Handles adding status to table `payment_methods`.
 */
class m160620_133414_add_status_to_payment_methods extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('payment_methods', 'status', $this->integer());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('payment_methods', 'status');
    }
}
