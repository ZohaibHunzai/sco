<?php

use yii\db\Migration;

/**
 * Handles adding footer to table `printers`.
 */
class m161127_192328_add_footer_to_printers extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('printers', 'footer', $this->string());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('printers', 'footer');
    }
}
