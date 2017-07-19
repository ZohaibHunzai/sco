<?php 
use yii\helpers\Html;
use yii\helpers\Url;
?>
<div class="products">
	<div class="row">
		<div class="col-md-12">
			<input type="text" name="filter_product" placeholder="Enter product name, code or sku" class="product-filter form-control">
		</div>
		<div class="col-md-12">
			<div class="product-outer">
				
				<?php foreach ($products as $product): ?>
					<div class="product">
						<div class="row">
							<div class="col-md-4">
								<div class="product-basics">
									<span class="sku"><?= $product->code ?>
										<!-- <a href='#'><i class="fa fa-plus"></i></a> -->
									</span>
									<span class="name"><?= $product->name ?></span>
									
								</div>
							</div>
							<div class="col-md-4">
								<span class="price">
										RS: <?= $product->price ? $product->price->selling_price : null?>
								</span>
							</div>
							<div class="col-md-4">
								
								<a href='#' class="btn pos-btn btn-primary btn-block">
									<i class="fa fa-plus"></i>
									<!-- Sale -->
								</a>
							</div>	
						</div>
					</div>
				<?php endforeach ?>


			</div>
		</div>
	</div>

</div>