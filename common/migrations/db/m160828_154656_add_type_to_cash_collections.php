<?php

use yii\db\Migration;

/**
 * Handles adding type to table `cash_collections`.
 */
class m160828_154656_add_type_to_cash_collections extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('cash_collections', 'type', $this->integer());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('cash_collections', 'type');
    }
}
