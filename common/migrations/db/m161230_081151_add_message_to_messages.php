<?php

use yii\db\Migration;

/**
 * Handles adding message to table `messages`.
 */
class m161230_081151_add_message_to_messages extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('messages', 'message', $this->string(1000));
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('messages', 'message');
    }
}
