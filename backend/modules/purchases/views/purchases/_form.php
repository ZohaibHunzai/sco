<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use kartik\typeahead\Typeahead;

/* @var $this yii\web\View */
/* @var $model backend\modules\purchases\models\Purchase */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="purchase-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <?= $form->errorSummary($model); ?>
    <fieldset class="scheduler-border">
        <legend class="scheduler-border">Bill Information</legend>
        <div class="row">
        <div class="col-md-4">
        <?= $form->field($model,'bill_no')->textInput() ?>
        </div>
        </div>
    </fieldset>
    <fieldset class="scheduler-border">
        <legend class="scheduler-border">Details</legend>
        <div class="row">
            <div class="col-md-4">
                <?= $form->field($model, 'date')->widget(\kartik\widgets\DatePicker::classname(), [
                    'options' => ['placeholder' => 'Choose Date', 'value' => date('Y-m-d')],
                    'type' => \kartik\widgets\DatePicker::TYPE_COMPONENT_APPEND,
                    'pluginOptions' => [
                        'autoclose' => true,
                        'format' => 'yyyy-mm-dd'
                    ]
                ]); ?>
                
            </div>
            <div class="col-md-4">
                <?= $form->field($model, 'issue_date')->widget(\kartik\widgets\DatePicker::classname(), [
                    'options' => ['placeholder' => 'Choose Date', 'value' => date('Y-m-d')],
                    'type' => \kartik\widgets\DatePicker::TYPE_COMPONENT_APPEND,
                    'pluginOptions' => [
                        'autoclose' => true,
                        'format' => 'yyyy-mm-dd'
                    ]
                ]); ?>
                
            </div>
            <div class="col-md-4">
                <?= $form->field($model, 'supplier_id')->dropDownList(asOptions('\backend\modules\supplier\models\Supplier'), ['placeholder' => 'Supplier']) ?>           
            </div>

            <div class="col-md-4 hidden">
                <?= $form->field($model, 'store_id')->textInput(['value'=>Yii::$app->user->identity->store_id]) ?>           
            </div>


        </div>
    </fieldset>
    

    <div class="row">
        <div class="col-md-12">
            <fieldset class="scheduler-border">
                <legend class="scheduler-border">Purcahse Items</legend>
            <div class="row">
                <div class="col-md-12">
                <?php 
                    echo $form->field($model, 'product_typeahead')->widget(Typeahead::classname(), [
                        'name' => 'product_id',
                        'options' => ['placeholder' => 'Type name, code or SKU', 'id' => 'product-select'],

                        //  'scrollable' => true,
                        'pluginOptions' => ['highlight' => true],
                        'dataset' => [
                            [
                                'remote' => [
                                    'url' => Url::to(['/sales/sales/products']).'?q=%ejjj',
                                    'wildcard' => '%ejjj',

                                ],

                                'limit' => 600,
                                'display' => 'value',
                            ],
                        ],
                        'pluginEvents' => [
                        'typeahead:selected' => "function(evt, item) {
                                
                                product = item.product;
                                action = $('#add_item_url').prop('value');
                                Purchase.process(product);
                               setTimeout(function(){
                                    $('#product-select').prop('value', '');
                                }, 10)
                                
                            }",
                        ],
                    ]);
                ?>
                <hr>
                <table class="table table-bordered table-hover">
                    <thead>     
                        <tr>
                            <th>#</th>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Selling Price</th>
                            <th>Sub total</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody class="purchase-body">
                        
                    </tbody>
                    
                </table>
                <div class="well">
                    <div class="row">
                        <div class="col-md-2">

                            <strong>Total Items: <span class="total-items">0</span></strong>
                        </div>
                        <div class="col-md-4">
                            <strong>Total Item Quantity: <span class="total-item-qty">0</span></strong>
                        </div>
                        <div class="col-md-6">
                            <div class="text-right">
                                <strong>Total: <span class="purchase-total">0.0</span></strong>
                            </div>
                            
                        </div>
                        
                    </div>
                </div>
                </div>
            </div>

            <?php if (!$model->is_return): ?>
                <?= $form->field($model, 'is_paid')->checkBox() ?>
            <?php endif ?>

            </fieldset>
        </div>
    </div>


    <?= $form->field($model, 'comments')->textArea(['maxlength' => true, 'placeholder' => 'Comments']) ?>



    <?= $form->field($model, 'grand_total', ['template' => '{input}'])->hiddenInput(['placeholder' => 'Grand Total']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->is_return ? 'Return Recieve Inventory' : 'Add New Recieve Inventory', ['class' => $model->is_return ? 'btn btn-block btn-block btn-lg btn-success' : 'btn btn-block btn-block btn-lg btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>


<script type="text/javascript">
var Purchase = {

    purchase_items: [],
    items_ids: [], 
    net_total: 0,
    discount: 0,
    grand_total: 0,
    logger: true,
    total_quantity: 0,

    process: function(product){
        if(this.exists(product.id)) {
            this.purchase_items[product.id].qty = this.purchase_items[product.id].qty + 1;
            this.purchase_items[product.id].total = parseFloat(product.price.purchase_price) * parseInt(this.purchase_items[product.id].qty);
        } else {
            this.purchase_items[product.id] = {
                product: product,
                qty: 1,
                unit_cost: product.price.purchase_price,
                total: product.price.purchase_price,
                discount: 0,

            }
            this.items_ids.push(product.id);
        }

        this.refresh();
        // this.log(this.purchase_items);
    },
    delete: function(event, id){
        // console.log(id);
        
        this.log(this.items_ids);
        this.purchase_items.splice(id, 1);
        this.items_ids.splice(this.items_ids.indexOf(id), 1);
        this.log(this.items_ids);
        // console.dom_items()
        this.refresh();
        return false;
    },
    log: function(msg){
        if(this.logger) {
            console.log(msg);
        }
    },

   refresh: function(){
    this.calculate();
    this.render();
    this.updateSummary();
   },

   updateQty: function(event, product_id){
    this.purchase_items[product_id].qty = parseInt(event.value);
    this.refresh();
   },
   render: function(){
    var i = 0;
    var rows = [];
    for(item in this.purchase_items) {
        i++;
        var p = this.purchase_items[item];

        var row       = this.elem("tr", {'class': 'item-row'});
        var nu        = this.elem("td", {}).text(i);
        var product   = this.elem("td", {'class': 'product-name'}).append(
                this.elem("input", {
                    'type': 'hidden',
                    'value' : p.product.id,
                    'class' : 'product-name-input',
                    'name' : 'Item[' + i + '][product_id]',
                }),
                this.elem("span", {
                    'class' : 'product-name-text',
                }).text(p.product.name)

            );

        var qty =   this.elem("td", {'class' : 'product-qty'}).append(
                        this.elem("input", {
                            'type': 'text',
                            'value': p.qty,
                            'name': 'Item['+i+'][quantity]',
                            'onChange': 'Purchase.updateQty(this, ' + p.product.id + ')',
                        })
                    );
        
        var cost =   this.elem("td", {'class' : 'product-unit-cost'}).append(
                        this.elem("input", {
                            'type': 'text',
                            'value': p.unit_cost,
                            'name': 'Item['+i+'][unit_cost]'
                        })
                    );

        var sub_total   = this.elem("td", {'class': 'product-name'}).append(
                this.elem("input", {
                    'type': 'hidden',
                    'value' : p.total,
                    'class' : 'product-total-input',
                    'name' : 'Item[' + i + '][total]',
                }),
                this.elem("span", {
                    'class' : 'product-total-text',
                }).text(p.total)

            );
            var dlt    = this.elem("td", {
                            'data-product-id': p.product.id,
                            'class' : 'remove-item',
                        }).append(this.elem('a', {
                            'href' :'#',
                            'onClick' : 'Purchase.delete(this, ' + p.product.id + ')',
                        }).append("<i class='fa fa-close'></i>"))

        row.append(nu, product, qty, cost, sub_total, dlt);
        rows.push(row);
    }
    var container = $(".purchase-body");
    container.html(rows);
    // for(x = 0; x< rows.lenght; x++) {

    //     container.append(rows[x]);
    // }
   },
   calculate: function(){
        var net_total = 0;
        var grand_total =  0;
        var items_discount = 0;
        var total_quantity = 0;
        for(product in this.purchase_items) {
            var p = this.purchase_items[product];

            var total = p.qty * p.unit_cost;
            this.purchase_items[product].total = Number(total).toFixed(2);
            net_total += total;
            grand_total += net_total;
            total_quantity += p.qty;
        }

        this.net_total = Number(net_total).toFixed(2);
        this.grand_total = Number(this.net_total - this.discount).toFixed(2);
        this.total_quantity = total_quantity;
    },
    
    updateSummary(){
        $(".total-items").text(this.items_ids.length);
        $('.total-item-qty').text(this.total_quantity);
        $('.purchase-total').text(this.grand_total);
        $('#purchase-grand_total').prop('value', this.grand_total);

    },
    elem: function(name, attrs){
        return $(document.createElement(name)).attr(attrs);
    },

    exists: function(id) {
        for(i = 0; i < this.items_ids.length; i++) {
            if(this.items_ids[i] == parseInt(id)) {
                return true;
            }

        }
        return false;
    },
};
</script>