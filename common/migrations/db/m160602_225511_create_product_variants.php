<?php

use yii\db\Migration;

class m160602_225511_create_product_variants extends Migration
{
    public function up()
    {
        $this->createTable('product_variants', [
            'id' => $this->primaryKey(),
            'product_id' => $this->integer(),
            'variant_id' => $this->integer(),
        ]);
    }

    public function down()
    {
        $this->dropTable('product_variants');
    }
}
