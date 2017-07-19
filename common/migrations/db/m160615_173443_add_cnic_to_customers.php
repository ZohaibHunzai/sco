<?php

use yii\db\Migration;

/**
 * Handles adding cnic to table `customers`.
 */
class m160615_173443_add_cnic_to_customers extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('customers', 'cnic', $this->string());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('customers', 'cnic');
    }
}
