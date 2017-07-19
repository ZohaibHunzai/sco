<?php

use yii\db\Migration;

/**
 * Handles dropping someclumns from table `products`.
 */
class m160615_124538_drop_someclumns_from_products extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->dropColumn('products', 'unit');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->addColumn('products', 'unit', $this->integer());
    }
}
