<?php

use yii\db\Migration;

/**
 * Handles adding tonnage_unit to table `units`.
 */
class m160630_081802_add_tonnage_unit_to_units extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('units', 'tonnage_unit', $this->float());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('units', 'tonnage_unit');
    }
}
