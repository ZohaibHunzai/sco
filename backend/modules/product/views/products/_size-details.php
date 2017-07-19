<?php 
use yii\helpers\Html;
use yii\helpers\Url;
?>

<?php if (empty($model->child)): ?>
	<div class="alert ">
		<p>
			No child product found.
		</p>
	</div>
	<?php Yii::$app->end() ?>
<?php endif ?>

<!-- <div class="row"> -->
	<div class="col-md-12">
		<table class="table table-bordered table-stripped table-hover">
				<tr>
					<!-- <th>Name</th> -->
					<th>Size</th>
					<th>Opening Stock</th>
					<th>Recieved</th>
					<th>R/Return</th>
					<th>Sold</th>
					<th>S/Return</th>
					<th>D/Received</th>
					<th>D/Sent</th>
					<th>Current Stock</th>
				</tr>
			<?php foreach ($model->child as $child): ?>
				<tr>
					<!-- <td><?= $child->name ?></td> -->
					<td><?= $child->size ?></td>
					<td><?= $child->openingStock ? : 0 ?></td>
					<td><?= $child->totalPurchased ? : 0?></td>
					<td><?= $child->totalPurchaseReturn ? : 0 ?></td>
					<td><?= $child->totalSold ? : 0 ?></td>
					<td><?= $child->saleReturn ? : 0 ?></td>
					<td><?= $child->dispatchReceived ? : 0 ?></td>
					<td><?= $child->dispatchSent ? : 0 ?></td>
					<td><?= $child->stock ?></td>
				</tr>
			<?php endforeach ?>
			<tr>
				<th>Total</th>
				<th><?= $model->openingStock ?></th>
				<td><?= $model->totalPurchased ?></td>
				<td><?= $model->totalPurchaseReturn ?></td>
				<td><?= $model->totalSold ?></td>
				<td><?= $model->saleReturn ?></td>
				<td><?= $model->dispatchReceived ?></td>
				<td><?= $model->dispatchSent ?></td>
				<td><?= $model->stock ?></td>
			</tr>
		</table>		
	</div>
<!-- </div> -->
