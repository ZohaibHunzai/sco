<?php

use yii\db\Migration;

/**
 * Handles adding bill_no to table `dispacthes`.
 */
class m161207_113951_add_bill_no_to_dispacthes extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('dispacthes', 'bill_no', $this->integer());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('dispacthes', 'bill_no');
    }
}
