<?php

namespace backend\modules\product\models;

use Yii;
use \backend\modules\product\models\base\Product as BaseProduct;
use \backend\modules\price\models\Price;
use \backend\modules\categories\models\Category;
use \backend\modules\init\models\Brand;
use \backend\modules\init\models\BrandSector;
use \backend\modules\dispacthe\models\DispactheItem;
use \backend\modules\dispacthe\models\Dispacthe;
use \backend\modules\purchases\models\PurchaseItem;
/**
 * This is the model class for table "products".
 */
class Product extends BaseProduct
{
    

    /**
     * @inheritdoc
     */
    public $selling_price;
    public $purchase_price;
    public $available_sizes;
    public $is_duplicate;
    public function rules()
    {
        return [

            [['name', 'category_id', 'brand_id', 'brand_sector_id', 'selling_price', 'purchase_price'], 'required'],
            // [['available_sizes'], 'required', 'when' => function($model) {
            //     return $model->isNewRecord && $model->is_duplicate !== true;
            // }],
            [['category_id', 'image_id', 'price_id', 'created_by', 'updated_by'], 'integer'],
            [['name'], 'string', 'max' => 128],
            [['barcode', 'description'], 'string', 'max' => 500],
            [['unit_id', 'units_per_carton', 'unit_weight', 'total_weight', 'selling_price'], 'number'],
            [['created_at', 'available_sizes', 'updated_at', 'barcode'], 'safe']
        ];
    }

    /**
     * price instance
     * @author Ejoo
     */
    public function getPrice()
    {
        return $this->hasOne(Price::className(), ['id' => 'price_id']);
    }

    /**
     * Category relationship
     * @author Ejoo
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }
	

    public function getTotalSold()
    {
        return $this->hasMany('\backend\modules\sales\models\SaleItem', ['product_id' => 'id'])->joinWith('sale')->where(['sales.is_return' => NULL, 'sales.status' => 1])->sum('quantity');
    }

    public function getSaleReturn()
    {
        return $this->hasMany('\backend\modules\sales\models\SaleItem', ['product_id' => 'id'])->joinWith('sale')->where(['sales.is_return' => '1', 'sales.status' => 1])->sum('sale_items.quantity');
        
    }

    public function getTotalPurchased()
    {
        
        return $this->hasMany('\backend\modules\purchases\models\PurchaseItem', ['product_id' => 'id'])
            ->joinWith('purchase p')
            ->where(['p.is_return' => NULL,'p.status' => 1])
            ->sum('quantity');
    }
    /**
     * Calculates total disspaches being sent out
     * @return int
     */
    public function getDispatchSent()
    {
        return $this->hasMany('\backend\modules\dispacthe\models\DispactheItem', ['product_id' => 'id'])
            ->joinWith('dispatch d')
            ->where(['d.type' => Dispacthe::TYPE_SENT, 'd.status' => 1])
            ->sum('quantity');
    }
    /**
     * Calculates total disspaches being received in
     * @return int
     */
    public function getDispatchReceived()
    {
        return $this->hasMany('\backend\modules\dispacthe\models\DispactheItem', ['product_id' => 'id'])
            ->joinWith('dispatch d')
            ->where(['d.type' => Dispacthe::TYPE_RECEIVED, 'd.status' => 1])
            ->sum('quantity');
    }

    public function getTotalPurchaseReturn()
    {
        return $this->hasMany('\backend\modules\purchases\models\PurchaseItem', ['product_id' => 'id'])
            ->joinWith('purchase p')
            ->where(['p.is_return' => 1, 'p.status' => 1])
            ->sum('quantity');
    }



    public function getOpeningStock()
    {
        return $this->hasMany('\backend\modules\inventory\models\Inventory', ['product_id' => 'id'])->sum("quantity");
    }

