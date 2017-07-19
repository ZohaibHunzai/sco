<?php

use yii\db\Migration;

class m161224_113338_adds_indexes_to_db extends Migration
{
    
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {

        # create only index
        $this->createIndex("parent_id_index", "products", 'parent');
        
        # make all foriegn keys big integer
        $this->alterColumn(
            "sale_items", 
            "product_id", 
            $this->bigInteger()
        );
        
        $this->alterColumn(
            "purchase_items", 
            "product_id", 
            $this->bigInteger()
        );
        
        $this->alterColumn(
            "dispacthes_items", 
            "product_id", 
            $this->bigInteger()
        );

        # foriegn keys
        $this->addForeignKey(
                "product_id_index_in_sales_items", 
                "sale_items", 
                "product_id", 
                "products", 
                "id"
            );
        
        $this->addForeignKey(
            "product_id_index_in_purchase_items", 
            "purchase_items", 
            "product_id", 
            "products", 
            "id"
        );
        
        $this->addForeignKey(
            "product_id_index_in_dispacthes_items", 
            "dispacthes_items", 
            "product_id", 
            "products", 
            "id"
        );

       
    }

    public function safeDown()
    {
        $this->dropIndex("parent_id_index", "products");

        $this->dropForeignKey("product_id_index_in_sales_items", "sale_items");
        $this->dropForeignKey("product_id_index_in_purchase_items", "purchase_items");
        $this->dropForeignKey("product_id_index_in_dispacthes_items", "dispacthes_items");
    }
    
}
