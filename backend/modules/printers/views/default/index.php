<?php

use yii\helpers\Html;
use kartik\export\ExportMenu;
use kartik\grid\GridView;
use backend\modules\printers\models\Printer;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\printers\models\PrinterSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Printer';
$this->params['breadcrumbs'][] = $this->title;
$search = "$('.search-button').click(function(){
	$('.search-form').toggle(1000);
	return false;
});";
$this->registerJs($search);
?>
<div class="printer-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Printer', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Advance Search', '#', ['class' => 'btn btn-info search-button']) ?>
    </p>
        <div class="search-form" style="display:none">
        <?=  $this->render('_search', ['model' => $searchModel]); ?>
    </div>
        <?php 
    $gridColumn = [
        ['class' => 'yii\grid\SerialColumn'],
        ['attribute' => 'id', 'hidden' => true],
        'name',
        'description',
        
        [
            'attribute' => 'type',
            'value' => function($m) {
                $v = Printer::TypeOptions();
                return $v[$m->type];
            }
        ],
        [
            'attribute' => 'status',
            'value' => function($m) {
                $v = Printer::StatusOptions();
                return $v[$m->status];
            }
        ],
        [
            'attribute' => 'is_default',
            'value' => function($m) {
                return $m->is_default == 1 ? "Yes" : "No";
            }
        ],
        [
            'label' => 'Print Test',
            'value' => function($m){
                return Html::a("Test Print", ['testprint'], ['class' => 'btn btn-default btn-flat']);
            },
            'format' => 'raw',
        ],
        'footer',
        [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{update} {view}',
        ],
    ]; 
    ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => $gridColumn,
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container']],
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => '<span class="glyphicon glyphicon-book"></span>  ' . Html::encode($this->title),
        ],
        // set a label for default menu
        'export' => [
            'label' => 'Page',
            'fontAwesome' => true,
        ],
        // your toolbar can include the additional full export menu
        'toolbar' => [
            '{export}',
            ExportMenu::widget([
                'dataProvider' => $dataProvider,
                'columns' => $gridColumn,
                'target' => ExportMenu::TARGET_BLANK,
                'fontAwesome' => true,
                'dropdownOptions' => [
                    'label' => 'Full',
                    'class' => 'btn btn-default',
                    'itemsBefore' => [
                        '<li class="dropdown-header">Export All Data</li>',
                    ],
                ],
            ]) ,
        ],
    ]); ?>

</div>
