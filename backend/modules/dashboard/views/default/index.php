<?php 
$this->title = "Dashboard";
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\Json;

$this->registerCss(
	"
		.info-box{
			background: #edefff;
		}

	"
);
?>
<div class="topbar-dashboard">
		<div class="row">
			<div class="col-md-3">
				<div class="small-box bg-red">
		            <div class="inner">
		              <h3><?= Yii::$app->formatter->format($cih, 'decimal') ?></h3>

		              <p>Cash In Hand</p>
		            </div>
		            <div class="icon">
		              <i class="fa fa-dollar"></i>
		            </div>
		            <a href="<?= Url::to(['/products/products/index']) ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
		        </div>
			</div>
			<div class="col-md-3">
				<div class="small-box bg-yellow">
		            <div class="inner">
		              <h3><?= Yii::$app->formatter->format($cab, 'decimal') ?></h3>

		              <p>Cash At Bank</p>
		            </div>
		            <div class="icon">
		              <i class="fa fa-bank"></i>
		            </div>
		            <a href="<?= Url::to(['/products/products/index']) ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
		        </div>
			</div>
			<div class="col-md-3">
				<div class="small-box bg-aqua">
		            <div class="inner">
		              <h3><?= Yii::$app->formatter->format($totalProducts, 'decimal') ?></h3>

		              <p>Total Articles</p>
		            </div>
		            <div class="icon">
		              <i class="fa fa-shopping-basket"></i>
		            </div>
		            <a href="<?= Url::to(['/products/products/index']) ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
		        </div>
			</div>
			<div class="col-md-3">
				<div class="small-box bg-green">
		            <div class="inner">
		              <h3><?= Yii::$app->formatter->format($worth, 'decimal') ?></h3>

		              <p>Stock Value</p>
		            </div>
		            <div class="icon">
		              <i class="fa fa-diamond"></i>
		            </div>
		            <a href="<?= Url::to(['/products/products/index']) ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
		        </div>
			</div>
		</div>

		<hr />
		<!-- second level box reports -->

		<div class="row">

			<div class="col-md-3">
				<div class="info-box">
		            <span class="info-box-icon bg-green"><i class="fa fa-dollar"></i></span>

		            <div class="info-box-content">
		              <span class="info-box-text">Today's Sale</span>
		              <span class="info-box-number">
		              	<?= Yii::$app->formatter->format($todaySale, 'decimal') ?>
		              	</span>
		            </div>
	            <!-- /.info-box-content -->
	          </div>
			</div>
			<div class="col-md-3">
				<div class="info-box">
		            <span class="info-box-icon bg-aqua"><i class="fa fa-dollar"></i></span>

		            <div class="info-box-content">
		              <span class="info-box-text">Today's Sale Return</span>
		              <span class="info-box-number"><?= Yii::$app->formatter->format($model->getTodayReturns(), 'decimal') ?></span>
		            </div>
	            <!-- /.info-box-content -->
	          </div>
			</div>

			<!-- expenses -->

			<div class="col-md-3">
				<div class="info-box">
		            <span class="info-box-icon bg-blue"><i class="fa fa-dollar"></i></span>

		            <div class="info-box-content">
		              <span class="info-box-text">total Sales</span>
		              <span class="info-box-number"><?= Yii::$app->formatter->format($model->allSales, 'decimal') ?></span>
		            </div>
	            <!-- /.info-box-content -->
	          </div>
			</div>

			<div class="col-md-3">
				<div class="info-box">
		            <span class="info-box-icon bg-maroon"><i class="fa fa-list-alt"></i></span>

		            <div class="info-box-content">
		              <span class="info-box-text">total Sales return</span>
		              <span class="info-box-number"><?= Yii::$app->formatter->format($model->allReturns, 'decimal') ?></span>
		            </div>
	            <!-- /.info-box-content -->
	          </div>
			</div>
			<div class="col-md-3">
				<div class="info-box">
		            <span class="info-box-icon bg-teal"><i class="fa fa-list-alt"></i></span>

		            <div class="info-box-content">
		              <span class="info-box-text">sales balance</span>
		              <span class="info-box-number"><?= Yii::$app->formatter->format($model->salesBalance, 'decimal') ?></span>
		            </div>
	            <!-- /.info-box-content -->
	          </div>
			</div>
			
			<div class="col-md-3">
				<div class="info-box ">
		            <span class="info-box-icon bg-purple"><i class="fa fa-tag"></i></span>

		            <div class="info-box-content">
		              <span class="info-box-text">total sales balance</span>
		              <span class="info-box-number"><?= Yii::$app->formatter->format($model->allSalesBalance, 'decimal') ?></span>
		            </div>
	            <!-- /.info-box-content -->
	          </div>
			</div>

		</div>
		<hr />
		<div class="row">
			<div class="col-md-3">
				<div class="info-box">
		            <span class="info-box-icon bg-red"><i class="fa fa-motorcycle"></i></span>

		            <div class="info-box-content">
		              <span class="info-box-text">Today's Expenses</span>
		              <span class="info-box-number"><?= Yii::$app->formatter->format($todayExpenses, 'decimal') ?></span>
		            </div>
	            <!-- /.info-box-content -->
	          </div>
			</div>
			<div class="col-md-3">
				<div class="info-box">
		            <span class="info-box-icon bg-yellow"><i class="fa fa-coffee"></i></span>

		            <div class="info-box-content">
		              <span class="info-box-text">Overall Expenses</span>
		              <span class="info-box-number"><?= Yii::$app->formatter->format($totalExpenses, 'decimal') ?></span>
		            </div>
	            <!-- /.info-box-content -->
	          </div>
			</div>
		</div>
		<!-- <hr /> -->

		<!-- third row icons -->
		<div class="row hide">

			<div class="col-md-3">
				<div class="info-box">
		            <span class="info-box-icon bg-blue"><i class="fa fa-dollar"></i></span>

		            <div class="info-box-content">
		              <span class="info-box-text">total Sales</span>
		              <span class="info-box-number"><?= Yii::$app->formatter->format($model->allSales, 'decimal') ?></span>
		            </div>
	            <!-- /.info-box-content -->
	          </div>
			</div>
			<div class="col-md-3">
				<div class="info-box">
		            <span class="info-box-icon bg-aqua"><i class="ion ion-pie-graph"></i></span>

		            <div class="info-box-content">
		              <span class="info-box-text">This MOnth's Dispacthes</span>
		              <span class="info-box-number"><?= Yii::$app->formatter->format($monthSale, 'decimal') ?></span>
		            </div>
	            <!-- /.info-box-content -->
	          </div>
			</div>

			<!-- expenses -->

			<div class="col-md-3">
				<div class="info-box">
		            <span class="info-box-icon bg-red"><i class="ion ion-stats-bars"></i></span>

		            <div class="info-box-content">
		              <span class="info-box-text">Overall Stock Return</span>
		              <span class="info-box-number"><?= Yii::$app->formatter->format($todayExpenses, 'decimal') ?></span>
		            </div>
	            <!-- /.info-box-content -->
	          </div>
			</div>
			<div class="col-md-3">
				<div class="info-box">
		            <span class="info-box-icon bg-yellow"><i class="small-box bg-aqua"></i></span>

		            <div class="info-box-content">
		              <span class="info-box-text">Overall Brands</span>
		              <span class="info-box-number"><?= Yii::$app->formatter->format($totalExpenses, 'decimal') ?></span>
		            </div>
	            <!-- /.info-box-content -->
	          </div>
			</div>
		</div>
		<hr />

		<!-- graph -->

		<div class="row">
			<div class="col-md-6">
				<canvas id="ales-chart" width="400" height="250"></canvas>
			</div>
		</div>

</div>


<?php 
$this->registerJsFile("@web/js/chartjs.js");
$this->registerJs("
	var saleChart = document.getElementById('ales-chart');
	
	var sC = new Chart(saleChart, {
		type: 'horizontalBar',
		data: {
			labels: " . json_encode(array_keys($dailySales)) . ",
			datasets: [
			{
				label: 'Sales',
				data: " . Json::encode( array_values($dailySales) ). ",
				backgroundColor: [
	                'rgba(255,99,132,1)',
	                'rgba(54, 162, 235, 1)',
	                'rgba(255, 206, 86, 1)',
	                'rgba(75, 192, 192, 1)',
	                'rgba(153, 102, 255, 1)',
	                'rgba(255, 159, 64, 1)'
	            ],
			}

			],

		},
		options: {
	        title: {
	            display: true,
	            text: 'Last 7 Days Sales Graph'
	        }
	    }
	});
");
?>