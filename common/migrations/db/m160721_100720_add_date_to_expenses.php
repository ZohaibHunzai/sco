<?php

use yii\db\Migration;

/**
 * Handles adding date to table `expenses`.
 */
class m160721_100720_add_date_to_expenses extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('expenses', 'date', $this->date());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('expenses', 'date');
    }
}
