<?php

use yii\db\Migration;

/**
 * Handles adding sales_person_id to table `sales`.
 */
class m160701_182136_add_sales_person_id_to_sales extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('sales', 'sales_person_id', $this->integer());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('sales', 'sales_person_id');
    }
}
