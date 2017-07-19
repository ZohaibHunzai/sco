$(function() {
    "use strict";

    //Make the dashboard widgets sortable Using jquery UI
    $(".connectedSortable").sortable({
        placeholder: "sort-highlight",
        connectWith: ".connectedSortable",
        handle: ".box-header, .nav-tabs",
        forcePlaceholderSize: true,
        zIndex: 999999
    }).disableSelection();
    $(".connectedSortable .box-header, .connectedSortable .nav-tabs-custom").css("cursor", "move");
})


$(document).ready(function () {
    init();

});


/**
*  All function required by the app can be controlled here.
*/

function init() {
    inventory_create_product_info(); 
    transactionsCreate();
    preventBarcodeSubmit();
    // $('.sale-form').newSale();
    // 
    
}


function preventBarcodeSubmit() {
    $(".barcode").on('keypress', function(e){
        console.log(e.which)
        if( e.which == '13' || e.which == '123' || e.which == '112' ) {

            e.preventDefault();
        }
        
    });
    
}


/** inventory/create - displaying result after selecting product **/

function inventory_create_product_info() {
    // hide(".inventory-form .field-inventory-price_changed");
    
    $("#inventory-product_id").change(function () {
        
    
        
        url = $(this).data('request');
        val = $(this).val();
        $.get(url, {id: val }, function(d){
            $('.ajax-result').html(d);
            show('.inventory-form .field-inventory-price_changed');
        })
    });


    // check inventory 

    //showOnchecked('#inventory-price_changed', '.field-inventory-selling_price, .field-inventory-purchase_price');


}

/**
* jQuery taks for transactions/create route.
*/
function transactionsCreate() {

    // on selection of transfer from drop show transfer or vice versa.
    // hide(".transfer-form");
    showOnSelected("#transaction-mode", 2, "#transfer-from");
}


/** HIDE ELEMETN **/

function hide(selector) {

    $(selector).fadeOut();
    $('.hide-on-start').fadeOut();
}

function show(selector) {
    $(selector).fadeIn();
    
}

/**
* Display something on checkbox check or vice versa.
* @author Ejoo
*/
function showOnchecked(checkbox, toDisplay){
    
    $(checkbox).on('click', function(){
        if($(checkbox).is(':checked')) {
            show(toDisplay);
        } else {
            hide(toDisplay);
        }
        
    })
}

/**
* Display an element based on dropdown select or anything else.
* It checks if the selector has already that value, it does have, it displays element.
* It also looks for changes over the element.
* @author Ejoo
* @return null
*/
function showOnSelected(selector, value, elemToDisplay) {

    val = $(selector).val();

    // if dropdown value has already been selected. On update form for example
    if(val == value) {
        show(elemToDisplay)
    } else {

        hide(elemToDisplay);
    }

    // change detection.
    $(selector).on('change', function(){

        valOnChange = $(this).val();

        if(valOnChange == value) {
           show(elemToDisplay);
        } else {
            hide(elemToDisplay);
        }

    });
}


// /**
// * New sale
// * 
// */

// (function($){
//     // default options
//     options = {
//         products_selector: '.new-sale',
//         items_container: '.items-container'
//     };

//     sale = {
//         items: [],
//         grandTotal: 0.0,
//         discount: 0.0,

//         // returns void|false
//         addItem: function(item_id){
//            this.items.push(item_id);

//         },
//         // returns booelan
//         isItemAdded: function(item_id){
//             if($.inArray(item_id, this.items) == -1) {
//                 return false;
//             } else{
//                 return true;
//             }
//         },

//         template: function(id){
//             tr = $("<tr />").prop("id", id);
//             serialValue = this.items.length + 1;
            
//             serial = this.addTh(serialValue, 'serial' + serialValue);
            
//             return tr.html(serial);

//         }

//         addTh: function(value, id){
//             return $("<th />").prop(id, id).html(value);
//         }

//     };

//     $.fn.newSale = function(newOptions){
//         n = $.extend(options, newOptions)


//         $(n.products_selector).on("change", function(){
//             id = $(this).prop('value');

//             if( id == '' ) {
//                 return false;
//             }
//             // if item isn't added.
//             if(!sale.isItemAdded(id)) {
//                 sale.addItem(id);
//                 $(n.items_container).html(sale.template());
//             } else {
//                 alert("Item added already.");
//             }
            

//         });
//     }


// }(jQuery))