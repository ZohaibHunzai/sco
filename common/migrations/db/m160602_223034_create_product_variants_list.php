<?php

use yii\db\Migration;

class m160602_223034_create_product_variants_list extends Migration
{
    public function up()
    {
        $this->createTable('product_variants_list', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'status' => $this->integer(),
        ]);
    }

    public function down()
    {
        $this->dropTable('product_variants_list');
    }
}
