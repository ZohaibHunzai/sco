<?php

use yii\db\Migration;

/**
 * Handles adding total to table `sale_items`.
 */
class m160624_092506_add_total_to_sale_items extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('sale_items', 'total', $this->float());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('sale_items', 'total');
    }
}
