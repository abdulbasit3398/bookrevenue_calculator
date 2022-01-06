@extends('layouts.app')

@section('content')
<style>
    .input-group-addon {
        padding: 6px 12px;
        font-size: 14px;
        font-weight: 400;
        /* line-height: 1; */
        color: #555;
        text-align: center;
        background-color: #eee;
        border: 1px solid #ccc;
        border-radius: 4px;
        /* width: 1%; */
        white-space: nowrap;
        vertical-align: middle;
        display: table-cell;
        border-top-right-radius: 0;
        border-bottom-right-radius: 0;
    }
    @media only screen and (max-width: 760px),
    (min-device-width: 768px) and (max-device-width: 1024px)  {

        /* Force table to not be like tables anymore */
        .input-table3 table, .input-table3 thead, .input-table3 tbody, .input-table3 th, .input-table3 td, .input-table3 tr { 
            display: block; 
        }
        
        /* Hide table headers (but not display: none;, for accessibility) */
        .input-table3 thead tr { 
            position: absolute;
            top: -9999px;
            left: -9999px;
        }
        
        .input-table3 tr { border: 1px solid #ccc; }
        
        .input-table3 td { 
            /* Behave  like a "row" */
            border: none;
            border-bottom: 1px solid #eee; 
            position: relative;
            padding-left: 50%; 
        }
        
        .input-table3 td:before { 
            /* Now like a table header */
            position: absolute;
            /* Top/left values mimic padding */
            top: 6px;
            left: 6px;
            width: 45%; 
            padding-right: 10px; 
            white-space: nowrap;
        }
        
        /*
       
        Label the data
        */
        .input-table3 td:nth-of-type(1):before { content: "Item Cost"; }
        .input-table3 td:nth-of-type(2):before { content: "FBA Price"; }
        .input-table3 td:nth-of-type(3):before { content: "Inbound Shipping"; }
        .input-table3 td:nth-of-type(4):before { content: "Misc Fees"; }
        
    }
</style>
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Calculator</h1>

    </div>
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="form-group">
                <label for="">Item Cost</label>
                <input type="text" name="item_cost" id="item_cost" class="form-control" placeholder="Item Cost"  value="10"/>
            </div>
        </div>
        <div class="col-md-12">
            
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>2021 Closing Cost (VCF)</th>
                                    <th>Fulfillment Fee</th>
                                    <th>15% Commission</th>
                                    <th>Inbound Shipping</th>
                                    <th>Misc Fees</th>
                                    <th>Profit/Loss</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th>1lbs (sm)</th>
                                    <td>$<span class="c3_closing_cost" id="c3_closing_cost1smlbs">1.80</span></td>
                                    <td>$<span class="c3_postage" id="c3_postage1smlbs">2.63</span></td>
                                    <td>$<span class="c3_commission" id="c3_commission1smlbs">150.00</span></td>
                                    <td>$<span class="c3_shipping" class="c3_shipping1smlbs">0.10</span></td>
                                    <td>$<span class="c3_miscfees" class="c3_miscfees1smlbs">0.10</span></td>
                                    <td>$<span id="c3_profit_loss1smlbs">832.40</span><input type="hidden" name="c3_profit_loss[1smlbs]"></td>
                                </tr>
                                <tr>
                                    <th>1lbs (lg)</th>
                                    <td>$<span class="c3_closing_cost" id="c3_closing_cost1lglbs">1.80</span></td>
                                    <td>$<span class="c3_postage" id="c3_postage1lglbs">3.48</span></td>
                                    <td>$<span class="c3_commission" id="c3_commission1lglbs">150.00</span></td>
                                    <td>$<span class="c3_shipping" class="c3_shipping1lglbs">0.10</span></td>
                                    <td>$<span class="c3_miscfees" class="c3_miscfees1lglbs">0.10</span></td>
                                    <td>$<span id="c3_profit_loss1lglbs">832.40</span><input type="hidden" name="c3_profit_loss[1lglbs]"></td>
                                </tr>
                                <tr>
                                    <th>2lbs</th>
                                    <td>$<span class="c3_closing_cost" id="c3_closing_cost2lbs">1.80</span></td>
                                    <td>$<span class="c3_postage" id="c3_postage2lbs">4.90</span></td>
                                    <td>$<span class="c3_commission" id="c3_commission2lbs">150.00</span></td>
                                    <td>$<span class="c3_shipping" class="c3_shipping2lbs">0.10</span></td>
                                    <td>$<span class="c3_miscfees" class="c3_miscfees2lbs">0.10</span></td>
                                    <td>$<span id="c3_profit_loss2lbs">832.40</span><input type="hidden" name="c3_profit_loss[2lbs]"></td>
                                </tr>
                                <tr>
                                    <th>3lbs</th>
                                    <td>$<span class="c3_closing_cost" id="c3_closing_cost3lbs">1.80</span></td>
                                    <td>$<span class="c3_postage" id="c3_postage3lbs">5.42</span></td>
                                    <td>$<span class="c3_commission" id="c3_commission3lbs">150.00</span></td>
                                    <td>$<span class="c3_shipping" class="c3_shipping3lbs">0.10</span></td>
                                    <td>$<span class="c3_miscfees" class="c3_miscfees3lbs">0.10</span></td>
                                    <td>$<span id="c3_profit_loss3lbs">832.40</span><input type="hidden" name="c3_profit_loss[3lbs]"></td>
                                </tr>
                                <tr>
                                    <th>4lbs</th>
                                    <td>$<span class="c3_closing_cost" id="c3_closing_cost4lbs">1.80</span></td>
                                    <td>$<span class="c3_postage" id="c3_postage4lbs">5.80</span></td>
                                    <td>$<span class="c3_commission" id="c3_commission4lbs">150.00</span></td>
                                    <td>$<span class="c3_shipping" class="c3_shipping4lbs">0.10</span></td>
                                    <td>$<span class="c3_miscfees" class="c3_miscfees4lbs">0.10</span></td>
                                    <td>$<span id="c3_profit_loss4lbs">832.40</span><input type="hidden" name="c3_profit_loss[4lbs]"></td>
                                </tr>
                                <tr>
                                    <th>5lbs</th>
                                    <td>$<span class="c3_closing_cost" id="c3_closing_cost5lbs">1.80</span></td>
                                    <td>$<span class="c3_postage" id="c3_postage5lbs">6.18</span></td>
                                    <td>$<span class="c3_commission" id="c3_commission5lbs">150.00</span></td>
                                    <td>$<span class="c3_shipping" class="c3_shipping5lbs">0.10</span></td>
                                    <td>$<span class="c3_miscfees" class="c3_miscfees5lbs">0.10</span></td>
                                    <td>$<span id="c3_profit_loss5lbs">832.40</span><input type="hidden" name="c3_profit_loss[5lbs]"></td>
                                </tr>
                                <tr>
                                    <th>1.5lbs</th>
                                    <td>$<span class="c3_closing_cost" id="c3_closing_cost15lbs">1.80</span></td>
                                    <td>$<span class="c3_postage" id="c3_postage15lbs">5.00</span></td>
                                    <td>$<span class="c3_commission" id="c3_commission15lbs">150.00</span></td>
                                    <td>$<span class="c3_shipping" class="c3_shipping15lbs">0.10</span></td>
                                    <td>$<span class="c3_miscfees" class="c3_miscfees15lbs">0.10</span></td>
                                    <td>$<span id="c3_profit_loss15lbs">832.40</span><input type="hidden" name="c3_profit_loss[15lbs]"></td>
                                </tr>
                                <tr>
                                    <th>2.5lbs</th>
                                    <td>$<span class="c3_closing_cost" id="c3_closing_cost25lbs">1.80</span></td>
                                    <td>$<span class="c3_postage" id="c3_postage25lbs">2.75</span></td>
                                    <td>$<span class="c3_commission" id="c3_commission25lbs">150.00</span></td>
                                    <td>$<span class="c3_shipping" class="c3_shipping25lbs">0.10</span></td>
                                    <td>$<span class="c3_miscfees" class="c3_miscfees25lbs">0.10</span></td>
                                    <td>$<span id="c3_profit_loss25lbs">832.40</span><input type="hidden" name="c3_profit_loss[25lbs]"></td>
                                </tr>
                                <tr>
                                    <th>3.5lbs</th>
                                    <td>$<span class="c3_closing_cost" id="c3_closing_cost35lbs">1.80</span></td>
                                    <td>$<span class="c3_postage" id="c3_postage35lbs">2.75</span></td>
                                    <td>$<span class="c3_commission" id="c3_commission35lbs">150.00</span></td>
                                    <td>$<span class="c3_shipping" class="c3_shipping35lbs">0.10</span></td>
                                    <td>$<span class="c3_miscfees" class="c3_miscfees35lbs">0.10</span></td>
                                    <td>$<span id="c3_profit_loss35lbs">832.40</span><input type="hidden" name="c3_profit_loss[35lbs]"></td>
                                </tr>
                                <tr>
                                    <th>4.5lbs</th>
                                    <td>$<span class="c3_closing_cost" id="c3_closing_cost45lbs">1.80</span></td>
                                    <td>$<span class="c3_postage" id="c3_postage45lbs">2.75</span></td>
                                    <td>$<span class="c3_commission" id="c3_commission45lbs">150.00</span></td>
                                    <td>$<span class="c3_shipping" class="c3_shipping45lbs">0.10</span></td>
                                    <td>$<span class="c3_miscfees" class="c3_miscfees45lbs">0.10</span></td>
                                    <td>$<span id="c3_profit_loss45lbs">832.40</span><input type="hidden" name="c3_profit_loss[45lbs]"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
            <table class="table input-table3">
                <thead>
                    <tr>
                        <th>item Cost</th>
                        <th>FBA Price</th>
                        <th>Inbound Shipping</th>
                        <th>Misc Fees</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>$<span id="c3_item_cost">10</span><input type="hidden" name="c3_item_cost" value="10"></td>
                        <td>
                            <div class="input-group">
                                <span class="input-group-addon" id="basic-addon1">$</span>
                                <input type="text" name="fba_price" id="fba_price" class="form-control" placeholder="enter base price here" value="1000" aria-describedby="basic-addon1">
                            </div>
                        </td>
                        <td>
                            <div class="input-group">
                                <span class="input-group-addon" id="basic-addon1">$</span>
                                <input type="text" name="inbound_shipping" id="inbound_shipping" class="form-control" placeholder="enter your shipping base add in here" value="0.30" aria-describedby="basic-addon1">
                            </div>
                        </td>
                        <td>
                            <div class="input-group">
                                <span class="input-group-addon" id="basic-addon1">$</span>
                                <input type="text" name="c3_misc_fees" id="c3_misc_fees" class="form-control" placeholder="Misc Fees" value="0.20" aria-describedby="basic-addon1">
                            </div>
                        </td>
                        
                    </tr>
                </tbody>
            </table>
            </div>
            
        </div>
    </div>

</div>
@endsection
@push('scripts')
  <script>
    var cost = $('#item_cost').val();
      if($.trim(cost) != '')
      {
        var item_cost = cost;
      }else{
        var item_cost = 0;
    }
    
    var desired_profitv = $('#desired_profit').val();
    if($.trim(desired_profitv) != '')
    {
        var desired_profit = desired_profitv;
    }else{
        var desired_profit = 0;
    }
    
    var c3_misc_feesv = $('#c3_misc_fees').val();
    if($.trim(c3_misc_feesv) != '')
    {
        var c3_misc_fees = c3_misc_feesv;
    }else{
        var c3_misc_fees = 0;
    }
      
    var c3_item_cost = item_cost;
    var inbound_shippingv = $('#inbound_shipping').val();
    if($.trim(inbound_shippingv) != '')
    {
        var inbound_shipping = inbound_shippingv;
    }else{
        var inbound_shipping = 0;
    }
      
    var fba_price = 1000;
    var c3_commission = 0;
    var c3_closing_cost = 1.80;
    var C3CalculateProfit = function() {
      var _init = function() {
        _updateitemCost();
        _updateClosingCost();
        _updatelandedpercent();
        _updateInboundShipping();
        _updateMiscFees();
      }

      var _updateitemCost = function() {
        c3_item_cost = item_cost;
        $('#c3_item_cost').text(c3_item_cost);
        $('input[name="c3_item_cost"]').val(c3_item_cost);
        _updateTotalProfit();
      }

      var _updateClosingCost = function() {
        $('.c3_closing_cost').text(c3_closing_cost);
        _updateTotalProfit();
      }

      var _updatelandedpercent = function() {
        c3_commission = (parseFloat(fba_price)/100)*15;
        $('.c3_commission').text(c3_commission);
        _updateTotalProfit();
      }

      

      var _updateMiscFees = function() {
        $('.c3_miscfees').text(c3_misc_fees);
        _updateTotalProfit();
      }

      var _updateInboundShipping = function() {
        $('.c3_shipping').text(inbound_shipping);
        _updateTotalProfit();
      }
      

      var _updateTotalProfitBylbs = function(name='') {
          console.log(name);
        var c3closingcost = $('#c3_closing_cost'+name).text();
        var c3postage = $("#c3_postage"+name).text();
        var c3commission = $("#c3_commission"+name).text();
        var c1TotalProfit = parseFloat(fba_price)-parseFloat(c3closingcost)-parseFloat(c3postage)-parseFloat(c3commission)-parseFloat(inbound_shipping)-parseFloat(c3_misc_fees);
        if(name == '1smlbs')
        {
          c1TotalProfit = parseFloat(c1TotalProfit)-parseFloat(c3_item_cost);
        }
        $('#c3_profit_loss'+name).text(c1TotalProfit.toFixed(2));
        $("input[name='c3_profit_loss["+name+"]']").val(c1TotalProfit);
        if(c1TotalProfit <= 0)
        {
          $('#c3_profit_loss'+name).parents('td').css('color', 'red');
        }else{
          $('#c3_profit_loss'+name).parents('td').css('color', 'green');
        }
        console.log($("input[name='c3_profit_loss["+name+"]']").val());
      }

      var _updateTotalProfit = function() {
        _updateTotalProfitBylbs('1smlbs');
        _updateTotalProfitBylbs('1lglbs');
        _updateTotalProfitBylbs('2lbs');
        _updateTotalProfitBylbs('3lbs');
        _updateTotalProfitBylbs('4lbs');
        _updateTotalProfitBylbs('5lbs');
        _updateTotalProfitBylbs('15lbs');
        _updateTotalProfitBylbs('25lbs');
        _updateTotalProfitBylbs('35lbs');
        _updateTotalProfitBylbs('45lbs');  
      }
      
      return {
        init: _init,
        updateitemCost: _updateitemCost,
        updatelandedpercent: _updatelandedpercent,
        updateInboundShipping: _updateInboundShipping,
        updateMiscFees: _updateMiscFees,
        updateTotalProfit: _updateTotalProfit
      }
    }();
    C3CalculateProfit.init();

    $(document).on('keyup', '#item_cost', function(event) {
      var cost = $(this).val();
      if($.trim(cost) != '')
      {
        item_cost = cost;
      }else{
        item_cost = 0;
      }
      
      C3CalculateProfit.updateitemCost();
      
    });
    
    $(document).on('keyup', '#fba_price', function(event) {
      var listprice = $(this).val();
      if($.trim(listprice) != '')
      {
        fba_price = listprice;
        
      }else{
        fba_price = 0;
      }
      C3CalculateProfit.updatelandedpercent();
      
    });

    $(document).on('keyup', '#inbound_shipping', function(event) {
      var shipping_p = $(this).val();
      if($.trim(shipping_p) != '')
      {
        inbound_shipping = shipping_p;
      }else{
        inbound_shipping = 0;
      }
      
      C3CalculateProfit.updateInboundShipping();
      
    });

    $(document).on('keyup', '#c3_misc_fees', function(event) {
      var miscfees = $(this).val();
      if($.trim(miscfees) != '')
      {
        c3_misc_fees = miscfees;
      }else{
        c3_misc_fees = 0;
      }
      C3CalculateProfit.updateMiscFees();
      
    });

    $(document).on('keyup', '.c3_postage', function(event) {
      C3CalculateProfit.updateTotalFees();
      C2CalculateProfit.updatePstage();
      
    });

    
   
  </script>
@endpush