    public function getStockx()
    {
        $sql = "
            SELECT mp.id,
            (
                select sum(si.quantity)
                from sale_items si
                left join sales s
                on s.id = si.sale_id
                left join products p
                on p.id = si.product_id
                where s.status = 1 and s.is_return is NULL and p.parent = mp.id
            ) as total_sales,
            (
                select sum(si.quantity)
                from sale_items si
                left join sales s
                on s.id = si.sale_id
                left join products p
                on p.id = si.product_id
                where s.status = 1 and s.is_return = 1 and p.parent = mp.id
            ) as total_sales_return,
            
            (
                select sum(pi.quantity)
                from purchase_items as pi
                left join purchases p
                on p.id = pi.purchase_id
                left join products pr
                on pr.id =pi.product_id
                where p.status = 1 and p.is_return IS NULL and pr.parent = mp.id
            ) as total_purchases,
            (
                select sum(pi.quantity)
                from purchase_items as pi
                left join purchases p
                on p.id = pi.purchase_id
                left join products pr
                on pr.id =pi.product_id
                where p.status = 1 and p.is_return = 1 and pr.parent = mp.id
            ) as total_purchase_return,
            
            (
                select sum(di.quantity)
                from dispacthes_items as di
                left join dispacthes d
                on d.id = di.dispatches_id
                left join products pr
                on pr.id =di.product_id
                where d.status = 1 and d.type=2 and pr.parent = mp.id
            ) as dispatches_sent,
            (
                select sum(di.quantity)
                from dispacthes_items as di
                left join dispacthes d
                on d.id = di.dispatches_id
                left join products pr
                on pr.id =di.product_id
                where d.status = 1 and d.type=1 and pr.parent = mp.id
            ) as dispatches_received
            
      
            from products mp
            where mp.is_parent = 1 and mp.id = {$this->id}
        ";

        // var_dump($sql);
        // exit;
        $result = Yii::$app->db->createCommand($sql)->queryOne();
        
        foreach ($result as $key => $value) {
            if($result[$key] == null)  {
                $result[$key] = 0;
            }
        }
        // var_dump($result);
        extract($result);
        return $total_purchases + $dispatches_received - $total_sales + $total_sales_return - $dispatches_sent - $total_purchase_return;

    }
    public function getStock()
    {
        
        if ($this->is_parent) {
            $openings = 0;
            $purchased = 0;
            $sold = 0;
            $returned = 0;
            $preturn = 0;
            $dispatch_sent = 0;
            $dispatch_received = 0;
            foreach ($this->child as $m) {
                $openings           +=      $m->openingStock;
                $purchased          +=      $m->totalPurchased;
                $sold               +=      $m->totalSold;
                $returned           +=      $m->saleReturn;
                $preturn            +=      $m->totalPurchaseReturn;
                $dispatch_sent      +=      $m->dispatchSent;
                $dispatch_received  +=      $m->dispatchReceived;

            }

            return ($openings + $purchased  + $returned + $dispatch_received) - $preturn -  $sold - $dispatch_sent;

        }

        $openings   =   $this->openingStock;
        $purchased  =   $this->totalPurchased;
        $sold       =   $this->totalSold;
        $returned   =   $this->saleReturn;
        $preturn    =   $this->totalPurchaseReturn;
        $dispatch_sent = $this->dispatchSent;
        $dispatch_received = $this->dispatchReceived;

        return ($openings + $purchased) + $returned + $dispatch_received - $preturn -  $sold - $dispatch_sent;
    }

    public function getChildSales()
    {
        $sql = "SELECT IFNULL(sum(si.total), 0) as total_sales 
                FROM sales s 
                LEFT JOIN sale_items si 
                ON si.sale_id = s.id 
                WHERE s.is_return is NULL 
                    AND s.status = 1 
                    AND si.product_id IN 
                    (
                        SELECT id FROM 
                        products 
                        WHERE parent = {$this->id}
                    )
                ";

        return Yii::$app->db->createCommand($sql)->queryScalar();
    }
    
