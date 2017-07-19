<?php 
use yii\helpers\Html;
use yii\helpers\Url;
$i = 0;
?>
<div class="col-md-12">
	<table class="table table-hover">
		<h4>
			Dispatch  <?= $model->typeText; ?> Invoice Details
		</h4>
		<thead>
			<tr>
				<th>#</th>
				<th>Product Name</th>
				<th>Size</th>
				<th>Barcode</th>
				<th>Price</th>
				<th>Quantity</th>
				<th>Total</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($model->items as $item): ?>
				<tr>
					<td><?= ++$i ?></td>
					<td><?= $item->products->name; ?></td>
					<td><?= $item->products->size; ?></td>
					<td><?= $item->products->barcode; ?></td>
					<td><?= $item->products->price->selling_price; ?></td>
					<td><?= $item->quantity; ?></td>
					<td><?= $item->quantity * $item->products->price->selling_price; ?></td>
				</tr>
			<?php endforeach ?>
		</tbody>
	</table>
</div>