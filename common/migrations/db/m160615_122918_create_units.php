<?php

use yii\db\Migration;

/**
 * Handles the creation for table `units`.
 */
class m160615_122918_create_units extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('units', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'symbol' => $this->string(10),
            'status' => $this->integer(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('units');
    }
}
