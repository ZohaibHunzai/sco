<?php

use yii\db\Migration;

/**
 * Handles adding comments to table `sales`.
 */
class m160623_125946_add_comments_to_sales extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('sales', 'comments', $this->string());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('sales', 'comments');
    }
}
