<?php

use yii\helpers\Html;
use yii\helpers\Url;


/* @var $this yii\web\View */

$this->title = 'New Sale';
$this->params['breadcrumbs'][] = ['label' => 'Sales', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['body-class'] = "sidebar-collapse";


\backend\modules\sales\assets\SaleAsset::register($this);
?>


<div id="vm" style="height: 100%; position: relative">
	<top></top>
	<middle>
		<div slot='pos'>
			
		</div>
	</middle>
	<!-- <bottom></bottom> -->
</div>



<template id="top">
	<div v-bind:style='styleObject'>
		
	</div>
</template>


<!-- body template -->

<template id="middle">
	<div v-bind:style='middleStyle'>
		<slot name='pos'>
		<slot name='recent-sales'>
		<slot name='recent-invoices'>
		<slot name='invoices-on-hold'>

	</div>
</template>

<!-- footer template -->
<template id="bottom">
	<div v-bind:style='bottomStyle'>
		
	</div>
</template>

<template id="pos">
	
</template>