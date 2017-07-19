<?php

use yii\db\Migration;

/**
 * Handles adding is_return to table `sales`.
 */
class m160722_062154_add_is_return_to_sales extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('sales', 'is_return', $this->integer());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('sales', 'is_return');
    }
}
