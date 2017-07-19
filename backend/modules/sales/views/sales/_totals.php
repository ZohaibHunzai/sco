<?php 
use yii\helpers\Html;
use yii\helpers\Url;
?>
<!-- total -->
<div class="pos-outer">
	<div class="total">
		<div class="row">
			<div class="col-md-5">
				<div class="control-group">
					<?= $form->field($model, 'net_total')->textInput(['disabled' => 'disabled']) ?>
					<?= Html::activeHiddenInput($model, 'net_total', ['id' => 'net_total_hidden']) ?>
				</div>

				<div class="control-group">
					<?= $form->field($model, 'discount')->textInput(['onChange' => 'Pos.setGrandDiscount(this)', 'value' => 0]) ?>
				</div>
			</div>
			<div class="col-md-7">
				
				<div class="control-group">
					<div class="well">
						<label>Grand Total</label>
						<?= Html::activeHiddenInput($model, 'grand_total', ['class' => 'grand_total']) ?>
						<h1 class=""><span>PKR</span> <span class="grand_total txt">0.00</span></h1>
						
					</div>
				</div>
			</div>
			<div class="col-md-12">
				<?= $form->field($model, "comments")->textArea()  ?>
			</div>

			
				<div class="col-md-4">
					<?= $form->field($model, 'cash')->textInput(['value' => 0, 'style' => ' font-size: 24px', 'onChange' => 'Pos.cashChange()']) ?>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label>Change</label>
						<h3><strong class="change">0.0</strong></h3>
						<?= Html::activeHiddenInput($model, 'change', ['class' => 'hidden_change']) ?>
					</div>

				</div>
				
				<div class="col-md-4">
					<?= 
				 $form->field($model, 'print', [])->checkBox()->label("<i class='fa fa-pring'></i> Print on Sale"); 
				 ?>
				</div>
				

			<div class="col-md-12">
				<div class="row">
					<div class="col-md-12">
						<input type="submit", value="<?= $model->is_return == 1 ? "Sales Return" : "Process New Sales" ?>" class="btn btn-flat btn-lg btn-block <?= $model->is_return == 1 ? 'btn-warning' : 'btn-success' ?>" />
						<!-- <input type="submit", value="Sale" class="btn btn-flat btn-block btn-success" /> -->
					</div>
					<!-- <div class="col-md-6">
						<?= Html::a("<i class='fa fa-close'></i> Cancel Sale", Url::to(), ['class' =>'btn btn-flat btn-block btn-danger']) ?>
					</div>
					<div class="col-md-6">
						<?= Html::a("<i class='fa fa-close'></i> Hold Sale", Url::to(), ['class' =>'btn btn-flat btn-block btn-danger']) ?>
					</div> -->

				</div>
			</div>
		</div>
	</div>
</div>