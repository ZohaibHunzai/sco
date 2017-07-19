<?php

use yii\db\Migration;

/**
 * Handles adding town_id_and_region_id to table `customers`.
 */
class m160615_173025_add_town_id_and_region_id_to_customers extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('customers', 'town_id', $this->integer());
        $this->addColumn('customers', 'region_id', $this->integer());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('customers', 'town_id');
        $this->dropColumn('customers', 'region_id');
    }
}
