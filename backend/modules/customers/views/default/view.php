<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\data\ActiveDataProvider;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model backend\modules\customers\models\Customer */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Customers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="customer-view">

    <p>
        <?php echo Html::a('Update ' . $model->name, ['update', 'id' => $model->id], ['class' => 'btn btn-default']) ?>
        <?php echo Html::a('New Collection', ['/cash/cash-collection/create', 'id' => $model->id], ['class' => 'btn btn-default']) ?>
      
    </p>

    <div class="row"> 
        <div class="col-md-3">
             <?= box("Total Balance", $model->balance, 'fa-dollar', 'bg-green') ?>
        </div>
        <div class="col-md-3">
             <?= box("Total Worth of Sales", $model->getSales()->sum("grand_total"), 'fa-dollar', 'bg-blue') ?>
        </div>

    </div>
    <?php echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'phone_no',
            'mobile_no',
            'town.name:raw:Town Name',
            // 'region.name:raw:Region Name',
            'address',
        ],
    ]) ?>


    <div class="row">
        <div class="col-md-12">
        <h3>Recent Sales</h3>
        <?php 
            $provider = new ActiveDataProvider([
              'query' => $model->getSales()->orderBy("date DESC"),
              'pagination' => [
                  'pageSize' => 20,
              ],
            ]);

            echo GridView::widget([
                'dataProvider' => $provider,
                'showPageSummary' => true,
                'columns' => [
                    ['class' => 'kartik\grid\SerialColumn'],
                    'date',
                    [
                        'attribute' => 'net_total',
                        'format' => 'decimal',
                        'pageSummary' => true
                    ],
                    [
                        'attribute' => 'discount',
                        'format' => 'decimal',
                        'pageSummary' => true
                    ],

                    [
                        'attribute' => 'grand_total',
                        'format' => 'decimal',
                        'pageSummary' => true
                    ],
                    [
                        'label' => 'cost',
                        'value' => function($m){
                            return Sale::totalCost($m->id);
                        },
                        'visible' => false,
                    ],
                    [
                        'label' => 'invoice',
                        'value' => function($m){
                            return Html::a("Invoice", ['/sales/sale-items/index', 'id' => $m->id], ['class' => 'btn btn-sm btn-flat btn-default']);
                        },
                        'format' => 'raw',

                    ],
                ],
                // 'pjax' => true,
                // 'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container']],
                'panel' => [
                    'type' => GridView::TYPE_INFO,
                    'heading' => '<span class="glyphicon glyphicon-book"></span>  ' . Html::encode($this->title),
                ],
                // set a label for default menu
                'export' => [
                    'label' => 'Page',
                    'fontAwesome' => true,
                ],
            ])
            ?>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <h3>Cash Collections</h3>
        <?php 
            $collections = new ActiveDataProvider([
              'query' => $model->getCollections()->orderBy("date DESC"),
              'pagination' => [
                  'pageSize' => 20,
              ],
            ]);

             echo GridView::widget([
                'dataProvider' => $collections,
                'showPageSummary' => true,
                'panel' => [
                    'type' => GridView::TYPE_INFO,
                    'heading' => '<span class="glyphicon glyphicon-book"></span>  ' . Html::encode($this->title),
                ],
                // set a label for default menu
                'export' => [
                    'label' => 'Page',
                    'fontAwesome' => true,
                ],
                'columns' => [
                    ['class' => 'kartik\grid\SerialColumn'],
                   
                    // 'customer_id',
                    [
                        'attribute' => 'date',
                        'value' => function($m) {
                            return date("M d, Y", strtotime($m->date));
                        },
                        // 'filterType' => GridView::FILTER_DATE_RANGE,
                        // 'filterWidgetOptions' => [
                        //     'presetDropdown' => true,
                        // ],
                        'format' => 'raw',
                        'width' => '140px',
                    ],
                    // 'salesPerson.username:Collector',
                    [
                        'attribute' => 'customer_id',
                        'value' => function($model) {
                            return $model->customer->name . " " .Html::a("<i class='fa fa-link'></i>", ['/customers/default/view','id' => $model->customer->id]);
                        },  
                        'format' => 'raw',
                        'pageSummary' => 'Total',
                        
                    ],
                    [
                        'attribute' => 'amount',
                        'format' => 'decimal',
                        'pageSummary' => true,
                    ],
                    [
                        'attribute' => 'transaction_group',
                    ],
                    [
                        'label' => 'Balance',
                        'format' => 'decimal',
                        'pageSummary' => true,
                        'value' => 'customer.balance'
                    ],
                    // 'status',
                    // 'sale_id',
                    [
                        'class' => 'kartik\grid\ActionColumn',
                        'template' => '{view}{delete}',
                    ],
                ] 

            ]);
        ?>
    </div>
</div>