    public function getChildSalesCount()
    {
        $sql = "
            SELECT sum(si.quantity) as total_sales 
            FROM sales s 
            LEFT JOIN sale_items si 
            ON si.sale_id = s.id 
            WHERE s.is_return is NULL 
                AND s.status = 1 
                AND si.product_id IN 
                (
                    SELECT id 
                    FROM products 
                    WHERE parent = {$this->id}
                )
            ";

        return Yii::$app->db->createCommand($sql)->queryScalar();

    }


    public function getSqlStock()
    {
        // $sql = "SELECT sum("
    }

    public function getReturned()
    {
        if($this->is_parent) {
            $total = 0;
            foreach ($this->child as $mod) {
                $total += $mod->saleReturn;
            }

            return $total;
        }
        return $this->saleReturn;
    }

    public function getBrand()
    {
        return $this->hasOne(Brand::className(), ['id' => 'brand_id']);
    }
    
    public function getBrandSector()
    {
        return $this->hasOne(BrandSector::className(), ['id' => 'brand_id']);
    }


    public function getUpdatedBy()
    {
        return $this->hasOne('common\models\User', ['id' => 'updated_by']);
    }

    public function getUpdatedByStr()
    {
        return $this->updatedBy ? $this->updatedBy->username : '';
    }
    public function afterFind()
    {
        parent::afterFind();
        $this->name = ucwords($this->name); // . " - " . $this->size);
        $brand = $this->brand ? $this->brand->name : '';

        // $this->name = "$name (" . $this->code . ")";
        // $this->name .= $this->brand ? " - " .  $this->brand->name : ''; 
        $this->selling_price = $this->price ? $this->price->selling_price : null;
        
        return true;
    }

    public function getChild()
    {
        return $this->hasMany(self::className(), ['parent' => 'id'])->from(['xx' => 'products']);
    }
    /**
     * Get unit relationship
     * @return ActiveQuery|Unit Instance
     */
    public function getUnit()
    {
        return $this->hasOne("\backend\modules\init\models\Unit", ['id' => 'unit_id']);
    }
    

   

    public function setPrice()
    {

        if ($this->is_parent) {
            foreach ($this->child as $child) {
                $price = $child->price;
                $price->selling_price = $this->selling_price;
                $price->purchase_price = $this->purchase_price;
                $price->date = date("Y-m-d");
                $price->save(false);
            }

        }
        
        if ($this->isNewRecord) {
            $price = new Price();
        } else {
            $price = $this->price ? : new Price();
        }

        $price->selling_price = $this->selling_price;
        $price->purchase_price = $this->purchase_price;

        $price->date = date("Y-m-d");

        $price->save(false);

        $this->price_id = $price->id;
        return true;
    }


    /**
     * Saves articles with sizes
     * @return boolean
     */
    public function saveWithSizes()
    {
        
        #validate first
        if (! $this->validate()) {
            return false;
        }


        $explode = explode(",", rtrim($this->available_sizes, ","));
        
        if(empty($explode)) $explode = [$this->available_sizes];

        
        # set the pricce.
        $this->setPrice(); 
        
        # set name and append the size.
        $this->size = null;
        $this->is_parent = true;
        $this->save();


        $added = [];

        foreach ($explode as $_) {
            
            if(in_array($_, $added) || $_ == '') continue; # duplicate remove.


            $obj = clone $this;
            # make this new object new.
            $obj->id = null;
            $obj->isNewRecord = true;

            $obj->name = $this->name;
            $obj->size = (int) $_;
            $obj->parent = $this->id;
            $obj->is_parent = false;
            $obj->setPrice();

            $obj->save(false);
            
            # append as added
            $added[] = $_;

        }

        return true;

    }


    public function getWorth()
    {
        return $this->stockx? $this->stockx * $this->price->selling_price : 0;
    }
    
}
