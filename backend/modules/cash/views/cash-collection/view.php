<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model backend\modules\cash\models\CashCollection */

$this->title = "Cash Collection from " . $model->customer->name;
$this->params['breadcrumbs'][] = ['label' => 'Cash Collections', 'url' => ['index']];
$this->params['breadcrumbs'][] = "Collection Detail";
?>
<div class="cash-collection-view">

    <div class="row">
        <div class="col-sm-12 text-right" style="margin-top: 15px">
            <?=             
             Html::a('<i class="fa fa-download"></i> ' . 'PDF', 
                ['pdf', 'id' => $model['id']], 
                [
                    'class' => 'btn btn-default',
                    'target' => '_blank',
                    'data-toggle' => 'tooltip',
                    'title' => 'Will open the generated PDF file in a new window'
                ]
            )?>                        
            
            <?= Html::a('Delete', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ])
            ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <h4>Details</h4>
            <?php 
                $gridColumn = [
                    ['attribute' => 'id', 'hidden' => true],
                    [
                        'label' => 'Customer Name',
                        'value'=> $model->customer->name,
                    ],
                    'date',
                    [
                        'label' => 'Payment Amount',
                        'value' => $model->amount,
                        'format' => 'decimal',
                    ],
                    'sales_person_id',
                    'transaction_group'
                ];
                echo DetailView::widget([
                    'model' => $model,
                    'attributes' => $gridColumn,
                    'options' => ['class' => 'table table-responsive table-bordered'],
                    'template' => '<tr><th>{label}</th></tr><tr><td>{value}</td></tr>'
                ]); 
            ?>
        </div>
        <div class="col-md-12">
            <h4>Transaction</h4>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>    
                            <th>#</th>
                            <th>Account</th>
                            <th>Transaction Type</th>
                            <th>Amount</th>
                            <th>Narration</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($model->transactions as $transaction): ?>
                            <tr>
                                <td><?= $transaction->id ?></td>
                                <td><?= $transaction->account->name ?></td>
                                <td><?= $transaction->type == 10 ? 'Debit' : 'Credit' ?></td>
                                <td><?= $transaction->amount ?></td>
                                <td><?= $transaction->narration ?></td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>