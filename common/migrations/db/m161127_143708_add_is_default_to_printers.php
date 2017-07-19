<?php

use yii\db\Migration;

/**
 * Handles adding is_default to table `printers`.
 */
class m161127_143708_add_is_default_to_printers extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('printers', 'is_default', $this->integer());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('printers', 'is_default');
    }
}
