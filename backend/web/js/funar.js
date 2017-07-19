(function() {
  var Sale, _assigned_accounts, checked, item, ui, url, wH;

  item = function(name, current_value) {
    $('#assigned-selected-accounts').append($(document.createElement('div')).attr({
      'class': 'col-md-3'
    }).append($(document.createElement("div")).attr({
      'class': 'form-group'
    }).append, $(document.createElement('label')).attr({
      'class': 'control-label'
    }).append($(document.createElement('input')).attr({
      'type': 'checkbox',
      'checked': true,
      'name': 'Account[' + current_value + '][account_id]'
    }), " " + name)));
    return _assigned_accounts.push(current_value);
  };

  _assigned_accounts = [];

  $('.assign-accounts').find('.account-chooser').on('change', function() {
    var current_value, url;
    current_value = parseInt($(this).val());
    if (!($.inArray(current_value, _assigned_accounts) >= 0)) {
      url = $(this).data('url');
      return $.getJSON(url, {
        id: current_value
      }, function(r) {
        return item(r.name, current_value);
      });
    } else {
      return alert("Already added");
    }
  });

  if ($('#assigned-selected-accounts').length > 0) {
    url = $('#assigned-selected-accounts').data('default-url');
    $.getJSON(url, {}, function(r) {
      var j, len, results, v;
      results = [];
      for (j = 0, len = r.length; j < len; j++) {
        v = r[j];
        results.push(item(v.account.name, parseInt(v.account_id)));
      }
      return results;
    });
  }

  $('#cash-collection-create').find('.recieve-mode').on('change', function() {
    var val;
    val = parseInt($(this).val());
    if (val === 30) {
      return $('#cash-collection-create').find('.bank-account-details').removeClass('hide');
    } else {
      return $('#cash-collection-create').find('.bank-account-details').addClass('hide');
    }
  });

  $('#customer-region_id').change(function() {
    var value;
    value = $(this).val();
    url = $(this).data('url');
    return $.get(url, {
      id: value
    }, function(data) {
      return $('#customer-town_id').html(data);
    });
  });

  checked = $('#inventory-price_changed').is(':checked');

  if (checked) {
    $('.prices').show();
  } else {
    $('.prices').hide();
  }

  $('#inventory-price_changed').change(function() {
    var checked_two;
    checked_two = $(this).is(':checked');
    if (checked_two) {
      return $('.prices').show();
    } else {
      return $('.prices').hide();
    }
  });

  Sale = (function() {
    function Sale() {}

    Sale.prototype.sale_data = [
      {
        items: [
          {
            product_id: 1,
            qty: 2,
            discount: 30
          }, {
            product_id: 2,
            qty: 20,
            discount: 30
          }, {
            product_id: 3,
            qty: 12,
            discount: 0.0
          }
        ],
        customer_id: 3,
        payment_type: 30
      }
    ];

    Sale.prototype.items = [];

    Sale.prototype.customers = null;

    Sale.prototype.products = [];

    Sale.prototype.sale_id = null;

    Sale.prototype.logger = true;

    Sale.prototype.new_item = function() {
      return this.items.push({
        product_id: 1,
        sale_id: 1,
        blah: 2
      });
    };

    Sale.prototype.remove_item = function(item_id) {
      return this.items.splice(this.items.indexOf(item_id));
    };

    Sale.prototype.get_customers = function() {
      if (this.customers === null) {
        $.ajax({
          url: $('#sales').data('server'),
          type: 'GET',
          context: this,
          dataType: 'josn',
          data: {
            what: 'customers'
          }
        }).success(function(data) {
          this.customers = data;
          return console.log(this.customres);
        });
        return this.customers;
      } else {
        return this.customers;
      }
    };

    Sale.prototype.setState = function(key, data) {
      return this.key = data;
    };

    Sale.prototype.get_products = function() {
      return $.ajax({
        url: $('#sales').data('server'),
        type: 'GET',
        context: this,
        dataType: 'json',
        data: {
          what: 'products'
        }
      }).success(function(data) {
        return this.products = data;
      });
    };

    Sale.prototype.load_data = function(callback) {
      this.get_customers();
      this.get_products();
      return callback.call(this);
    };

    Sale.prototype.display = function() {
      var j, len, ref, results;
      console.log(this.products);
      ref = this.products;
      results = [];
      for (j = 0, len = ref.length; j < len; j++) {
        item = ref[j];
        results.push(console.log(item));
      }
      return results;
    };

    return Sale;

  })();

  $(document).ready(function() {
    var sale;
    sale = new Sale;
    return sale.load_data(function() {
      return this.display();
    });
  });

  $('html').addClass('fixed-height');

  $('#sales').parent('.content-wrapper').prop('style', '');

  wH = parseInt($(window).height());

  wH -= 51;

  $('.pos-ui').css('height', wH + "px");

  ui = (function() {
    function ui() {}

    ui.prototype.elemen = function(type, data, classes) {
      return $(type).html(data).prop({
        "class": classes
      });
    };

    ui.prototype.products = function(items) {
      var i, j, results;
      results = [];
      for (i = j = 1; j <= 12; i = ++j) {
        results.push($('.items').append(this.product_item));
      }
      return results;
    };

    ui.prototype.product_item = function(data) {
      var str;
      return str = "<div class='product-item'> <a href='#' class='close-btn'><i class='fa fa-close'></i></a> <div class='row'> <div class='col-md-4'> <strong class='item-sku'>{sku}</strong> <span class='item-name'>uBank Software</span> <span class='price-tag'>12,000</span> </div> <div class='col-md-4'> <div class='row'> <div class='col-md-6'> <div class='qty'> <label>Qty</label> <input type='text' class='form-control'> </div> </div> <div class='col-md-6'> <div class='disc'> <label>Discount</label> <input type='text' class='form-control'> </div> </div> </div> </div> <div class='col-md-4'> <div class='item-total-outer'> <span class='item-total-text'>Total</span> <strong class='item-total'>{item_total}</strong> </div> </div> </div> </div>";
    };

    return ui;

  })();

  ui = new ui;

  ui.products({});

  wH = $(windows).height();

}).call(this);
