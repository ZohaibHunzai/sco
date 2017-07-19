<?php

use yii\db\Migration;

/**
 * Handles the creation for table `brand_sectors`.
 */
class m160615_113121_create_brand_sectors extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('brand_sectors', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer(),
            'created_at' => $this->timestamp(),
            'updated_at' => $this->timestamp(),
            'status' => $this->smallInteger(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('brand_sectors');
    }
}
