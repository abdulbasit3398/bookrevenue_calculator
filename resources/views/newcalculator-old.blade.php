@extends('layouts.app')

@section('content')
<style>
    .bg-warning{ color: #fff;}
    .table thead th {
    vertical-align: bottom;
    font-weight: 800;
    border-bottom: 2px solid #e3e6f0;
    font-size: 12px;
}
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
        .input-table3 td:nth-of-type(1):before { content: "FBA Landed Price"; }
        .input-table3 td:nth-of-type(2):before { content: "MF List Price"; }
        .input-table3 td:nth-of-type(3):before { content: "MF Landed Price"; }
        .input-table3 td:nth-of-type(4):before { content: "Item Cost"; }
        .input-table3 td:nth-of-type(5):before { content: "FBA Inbound Cost"; }
        .input-table3 td:nth-of-type(6):before { content: "Shipping"; }
        .input-table3 td:nth-of-type(7):before { content: "Misc Fees"; }
        
    }
    .badge { color: #fff; font-size: 10px; vertical-align: middle; display: inline-block;}
</style>
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Calculator</h1>

    </div>
    <div class="row">
        <div class="table-responsive">
            <table class="table input-table">
                <thead>
                    <tr>
                      <th>FBA Landed Price <span class="badge bg-secondary" data-bs-toggle="tooltip" data-bs-placement="top" title="Total price of a product or shipment once it has arrived at a buyer's doorstep. "><i class="fa fa-question fa-sm"><i></span></th>  
                      <th>MF List Price</th>
                      <th>MF Landed Price <span class="badge bg-secondary" data-bs-toggle="tooltip" data-bs-placement="top" title="Total price of a product or shipment once it has arrived at a buyers doorstep."><i class="fa fa-question fa-sm"><i></span></th>
                      <th>Item Cost <span class="badge bg-secondary" data-bs-toggle="tooltip" data-bs-placement="top" title="Your cost for one book."><i class="fa fa-question fa-sm"><i></span></th>
                      <th>FBA Inbound Cost <span class="badge bg-secondary" data-bs-toggle="tooltip" data-bs-placement="top" title="FBA inbound cost per LBS"><i class="fa fa-question fa-sm"><i></span></th>
                      <th>Shipping <span class="badge bg-secondary" data-bs-toggle="tooltip" data-bs-placement="top" title="Shipping the item to your customer."><i class="fa fa-question fa-sm"><i></span></th>
                      
                      <th>Misc Fees <span class="badge bg-secondary" data-bs-toggle="tooltip" data-bs-placement="top" title="Material & labor cost to ship the book/CD/DVD tp ypur customer."><i class="fa fa-question fa-sm"><i><span></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <div class="input-group">
                                <span class="input-group-addon" id="basic-addon1">$</span>
                                <input type="text" name="fba_price" id="fba_price" onkeyup="C3CalculateProfit.init()" class="form-control" placeholder="0"  aria-describedby="basic-addon1">
                            </div>
                        </td>
                        <td>
                            <div class="input-group">
                                <span class="input-group-addon" id="basic-addon1">$</span>
                                <input type="text" name="mf_price" id="mf_price" onkeyup="C3CalculateProfit.init()" class="form-control" placeholder="0"  aria-describedby="basic-addon1">
                            </div>
                        </td>
                        <td>$<span id="landed_price">0</span></td>
                        
                        <td>
                            <div class="input-group">
                            <span class="input-group-addon" id="basic-addon0">$</span>
                            <input type="text" name="item_cost" id="item_cost" onkeyup="C3CalculateProfit.init()" class="form-control" placeholder="0"   aria-describedby="basic-addon0"/>
                            </div>
                        </td> 
                        <td>
                            <div class="input-group">
                                <span class="input-group-addon" id="basic-addon1">$</span>
                                <input type="text" name="inbound_shipping" id="inbound_shipping" onkeyup="C3CalculateProfit.init()" class="form-control" placeholder="0"  aria-describedby="basic-addon1">
                            </div>
                        </td>  
                      
                        <td>
                            <div class="input-group">
                                <span class="input-group-addon" id="basic-addon1">$</span>
                                <input type="text" name="shipping" id="shipping" onkeyup="C3CalculateProfit.init()" class="form-control" placeholder="0"  aria-describedby="basic-addon1">
                            </div>
                        </td>
                        
                        <td>
                            <div class="input-group">
                                <span class="input-group-addon" id="basic-addon1">$</span>
                                <input type="text" name="misc_fees" id="misc_fees" onkeyup="C3CalculateProfit.init()" class="form-control" placeholder="0"  aria-describedby="basic-addon1">
                            </div>
                        </td>
                        
                    </tr>
                </tbody>
            </table>
          </div> 
        <div class="col-md-12">
            
            <div class="card shadow mb-4">
                <div class="card-body">
                 
                  <div class="btn-group" style="float: right;margin-bottom: 10px;">
                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                     Show/Hide Columns
                    </button>
                    <div class="dropdown-menu dropdown-menu-right">
                      <div class="form-check form-check-inline dropdown-item">
                        <input class="form-check-input hidecol" type="checkbox" value="Media Mail Weight" id="col_2">
                        <label class="form-check-label" for="col_2">Media Mail Weight</label>
                      </div>
                      <div class="form-check form-check-inline dropdown-item">
                        <input class="form-check-input hidecol" type="checkbox" value="2021 Closing Cost" id="col_3">
                        <label class="form-check-label" for="col_3">2021 Closing Cost</label>
                      </div>
                      <div class="form-check form-check-inline dropdown-item">
                        <input class="form-check-input hidecol" type="checkbox" value="Storage Cost" id="col_9">
                        <label class="form-check-label" for="col_9">Storage Cost</label>
                      </div>
                      <div class="form-check form-check-inline dropdown-item">
                        <input class="form-check-input hidecol" type="checkbox" value="USPS Postage" id="col_7">
                        <label class="form-check-label" for="col_7">USPS Postage</label>
                      </div>
                      <div class="form-check form-check-inline dropdown-item">
                        <input class="form-check-input hidecol" type="checkbox" value="(MF) Referral Fee" id="col_4">
                        <label class="form-check-label" for="col_4">(MF) Referral Fee</label>
                      </div>
                      <div class="form-check form-check-inline dropdown-item">
                        <input class="form-check-input hidecol" type="checkbox" value="(MF) Total Fees" id="col_8">
                        <label class="form-check-label" for="col_8">(MF) Total Fees</label>
                      </div>
                      <div class="form-check form-check-inline dropdown-item">
                        <input class="form-check-input hidecol" type="checkbox" value="(MF) Landed Price" id="col_10">
                        <label class="form-check-label" for="col_10">(MF) Landed Price</label>
                      </div>
                      <div class="form-check form-check-inline dropdown-item">
                        <input class="form-check-input hidecol" type="checkbox" value="(MF) Profit/Loss" id="col_11">
                        <label class="form-check-label" for="col_11">(MF) Profit/Loss</label>
                      </div>
                      <div class="form-check form-check-inline dropdown-item">
                        <input class="form-check-input hidecol" type="checkbox" value="(MF) Net Margin" id="col_14">
                        <label class="form-check-label" for="col_14">(MF) Net Margin</label>
                      </div>
                      <div class="form-check form-check-inline dropdown-item">
                        <input class="form-check-input hidecol" type="checkbox" value="(FBA) Referral Fee" id="col_5">
                        <label class="form-check-label" for="col_5">(FBA) Referral Fee</label>
                      </div>
                      <div class="form-check form-check-inline dropdown-item">
                        <input class="form-check-input hidecol" type="checkbox" value="(FBA) Pick & Pack Fee" id="col_6">
                        <label class="form-check-label" for="col_6">(FBA) Pick & Pack Fee</label>
                      </div>
                      <div class="form-check form-check-inline dropdown-item">
                        <input class="form-check-input hidecol" type="checkbox" value="(FBA) Landing Price" id="col_12">
                        <label class="form-check-label" for="col_12">(FBA) Landing Price</label>
                      </div>
                      <div class="form-check form-check-inline dropdown-item">
                        <input class="form-check-input hidecol" type="checkbox" value="FBA Profit/Loss" id="col_13">
                        <label class="form-check-label" for="col_13">FBA Profit/Loss</label>
                      </div>
                      
                      <div class="form-check form-check-inline dropdown-item">
                        <input class="form-check-input hidecol" type="checkbox" value="(FBA) Net Margin" id="col_15">
                        <label class="form-check-label" for="col_15">(FBA) Net Margin</label>
                      </div>
                      
                    </div>
                  </div>
                    <div class="table-responsive">
                        <table class="table" id="emp_table">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Media Mail Weight</th>
                                    <th>2021 Closing Cost</th>
                                    <th>Storage Cost</th>
                                    <th>USPS Postage</th>
                                    <th>(MF) Referral Fee</th>
                                    <th class="bg-warning">(MF) Total Fees</th>
                                    <th class="bg-warning">(MF) Landed Price</th>
                                    <th class="bg-warning">(MF) Profit/Loss</th>
                                    <th class="bg-warning">(MF) Net Margin</th>
                                    <th>(FBA) Referral Fee</th>
                                    <th>(FBA) Pick & Pack Fee</th>
                                    <th>(FBA) Landing Price</th>
                                    <th>FBA Profit/Loss</th>
                                    <th>(FBA) Net Margin</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th>Under 1 lb</th>
                                    <td>1</td>
                                    <td>$<span class="c3_closing_cost" id="c3_closing_cost1lbs">1.80</span></td>
                                    <td>$<span class="c3_storage_cost" id="c3_storage_cost1lbs">0.02</span></td>
                                    <td>$<span class="c3_postage" id="c3_postage1lbs">2.89</span></td>
                                    <td>$<span class="c3_mf_referral_fee" id="c3_mf_referral_fee1lbs">2.10</span></td>
                                    <td class="bg-warning">$<span class="c3_mf_total_fee" id="c3_mf_total_fee1lbs">3.90</span></td>
                                    <td class="bg-warning">$<span class="c3_mf_landed_price" id="c3_mf_landed_price1lbs">0.00</span></td>
                                    <td class="bg-warning">$<span class="c3_mf_profit_loss" id="c3_mf_profit_loss1lbs">0.00</span></td>
                                    <td class="bg-warning"><span class="c3_mf_net_margin" id="c3_mf_net_margin1lbs">0</span>%</td>

                                    <td>$<span class="c3_fbs_referral_fee" id="c3_fbs_referral_fee1lbs">2.10</span></td>
                                    <td>
                                        $<span class="c3_packfee" id="c3_packfee1lbs">3.48</span>
                                        <span class="c3_inbound_cost d-none" id="c3_inbound_costi1lbs">0.20</span>
                                    </td>
                                    <td>$<span class="c3_fba_landed_price" id="c3_fba_landed_price1lbs">0.00</span></td>
                                    <td>$<span class="c3_fba_profit_loss" id="c3_fba_profit_loss1lbs">0.00</span></td>
                                    <td><span class="c3_fba_net_margin" id="c3_fba_net_margin1lbs">0</span>%</td>
                                    
                                </tr>
                                
                                <tr>
                                    <th>1lb - 2lb</th>
                                    <td>2</td>
                                    <td>$<span class="c3_closing_cost" id="c3_closing_cost2lbs">1.80</span></td>
                                    <td>$<span class="c3_storage_cost" id="c3_storage_cost2lbs">0.03</span></td>
                                    <td>$<span class="c3_postage" id="c3_postage2lbs">3.45</span></td>
                                    <td>$<span class="c3_mf_referral_fee" id="c3_mf_referral_fee2lbs">2.10</span></td>
                                    <td class="bg-warning">$<span class="c3_mf_total_fee" id="c3_mf_total_fee2lbs">3.90</span></td>
                                    <td class="bg-warning">$<span class="c3_mf_landed_price" id="c3_mf_landed_price2lbs">0.00</span></td>
                                    <td class="bg-warning">$<span class="c3_mf_profit_loss" id="c3_mf_profit_loss2lbs">0.00</span></td>
                                    <td class="bg-warning"><span class="c3_mf_net_margin" id="c3_mf_net_margin2lbs">0</span>%</td>

                                    <td>$<span class="c3_fbs_referral_fee" id="c3_fbs_referral_fee2lbs">2.10</span></td>
                                    <td>
                                        $<span class="c3_packfee" id="c3_packfee2lbs">4.90</span>
                                        <span class="c3_inbound_cost d-none" id="c3_inbound_costi2lbs">0.20</span>
                                    </td>
                                    <td>$<span class="c3_fba_landed_price" id="c3_fba_landed_price2lbs">13.99</span></td>
                                    <td>$<span class="c3_fba_profit_loss" id="c3_fba_profit_loss2lbs">3.69</span></td>
                                    <td><span class="c3_fba_net_margin" id="c3_fba_net_margin2lbs">0</span>%</td>
                                </tr>
                                <tr>
                                    <th>2lb - 3lb</th>
                                    <td>3</td>
                                    <td>$<span class="c3_closing_cost" id="c3_closing_cost3lbs">1.80</span></td>
                                    <td>$<span class="c3_storage_cost" id="c3_storage_cost3lbs">0.03</span></td>
                                    <td>$<span class="c3_postage" id="c3_postage3lbs">4.01</span></td>
                                    <td>$<span class="c3_mf_referral_fee" id="c3_mf_referral_fee3lbs">2.10</span></td>
                                    
                                    

                                    <td class="bg-warning">$<span class="c3_mf_total_fee" id="c3_mf_total_fee3lbs">3.90</span></td>
                                    
                                    <td class="bg-warning">$<span class="c3_mf_landed_price" id="c3_mf_landed_price3lbs">0.00</span></td>
                                    <td class="bg-warning">$<span class="c3_mf_profit_loss" id="c3_mf_profit_loss3lbs">0.00</span></td>
                                    <td class="bg-warning"><span class="c3_mf_net_margin" id="c3_mf_net_margin3lbs">0</span>%</td>
                                    <td>$<span class="c3_fbs_referral_fee" id="c3_fbs_referral_fee3lbs">2.10</span></td>
                                    <td>
                                        $<span class="c3_packfee" id="c3_packfee3lbs">5.42</span>
                                        <span class="c3_inbound_cost d-none" id="c3_inbound_costi3lbs">0.60</span>
                                    </td>
                                    <td>$<span class="c3_fba_landed_price" id="c3_fba_landed_price3lbs">0.00</span></td>
                                    <td>$<span class="c3_fba_profit_loss" id="c3_fba_profit_loss3lbs">0.00</span></td>

                                    
                                    <td><span class="c3_fba_net_margin" id="c3_fba_net_margin3lbs">0</span>%</td>
                                </tr>
                                <tr>
                                    <th>4lb - 5lb</th>
                                    <td>4</td>
                                    <td>$<span class="c3_closing_cost" id="c3_closing_cost4lbs">1.80</span></td>
                                    <td>$<span class="c3_storage_cost" id="c3_storage_cost4lbs">0.03</span></td>
                                    <td>$<span class="c3_postage" id="c3_postage4lbs">4.57</span></td>
                                    <td>$<span class="c3_mf_referral_fee" id="c3_mf_referral_fee4lbs">2.10</span></td>
                                    <td class="bg-warning">$<span class="c3_mf_total_fee" id="c3_mf_total_fee4lbs">3.90</span></td>
                                    <td class="bg-warning">$<span class="c3_mf_landed_price" id="c3_mf_landed_price4lbs">0.00</span></td>
                                    <td class="bg-warning">$<span class="c3_mf_profit_loss" id="c3_mf_profit_loss4lbs">0.00</span></td>
                                    <td class="bg-warning"><span class="c3_mf_net_margin" id="c3_mf_net_margin4lbs">0</span>%</td>
                                    <td>$<span class="c3_fbs_referral_fee" id="c3_fbs_referral_fee4lbs">2.10</span></td>
                                    <td>
                                        $<span class="c3_packfee" id="c3_packfee4lbs">5.42</span>
                                        <span class="c3_inbound_cost d-none" id="c3_inbound_costi4lbs">0.80</span>
                                    </td>
                                    <td>$<span class="c3_fba_landed_price" id="c3_fba_landed_price4lbs">0.00</span></td>
                                    <td>$<span class="c3_fba_profit_loss" id="c3_fba_profit_loss4lbs">0.00</span></td>
                                    <td><span class="c3_fba_net_margin" id="c3_fba_net_margin4lbs">0</span>%</td>
                                </tr>
                                <tr>
                                    <th>5lb - 6lb</th>
                                    <td>5</td>
                                    <td>$<span class="c3_closing_cost" id="c3_closing_cost5lbs">1.80</span></td>
                                    <td>$<span class="c3_storage_cost" id="c3_storage_cost5lbs">0.03</span></td>
                                    <td>$<span class="c3_postage" id="c3_postage5lbs">5.13</span></td>
                                    <td>$<span class="c3_mf_referral_fee" id="c3_mf_referral_fee5lbs">2.10</span></td>
                                    <td class="bg-warning">$<span class="c3_mf_total_fee" id="c3_mf_total_fee5lbs">3.90</span></td>
                                    <td class="bg-warning">$<span class="c3_mf_landed_price" id="c3_mf_landed_price5lbs">0.00</span></td>
                                    <td class="bg-warning">$<span class="c3_mf_profit_loss" id="c3_mf_profit_loss5lbs">0.00</span></td>
                                    <td class="bg-warning"><span class="c3_mf_net_margin" id="c3_mf_net_margin5lbs">0</span>%</td>
                                    <td>$<span class="c3_fbs_referral_fee" id="c3_fbs_referral_fee5lbs">2.10</span></td>
                                    <td>
                                        $<span class="c3_packfee" id="c3_packfee5lbs">5.42</span>
                                        <span class="c3_inbound_cost d-none" id="c3_inbound_costi5lbs">1.00</span>
                                    </td>
                                    <td>$<span class="c3_fba_landed_price" id="c3_fba_landed_price5lbs">0.00</span></td>
                                    <td>$<span class="c3_fba_profit_loss" id="c3_fba_profit_loss5lbs">0.00</span></td>
                                    <td><span class="c3_fba_net_margin" id="c3_fba_net_margin5lbs">0</span>%</td>
                                </tr>
                                
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
@push('scripts')
  <script>
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
      var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
      return new bootstrap.Tooltip(tooltipTriggerEl)
    });
    $(document).ready(function(){

      // Checkbox click
      $(".hidecol").click(function(){

          var id = this.id;
          var splitid = id.split("_");
          var colno = splitid[1];
          var checked = true;
          
          // Checking Checkbox state
          if($(this).is(":checked")){
              checked = true;
          }else{
              checked = false;
          }
          setTimeout(function(){
              if(checked){
                  $('#emp_table td:nth-child('+colno+')').hide();
                  $('#emp_table th:nth-child('+colno+')').hide();
              } else{
                  $('#emp_table td:nth-child('+colno+')').show();
                  $('#emp_table th:nth-child('+colno+')').show();
              }

          }, 100);

      });
    });
    var fba_price = 0;
    var item_cost = 0;
    var mf_price = 0;
    var landed_price = 0;
    var inbound_shipping = 0;
    var shipping = 0;
    var misc_fees = 0;
    var C3CalculateProfit = function() {
      var _init = function() {
         _updateVariableValues();
        _updatereferralfee();
        _updatemfLandedPrice();
        _updateMFProfitLoss();
        _updatefbaLandedPrice();
        _updateFBAProfitLoss();
        _updateMFMargin();
        _updateFBAMargin();
      }

      var _updateVariableValues = function() {
        
        if($.trim($('#fba_price').val()) != '')
        {
          fba_price = $('#fba_price').val();
        }else{
          fba_price = 0;
        }

        if($.trim($('#mf_price').val()) != '')
        {
          mf_price = $('#mf_price').val();
        }else{
          mf_price = 0;
        }
        
        if($.trim($('#inbound_shipping').val()) != '')
        {
          inbound_shipping = $('#inbound_shipping').val();
        }else{
          inbound_shipping = 0;
        }

        if($.trim($('#item_cost').val()) != '')
        {
          item_cost = $('#item_cost').val();
        }else{
          item_cost = 0;
        }

        if($.trim($('#shipping').val()) != '')
        {
          shipping = $('#shipping').val();
        }else{
          shipping = 0;
        }

        if($.trim($('#misc_fees').val()) != '')
        {
          misc_fees = $('#misc_fees').val();
        }else{
          misc_fees = 0;
        }
        
        landedprice = parseFloat(mf_price)+parseFloat(shipping);
        landed_price = landedprice.toFixed(2);
        $('#landed_price').text(landed_price);
        _updateinboundCost();
      }

      var _updatereferralfee = function() {
        var c3_refferralfee = (parseFloat(landed_price)/100)*15;
        $('.c3_mf_referral_fee').text(c3_refferralfee.toFixed(2));
        // console.log(landed_price);
        _updatefbareferralfee();
      }

      var _updatefbareferralfee = function() {
        var c3_fbarefferralfee = (parseFloat(fba_price)/100)*15;
        $('.c3_fbs_referral_fee').text(c3_fbarefferralfee.toFixed(2));
        
        // console.log(landed_price);
        
      }

      var _updatemfLandedPrice = function() {
        $('.c3_mf_landed_price').text(parseFloat(landed_price).toFixed(2));
        // console.log(landed_price);
        
      }

      
      var _updateinboundCostBylbs = function(name='', weight=0) {
        
          c3Inboundcost = parseFloat(inbound_shipping)*parseFloat(weight);
        
        $('#c3_inbound_costi'+name).text(c3Inboundcost.toFixed(2));
      }

      var _updateinboundCost = function() {
        _updateinboundCostBylbs('1lbs', 1);
        _updateinboundCostBylbs('2lbs', 2);
        _updateinboundCostBylbs('3lbs', 4);
        _updateinboundCostBylbs('4lbs', 5);
        _updateinboundCostBylbs('5lbs', 6);
      }

      var _updateMFProfitLossBylbs = function(name='') {
        var c3fba_referral_fee = $('#c3_fbs_referral_fee'+name).text();
        var c3postage = $("#c3_postage"+name).text();
        var c3closingcost = $("#c3_closing_cost"+name).text();
        var c1TotalProfit = parseFloat(landed_price)-parseFloat(c3fba_referral_fee)-parseFloat(misc_fees)-parseFloat(c3postage)-parseFloat(c3closingcost)-parseFloat(item_cost);
        $('#c3_mf_profit_loss'+name).text(c1TotalProfit.toFixed(2));
        // console.log(landed_price);
        // console.log(c3fba_referral_fee);
        // console.log(misc_fees);
        // console.log(c3postage);
        // console.log(c3closingcost);
        // console.log(item_cost);
      }

      var _updateMFProfitLoss = function() {
        _updateMFProfitLossBylbs('1lbs');
        _updateMFProfitLossBylbs('2lbs');
        _updateMFProfitLossBylbs('3lbs');
        _updateMFProfitLossBylbs('4lbs');
        _updateMFProfitLossBylbs('5lbs');
      }

      var _updatefbaLandedPrice = function() {
        $('.c3_fba_landed_price').text(parseFloat(fba_price).toFixed(2));
       }

      var _updateFBAProfitLossBylbs = function(name='') {
        var c3fba_referral_fee = $('#c3_fbs_referral_fee'+name).text();
        var c3_inboundcost = $("#c3_inbound_costi"+name).text();
        var c3_packfee = $("#c3_packfee"+name).text();
        var c3closingcost = $("#c3_closing_cost"+name).text();
        var c3_storagecost = $("#c3_storage_cost"+name).text();
        var fbaTotalProfit = parseFloat(fba_price)-parseFloat(c3fba_referral_fee)-parseFloat(c3closingcost)-parseFloat(c3_packfee)-parseFloat(c3_inboundcost)-parseFloat(item_cost)-parseFloat(c3_storagecost);
        $('#c3_fba_profit_loss'+name).text(fbaTotalProfit.toFixed(2));
      }

      var _updateFBAProfitLoss = function() {
        _updateFBAProfitLossBylbs('1lbs');
        _updateFBAProfitLossBylbs('2lbs');
        _updateFBAProfitLossBylbs('3lbs');
        _updateFBAProfitLossBylbs('4lbs');
        _updateFBAProfitLossBylbs('5lbs');
      }

      var _updateMFMarginBylbs = function(name='') {
        var c3_mfprofitloss = $('#c3_mf_profit_loss'+name).text();
        var mfmargin = (parseFloat(c3_mfprofitloss)/parseFloat(landed_price))*100;
        if(mfmargin == '-Infinity')
        {
          mfmargin = 0;
        }
        $('#c3_mf_net_margin'+name).text(Math.round(mfmargin));
        // console.log(landed_price);
      }

      var _updateMFMargin = function() {
        _updateMFMarginBylbs('1lbs');
        _updateMFMarginBylbs('2lbs');
        _updateMFMarginBylbs('3lbs');
        _updateMFMarginBylbs('4lbs');
        _updateMFMarginBylbs('5lbs');
      }

      var _updateFBAMarginBylbs = function(name='') {

        var c3_fbaprofitloss = $('#c3_fba_profit_loss'+name).text();
        var c3_mfprofitloss = $('#c3_mf_profit_loss'+name).text();
        if(fba_price != 0)
        {
          if(name =='1lbs')
          {
            var fbamargin = (parseFloat(c3_fbaprofitloss)/parseFloat(fba_price))*100;
          }else{
            var fbamargin = (parseFloat(c3_mfprofitloss)/parseFloat(fba_price))*100;
          }
        }else{
          var fbamargin = 0;
        }
        
        if(fbamargin == '-Infinity')
        {
          var fbamargin = 0;
        }
        console.log(Math.round(fbamargin));
        $('#c3_fba_net_margin'+name).text(Math.round(fbamargin));
      }

      var _updateFBAMargin = function() {
        _updateFBAMarginBylbs('1lbs');
        _updateFBAMarginBylbs('2lbs');
        _updateFBAMarginBylbs('3lbs');
        _updateFBAMarginBylbs('4lbs');
        _updateFBAMarginBylbs('5lbs');
      }

      return {
        init: _init,
        updateVariableValues: _updateVariableValues,
        updatereferralfee: _updatereferralfee,
        updatemfLandedPrice: _updatemfLandedPrice,
        updateMFProfitLoss: _updateMFProfitLoss,
        updatefbaLandedPrice: _updatefbaLandedPrice,
        updateFBAProfitLoss: _updateFBAProfitLoss,
        updateMFMargin: _updateMFMargin,
        updateFBAMargin: _updateFBAMargin
      }
    }();
    C3CalculateProfit.init();

    
   
  </script>
@endpush