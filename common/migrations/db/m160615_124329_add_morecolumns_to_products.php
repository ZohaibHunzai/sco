<?php

use yii\db\Migration;

/**
 * Handles adding morecolumns to table `products`.
 */
class m160615_124329_add_morecolumns_to_products extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('products', 'brand_id', $this->integer());
        $this->addColumn('products', 'brand_sector_id', $this->integer());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('products', 'brand_sector_id');
        $this->dropColumn('products', 'brand_id');
    }
}
