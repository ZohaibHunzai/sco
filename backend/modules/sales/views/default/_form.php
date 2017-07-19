<?php 

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use kartik\widgets\DatePicker;
use kartik\datetime\DateTimePicker;

?>
<div class="row">
    <div class="col-md-9">
        <div class="row">
            <div class="col-md-3">
                <select class="form-control">
                    <option>Select Customer</option>
                    <option>Walk-in Client</option>
                    <?php $s = ['Ejaz', 'uConnect', 'Alright Brothers', 'Those guys'] ?>
                    <?php foreach ($s as $ss): ?>
                        <option><?= $ss ?></option>
                    <?php endforeach ?>
                </select>
            </div>
            <div class="col-md-3">
                <select class="form-control">
                    <option>Sale Type</option>
                    <option>Cash Sale</option>
                    <option>Credit Sale</option>
                    <option>Parital Sale</option>

                </select>
            </div>
            <div class="col-md-5">
                <div class="btn-group">
                    <a href="#" class="btn btn-flat btn-default">New Sale</a>
                    <a href="#" class="btn btn-flat btn-default">Cancel Sale</a>
                </div>
            </div>
            <div class="col-md-2">
            </div>
            
            <div class="col-md-12 ">
                <div class="product-select">
                    <input type="text" name="product-search" value='' placeholder="Type name, bar code or SKU">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="customer-detail">
                    
                </div>
            </div>
        </div>

        <!-- table -->

        <div class="data-table">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="table-outer">
                        
                    
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>S#</th>
                                    <th>SKU</th>
                                    <th>Name</th>
                                    <th>Rate</th>
                                    <th>Qty</th>
                                    <th>Discount</th>
                                    <th>Total</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php for($i=1; $i<=5; $i++){ ?>
                                <tr id='row-<?= $i ?>' >
                                    <td><?= $i ?></td>
                                    <td><?= rand(1000, 9999) ?></td>
                                    <td>The Product</td>
                                    <td><?= rand(100, 10000) ?></td>
                                    <td width='10%'><input type='text' class='form-control' value='<?= rand(1, 20) ?>' /></td>
                                    <td width='12%'><input type='text' class='form-control' value='<?= rand(1, 20) ?>' /></td>
                                    <td></td>
                                    <td width='30px'><a href='#'><i class='fa fa-trash'></i></a></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

       
    </div>
    <div class="col-md-3">
        <div class="right-details">
            <form action="" method="POST" class="form-horizontal" role="form">


                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-12 control-label">Comments</label>
                    <div class="col-sm-12">
                      <textarea class="form-control" placeholder="comments"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-5 control-label">Grand Total</label>
                    <div class="col-sm-7">
                      <input type="email" class="form-control" id="inputEmail3" value="0.0" placeholder="grand total">
                    </div>
                </div>

                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-5 control-label">Discount</label>
                    <div class="col-sm-7">
                      <input type="email" class="form-control" id="inputEmail3" value="0.0" placeholder="grand total">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-5 control-label">Net Total</label>
                    <div class="col-sm-7">
                      <input type="email" class="form-control" id="inputEmail3" value="0.0" placeholder="grand total">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-5 control-label">Adjustment</label>
                    <div class="col-sm-7">
                      <input type="email" class="form-control" id="inputEmail3" value="0.0" placeholder="grand total">
                    </div>
                </div>
                <div class="form-group">
                   
                    <div class="col-sm-7">
                      <input type="hidden" class="form-control" id="inputEmail3" value="0.0" placeholder="grand total">
                    </div>
                </div>
                <div class="total-text well">
                    <h1>PKR 3900</h1>
                </div>






            
                    
            
                    
            </form>
        </div>
    </div>
</div>
