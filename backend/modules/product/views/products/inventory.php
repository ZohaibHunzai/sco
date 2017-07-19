<?php 
use yii\helpers\Html;
use yii\data\ActiveDataProvider;
use kartik\grid\GridView;
$this->title = 'Inventory Details';
$this->params['breadcrumbs'][] = $this->title;
 ?>
 <?= GridView::widget([
 	'dataProvider' => $dataProvider,
 	'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => '<span class="glyphicon glyphicon-book"></span>  ' . Html::encode($this->title),
        ],
 	'columns'	   =>[
 		'name',
 		'totalPurchased:decimal:Purchased',
 		'totalSold:decimal:Sold',


 	]
 	]);  	
 ?>