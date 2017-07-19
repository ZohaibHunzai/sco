<?php

use yii\db\Migration;

/**
 * Handles adding brand_sector_id to table `brands`.
 */
class m160615_115708_add_brand_sector_id_to_brands extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('brands', 'brand_sector_id', $this->integer());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('brands', 'brand_sector_id');
    }
}
