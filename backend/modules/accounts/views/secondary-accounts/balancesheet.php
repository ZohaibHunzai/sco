<?php 
use yii\helpers\Html;

$this->title = 'Balance Sheet';
$this->params['breadcrumbs'][] = $this->title;

$total_assets = 0;
$total_liabilities = 0;
 ?>
<table class= "table table-hover table-stripped">
 	<thead>
 		<tr>
	 			
	 		<th>Assets</th>
	 		<th>Liabilities</th>
 		</tr>
 	</thead>
 		<tbody>
 			<tr>
 				<td width="50%">
 					<table class="table table-hover table-stripped">
 						<thead></thead>
 						<tbody>
 							

 							<?php foreach ($accounts as $acc): ?>
 						
 									<?php 
 										$p_l =  $acc->getProfitLoss();
											
 									 ?>
 						<tr>

 								<?php if ($acc->primary_account_id == 7): ?>

 								<td><?php echo $acc->name; ?></td>		
 								<td class="text-right"><?php echo abs( $acc->getBalance($acc->id) ); ?></td>	
 									<?php $total_assets+= abs( $acc->getBalance($acc->id) ); ?>
 								
 								<?php endif ?>
 						</tr>
 							<?php endforeach ?>


 							<tr>
 										<?php if ($p_l < 0): ?>
 												<td class="text-left">
 												<b>Net Loss</b>										
 												</td>
 												<td class="text-right">
 													 <?php echo abs($p_l); ?>
 												</td>

 									<?php $total_assets = $total_assets - $p_l; ?>
 											<?php endif ?>	
 								
 							</tr>
 						</tbody>
 					</table>
 				</td>	
 				
 				<td width="50%">
 					<table class="table table-hover table-stripped">
 						<thead></thead>
 						<tbody >
 							
 							<?php foreach ($accounts as $acc): ?>
 						<tr>
 								<?php if ($acc->primary_account_id == 9):?>
 								<td><?php echo $acc->name; ?></td>		
 								<td class="text-right"><?php echo $acc->getBalance($acc->id); ?></td>	
 									<?php $total_liabilities+= abs( $acc->getBalance($acc->id) ); ?>

 								<?php endif ?>
 						</tr>
 							<?php endforeach ?>
 							
 						<tr>
 								<td><?php echo "Capital"; ?></td>		
 							<?php if ($acc->primary_account_id == 10): ?>
 								<td class="text-right"><?php echo $acc->getBalance($acc->id); ?></td>

 									<?php $total_liabilities+= abs( $acc->getBalance($acc->id) ); ?>
 								<?php endif ?>
 						</tr>
 						<tr>
 								<?php if ($p_l > 0): ?>
 												<td><b>
 													NetProfit</b> </td>												</td>
 												<td class="text-right" ><b>
 													 <?php echo $p_l; ?>
 												</b></td>
 									<?php $total_liabilities +=$p_l; ?>
 								<?php endif ?>

 						</tr>
 						</tbody>
 					</table>
 				</td>	
 					
 			</tr>
 			<tr>

 				<td><label class="text-left">Total</label><label style="float: right;"><?php echo $total_assets; ?></label></td>
 				<td> <label class="text-left">Total</label><b><label style="float: right;"><?php echo $total_liabilities; ?></label></b></td>
 			</tr>
 		</tbody>
 </table>
