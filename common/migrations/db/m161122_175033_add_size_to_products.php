<?php

use yii\db\Migration;

/**
 * Handles adding size to table `products`.
 */
class m161122_175033_add_size_to_products extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('products', 'size', $this->integer());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('products', 'size');
    }
}
