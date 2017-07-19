<?php

use yii\db\Migration;

/**
 * Handles adding sales_person to table `customers`.
 */
class m160701_154641_add_sales_person_to_customers extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('customers', 'sales_person_id', $this->integer());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('customers', 'sales_person_id');
    }
}
