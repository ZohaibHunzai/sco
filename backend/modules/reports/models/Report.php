<?php
namespace backend\modules\reports\models;

/**
* @author  Ejoo <ejazkarimhunzai@gmail.com>	
*/
use Yii;
use backend\modules\sales\models\Sale;
use yii\data\ActiveDataProvider;
use yii\db\Query;
use yii\data\ArrayDataProvider;
use backend\modules\purchases\models\Purchase;
use backend\modules\dispacthe\models\Dispacthe;

class Report extends \yii\base\Model
{

	# properties being generated in SQL query, needs to read data from forms
	# 
	public $brand_name = null;
	public $name = null;

	public function rules()
    {
        return [
            [['brand_name', 'name'], 'string'],
        ];
    }

	
	public function getDailySales($month)
	{
		$dateTime = new \DateTime("first day of " . $month);


		
		$start_date =  $dateTime->format("Y-m-d");
		$end_date = (new \DateTime("last day of " . $month))->format("Y-m-d");


		$sql = "
			SELECT sum(grand_total) as total_sale, `date` 
				from sales 
				where 
					`status` = 1 
					AND  
					`date` between '{$start_date}' AND '{$end_date}'
					AND
					is_return is NULL
				group by `date`
			";



		$data = Yii::$app->db->createCommand($sql)->queryAll();


		$dataProvider = new ArrayDataProvider([
			'allModels' => $data,
			'sort' => [
				'attributes' => ['date', 'total_sale', 'name', 'total_products', 'sales_return'],
			]
		]);


		return $dataProvider;

	}

	public function getBrandSales()
	{
		
		$sql = "
			SELECT  b.name,
				(
					select count(p.id) 
					from products p
					where p.brand_id = b.id and parent is null
					group by b.id
					-- and is_parent is null

				) as total_products,
				(
					select sum(si.total)
					from sale_items as si
					
					left join sales s
					on s.id = si.sale_id

					WHERE si.product_id in (select id from products where brand_id = b.id) and s.is_return is null and s.status = 1

				) as total_sale,

				(
					select sum(si.total)
					from sale_items as si
					
					left join sales s
					on s.id = si.sale_id

					WHERE si.product_id in (select id from products where brand_id = b.id) and s.is_return = 1 and s.status = 1

				) as sales_return


				
				from brands as b
				group by b.id
		";



		$data = Yii::$app->db->createCommand($sql)->queryAll();


		$dataProvider = new ArrayDataProvider([
			'allModels' => $data,
			'sort' => [
				'attributes' => ['date', 'total_sale', 'name', 'total_products', 'sales_return'],
			]
		]);


		return $dataProvider;

	}

	public function getProductWiseStock($params)
	{

		$this->load($params);

		$sql = "
			SELECT p.name, p.id as parent, b.name as brand_name,p.brand_sector_id as brand_sector, pr.selling_price,
				(
					select IFNULL(sum(si.quantity), 0)
					from sale_items as si
					left join sales as s
					on s.id = si.sale_id
					where s.is_return is null and s.status = 1 
						and  si.product_id in (
							select id from products where parent = p.id
						)
				) as total_sold,
				(
					select IFNULL(sum(si.quantity), 0)
					from sale_items as si
					left join sales as s
					on s.id = si.sale_id
					where s.is_return = 1 and s.status = 1 
						and  si.product_id in (
							select id from products where parent = p.id
						)
				) as sale_return,
				(
					select IFNULL(sum(pi.quantity), 0)
					from purchase_items as pi
					left join purchases as s
					on s.id = pi.purchase_id
					where s.is_return is null and s.status = 1 
						and  pi.product_id in (
							select id from products where parent = p.id
						)
				) as total_purhcased,
				(
					select IFNULL(sum(pi.quantity), 0)
					from purchase_items as pi
					left join purchases as s
					on s.id = pi.purchase_id
					where s.is_return = 1 and s.status = 1 
						and  pi.product_id in (
							select id from products where parent = p.id
						)
				) as purhcase_return,

				(
					select IFNULL(sum(di.quantity), 0)
					from dispacthes_items as di
					left join dispacthes as s
					on s.id = di.dispatches_id
					where s.type=1 and s.status = 1 
						and  di.product_id in (
							select id from products where parent = p.id
						)
				) as dispatches_received,
				(
					select IFNULL(sum(di.quantity), 0)
					from dispacthes_items as di
					left join dispacthes as s
					on s.id = di.dispatches_id
					where s.type=1 and s.status = 2 
						and  di.product_id in (
							select id from products where parent = p.id
						)
				) as dispatches_sent

			from products p
			left join brands b
			on b.id = p.brand_id
			left join price pr
			on pr.id = p.price_id
			where p.is_parent = 1

			
		";

		if( $this->brand_name !== null && $this->brand_name !== '' ) {
			$sql .= " AND p.brand_id = " . $this->brand_name;
		}

		if( $this->name !== null  && $this->name !== '') {
			$sql .= " AND p.name LIKE '%{$this->name}%'";
		}
		$data = Yii::$app->db->createCommand($sql)->queryAll();


		$dataProvider = new ArrayDataProvider([
			'allModels' => $data,
			'sort' => [
				'attributes' => ['date', 'dispatches_sent', 'dispatches_received', 'total_sold', 'sale_return', 'total_purhcased', 'purhcase_return', 'stock', 'selling_price', 'brand_name','brand_sector', 'name'],
			]
		]);


		return $dataProvider;
	}
	public function getRecaptulation()
	{
		return [
			'recived' => [
				
			]
		];
	}


	public function getPurhcases()
	{
		return Purchase::find()->where(['status' => 1, 'is_return' => null ])->sum('grand_total');
	}


	public function getDispatchSent()
	{
		$all = Dispacthe::find()->where(['status' => 1, 'type' => Dispacthe::TYPE_SENT])->all();
		$total = 0;
		foreach($all  as $dispatch) {
			$total += $dispatch->total;
		}

		return $total;
	}

	public function getDispatchReceived()
	{
		$all = Dispacthe::find()->where(['status' => 1, 'type' => Dispacthe::TYPE_RECEIVED])->all();
		$total = 0;
		foreach($all  as $dispatch) {
			$total += $dispatch->total;
		}

		return $total;
	}

	public function getBrands()
	{
		return $this->hasOne("\backend\modules\init\models\BrandSector",['id'=>'brand_sector_id']);
	}


}