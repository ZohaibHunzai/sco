<?php 
use yii\helpers\Html;
use yii\helpers\Url;
use kartik\export\ExportMenu;
use backend\modules\sales\models\Sale;
use kartik\grid\GridView;
use backend\modules\business\models\Business;




$this->title = "Recaptulation Report";
$business = Business::find()->one();

$pdf_title = "
    <div style='text-align:center'>
        <p style='text-align:center'>Recaptulation Report</p>
    </div>
";
$file_name = time() . "-" . ' daily sales report';

$pdf_title = $business->format($business->invoice_header, $pdf_title);
$i = 0;
?>
<div class="row">
	<div class="col-md-12">
		
	</div>
</div>