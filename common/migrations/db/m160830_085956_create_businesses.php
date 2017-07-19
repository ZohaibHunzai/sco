<?php

use yii\db\Migration;

/**
 * Handles the creation for table `businesses`.
 */
class m160830_085956_create_businesses extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('businesses', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'address' => $this->string(200),
            'phone_number' => $this->integer(15),
            'photo_id' => $this->integer(),
            'invoice_header' => $this->string(1000),
            'invoice_footer' => $this->string(1000),
            'created_at' => $this->timestamp(),
            'created_by' => $this->integer(),
            'updated_at' => $this->timestamp(),
            'updated_by' => $this->integer(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('businesses');
    }
}
