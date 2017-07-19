<?php

use yii\db\Migration;

/**
 * Handles the creation for table `regions`.
 */
class m160615_110549_create_regions extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('regions', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'code' => $this->string(128),
            'status' => $this->smallInteger(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('regions');
    }
}
