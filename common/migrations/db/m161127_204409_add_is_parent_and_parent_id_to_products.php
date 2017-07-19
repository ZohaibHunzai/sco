<?php

use yii\db\Migration;

/**
 * Handles adding is_parent_and_parent_id to table `products`.
 */
class m161127_204409_add_is_parent_and_parent_id_to_products extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('products', 'is_parent', $this->integer());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('products', 'is_parent');
    }
}
