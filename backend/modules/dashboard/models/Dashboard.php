<?php 
namespace backend\modules\dashboard\models;
use Yii;
use modules\cash\models\CashCollection;
use backend\modules\purchases\models\Purchase;
use backend\modules\purchases\models\PurchaseItem;
use backend\modules\sales\models\Sale;
use backend\modules\sales\models\SaleItem;
use backend\modules\dispacthe\models\Dispacthe;
use backend\modules\product\models\Product;
use backend\modules\inventory\models\Inventory;
use backend\modules\accounts\models\PrimaryAccount;
use backend\modules\accounts\models\Account;
/**
* 		
*/
class Dashboard extends \yii\base\Component
{
	private $user_id;

	public function init()
	{
		parent::init();
		$this->user_id = Yii::$app->user->identity->id;
		return true;
	}
	private function getDb()
	{
		return Yii::$app->db;
	}


	public function getTotalProducts()
	{
		return Product::find()->where(['is_parent' => true])->count();
	}


	public function getTodaySales()
	{
		# $balance =  Account::findOne(['status' => 1, 'code' => 50010])->todayBalance;
		$sales =  Sale::find()->where(['date' => date("Y-m-d"), 'is_return' => null, 'status' => 1])->sum('grand_total');
		return $sales;
	}
	
	public function getAllSales()
	{
		$balance = $sales =  Account::findOne(['status' => 1, 'code' => 50010])->balance;
		// $sales =  Sale::find()->where(['is_return' => null, 'status' => 1])->sum('grand_total');
		// $sales = Yii::$app->db->createCommand("SELECT SUM(grand_total) from sales WHERE status=1 and is_return is null")->queryScalar();
		// $sales = Account::
		return $sales;
	}

	public function getTodayReturns()
	{
		$salesReturn =  Sale::find()->where(['date' => date("Y-m-d"), 'is_return' => 1, 'status' => 1])->sum('grand_total');
		return $salesReturn;
	}
	public function getAllReturns()
	{
		$salesReturn =  Sale::find()->where(['is_return' => 1, 'status' => 1])->sum('grand_total');
		return $salesReturn;
	}


	public function getSalesBalance()
	{
		return $this->todaySales - $this->todayReturns;
	}

	
	public function getAllSalesBalance()
	{
		return $this->allSales - $this->allReturns;
	}


	public function getCurrentMonthSales()
	{
		return Account::findOne(['status' => 1, 'code' => 50010])->monthBalance;
	}

	public function getThisMonthSale()
	{
		$sales =  $this->getDb()->createCommand("SELECT `grand_total` from sales where `date` between date(Y-m-01) and date(Y-m-d) and status = 1 and is_return is NULL")->sum();
		
		$salesReturn =  $this->getDb()->createCommand("SELECT `grand_total` from sales where `date` between date(Y-m-01) and date(Y-m-d) and status = 1 and is_return = 1")->sum();

		// var_dump($salesReturn)
		// exit;
		return $sales - $salesReturn;
		
	}

	public function getTotalRecieved()
	{
		return $this->createCommand("SELECT `total` from purchase_items")->sum();
	}

	public function getTotalDispatched()
	{
		return $this->createCommand("SELECT `quantity` from dispacthes_items")->sum();
	}

	public function getCashInHand()
	{
		return Account::findOne(['status' => 1, 'code' => 15001])->balance;
	}
	public function getCashAtBank()
	{
		return Account::findOne(['status' => 1, 'code' => 15052])->balance;
	}

	

	public function getTotalExpenses()
	{
		return abs(PrimaryAccount::find()->where(['code' => 20000, 'status' => 1])->one()->balance);
	}
	
	public function getTodayExpenses()
	{
		return PrimaryAccount::find()->where(['code' => 20000, 'status' => 1])->one()->todayBalance;
		
	}

	// public function getStockWorth()
	// {
	// 	$purhcased = 
	// }

	public function getSalesByBrand()
	{
		
	}
	/**
	 * Get daily sales report of specified days, defaults to 7.
	 * @return array
	 */
	public function getDailySales($days = "7 days ago")
	{
		$dateTime = new \DateTime($days);
		
		$start_date =  $dateTime->format("Y-m-d");
		$end_date = (new \DateTime())->format("Y-m-d");


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

		$result = Yii::$app->db->createCommand($sql)->queryAll();
		$data = [];


		foreach ($result as $r) {
			$data[Yii::$app->formatter->format($r['date'], 'date')] =  $r['total_sale'];
		}

		return $data;	
	}
	/**
	 * Get top selling products by date.
	 * @param  integer $limit
	 * @return array 
	 */
	public function getTopProducts($limit=5)
	{
		
	}

	public function getMonthlySales()
	{
		
	}

	public function getEarlySales()
	{
		
	}


	/**
	 * Opening stock
	 * @return [type] [description]
	 */
	public function openingStock(){
		return Inventory::find()->where(['store_id' => Yii::$app->user->identity->store_id])->sum('quantity');
	}

	public function getTotalPUrchased()
	{
		return PurchaseItem::find()->joinWith("purchase p")->where(['p.status' => 1, 'p.store_id' => $this->user_id])->sum('quantity');
	}

	public function getWorth()
	{
		return Account::findOne(['status' => 1, 'code' => 15015])->balance;
	}

}
?>