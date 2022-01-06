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
        .input-table table, .input-table thead, .input-table tbody, .input-table th, .input-table td, .input-table tr { 
            display: block; 
        }
        
        /* Hide table headers (but not display: none;, for accessibility) */
        .input-table thead tr { 
            position: absolute;
            top: -9999px;
            left: -9999px;
        }
        
        .input-table tr { border: 1px solid #ccc; }
        
        .input-table td { 
            /* Behave  like a "row" */
            border: none;
            border-bottom: 1px solid #eee; 
            position: relative;
            padding-left: 50%; 
        }
        
        .input-table td:before { 
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
        .input-table td:nth-of-type(1):before { content: "Item Cost"; }
        .input-table td:nth-of-type(2):before { content: "List Price"; }
        .input-table td:nth-of-type(3):before { content: "Shipping"; }
        .input-table td:nth-of-type(4):before { content: "Landed Price"; }
        .input-table td:nth-of-type(5):before { content: "Misc Fees"; }
        
    }
    .badge { color: #fff; font-size: 10px; vertical-align: middle;}
</style>
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Merchant Fulfilled Amazon pricing Jan 2020		
        </h1>
        <p class="text-center">Straight Mail</p>
    </div>
    <div class="row">
       
        <div class="col-md-12">
          <div class="table-responsive">
            <table class="table input-table">
                <thead>
                    <tr>
                      <th>Item Cost <span class="badge bg-secondary" data-bs-toggle="tooltip" data-bs-placement="top" title="Your cost for one book."><i class="fa fa-question fa-sm"><i></span></th>  
                      <th>List Price</th>
                      <th>Shipping <span class="badge bg-secondary" data-bs-toggle="tooltip" data-bs-placement="top" title="Shipping the item to your customer."><i class="fa fa-question fa-sm"><i></span></th>
                      <th style="width: 150px;">Landed Price<span class="badge bg-secondary" data-bs-toggle="tooltip" data-bs-placement="top" title="Landed cost is the total price of a product or shipment once it has arrived at a buyer's doorstep."><i class="fa fa-question fa-sm"><i></span></th>
                      <th>Misc Fees <span class="badge bg-secondary" data-bs-toggle="tooltip" data-bs-placement="top" title="Material & labor cost to ship the book/CD/DVD tp ypur customer."><i class="fa fa-question fa-sm"><i><span></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                      <td>
                        <div class="input-group">
                          <span class="input-group-addon" id="basic-addon0">$</span>
                          <input type="text" name="item_cost" id="item_cost" class="form-control" placeholder="Item Cost"  value="10" aria-describedby="basic-addon0"/>
                        </div>
                      </td>   
                      <td>
                            <div class="input-group">
                                <span class="input-group-addon" id="basic-addon1">$</span>
                                <input type="text" name="list_price" id="list_price" class="form-control" placeholder="enter base price here" value="1000" aria-describedby="basic-addon1">
                            </div>
                        </td>
                        <td>
                            <div class="input-group">
                                <span class="input-group-addon" id="basic-addon1">$</span>
                                <input type="text" name="shipping" id="shipping" class="form-control" placeholder="enter your shipping base add in here" value="" aria-describedby="basic-addon1">
                            </div>
                        </td>
                        <td>$<span id="landed_price">1000.00</span></td>
                        <td>
                            <div class="input-group">
                                <span class="input-group-addon" id="basic-addon1">$</span>
                                <input type="text" name="misc_fees" id="misc_fees" class="form-control" placeholder="Misc Fees" value="0.10" aria-describedby="basic-addon1">
                            </div>
                        </td>
                        
                    </tr>
                </tbody>
            </table>
          </div> 
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>2018 Closing Cost <span class="badge bg-secondary" data-bs-toggle="tooltip" data-bs-placement="top" title="Amazon closing fee."><i class="fa fa-question fa-sm"><i></span></th>
                                    <th>Postage/Media Mail <span class="badge bg-secondary" data-bs-toggle="tooltip" data-bs-placement="top" title="Your cost to ship USPS media mail."><i class="fa fa-question fa-sm"><i></span></th>
                                    <th>15% of Landed <span class="badge bg-secondary" data-bs-toggle="tooltip" data-bs-placement="top" title="Merchant Fulfillment 15% referral fee percentage."><i class="fa fa-question fa-sm"><i></span></th>
                                    <th>Misc Fees <span class="badge bg-secondary" data-bs-toggle="tooltip" data-bs-placement="top" title="Material & labor cost to ship the book/CD/DVD tp ypur customer."><i class="fa fa-question fa-sm"><i></span></th>
                                    <th>Total Fees <span class="badge bg-secondary" data-bs-toggle="tooltip" data-bs-placement="top" title="Total merchant fulfillment fee's. "><i class="fa fa-question fa-sm"><i></span></th>
                                    <th>Profit/Loss <span class="badge bg-secondary" data-bs-toggle="tooltip" data-bs-placement="top" title="Profit / Loss on your book / CD / DVD weight round."><i class="fa fa-question fa-sm"><i></span></th>
                                    <th>FBA Profit/Loss </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th>Under 1lbs</th>
                                    <td>$<span class="c1_closing_cost" id="c1_closing_cost1lbs">1.80</span></td>
                                    <td>$<span class="c1_postage" id="c1_postage1lbs">{{$price_list['1lbs']}}</span>
                                        <div class="input-group d-none">
                                            <span class="input-group-addon" id="basic-addon1">$</span>
                                            <input type="text" name="c1_postage[1lbs]" class="form-control " placeholder="Postage/Media Mail" value="{{$price_list['1lbs']}}" aria-describedby="basic-addon1">
                                        </div>
                                    </td>
                                    <td>$<span class="c1_landed" id="c1_landed1lbs">150.00</span></td>
                                    <td>$<span class="c1_miscfees" class="c1_miscfees1lbs">0.10</span></td>
                                    <td>$<span id="c1_totalfees1lbs">147.50</span><input type="hidden" name="c1_totalfees[1lbs]"></td>
                                    <td>$<span id="c1_profit_loss1lbs">832.40</span><input type="hidden" name="c1_profit_loss[1lbs]"></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th>1-2lbs</th>
                                    <td>$<span class="c1_closing_cost" id="c1_closing_cost2lbs">1.80</span></td>
                                    <td>$<span class="c1_postage" id="c1_postage2lbs">{{$price_list['2lbs']}}</span>
                                        <div class="input-group d-none">
                                            <span class="input-group-addon" id="basic-addon1">$</span>
                                            <input type="text" name="c1_postage[2lbs]" class="form-control c1_postage" placeholder="Postage/Media Mail" value="{{$price_list['2lbs']}}" aria-describedby="basic-addon1">
                                        </div>
                                    </td>
                                    <td>$<span class="c1_landed" id="c1_landed2lbs">150.00</span></td>
                                    <td>$<span class="c1_miscfees" class="c1_miscfees2lbs">0.10</span></td>
                                    <td>$<span id="c1_totalfees2lbs">147.50</span><input type="hidden" name="c1_totalfees[2lbs]"></td>
                                    <td>$<span id="c1_profit_loss2lbs">832.40</span><input type="hidden" name="c1_profit_loss[2lbs]"></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th>2-3lbs</th>
                                    <td>$<span class="c1_closing_cost" id="c1_closing_cost3lbs">1.80</span></td>
                                    <td>$<span class="c1_postage" id="c1_postage3lbs">{{$price_list['3lbs']}}</span>
                                        <div class="input-group d-none">
                                            <span class="input-group-addon" id="basic-addon1">$</span>
                                            <input type="text" name="c1_postage[3lbs]" class="form-control c1_postage" placeholder="Postage/Media Mail" value="{{$price_list['3lbs']}}" aria-describedby="basic-addon1">
                                        </div>
                                    </td>
                                    <td>$<span class="c1_landed" id="c1_landed3lbs">150.00</span></td>
                                    <td>$<span class="c1_miscfees" class="c1_miscfees3lbs">0.10</span></td>
                                    <td>$<span id="c1_totalfees3lbs">147.50</span><input type="hidden" name="c1_totalfees[3lbs]"></td>
                                    <td>$<span id="c1_profit_loss3lbs">832.40</span><input type="hidden" name="c1_profit_loss[3lbs]"></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th>3-4lbs</th>
                                    <td>$<span class="c1_closing_cost" id="c1_closing_cost4lbs">1.80</span></td>
                                    <td>$<span class="c1_postage" id="c1_postage4lbs">{{$price_list['4lbs']}}</span>
                                        <div class="input-group d-none">
                                            <span class="input-group-addon" id="basic-addon1">$</span>
                                            <input type="text" name="c1_postage[4lbs]" class="form-control c1_postage" placeholder="Postage/Media Mail" value="{{$price_list['4lbs']}}" aria-describedby="basic-addon1">
                                        </div>
                                    </td>
                                    <td>$<span class="c1_landed" id="c1_landed4lbs">150.00</span></td>
                                    <td>$<span class="c1_miscfees" class="c1_miscfees4lbs">0.10</span></td>
                                    <td>$<span id="c1_totalfees4lbs">147.50</span><input type="hidden" name="c1_totalfees[4lbs]"></td>
                                    <td>$<span id="c1_profit_loss4lbs">832.40</span><input type="hidden" name="c1_profit_loss[4lbs]"></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th>4-5lbs</th>
                                    <td>$<span class="c1_closing_cost" id="c1_closing_cost5lbs">1.80</span></td>
                                    <td>$<span class="c1_postage" id="c1_postage5lbs">{{$price_list['5lbs']}}</span>
                                        <div class="input-group d-none">
                                            <span class="input-group-addon" id="basic-addon1">$</span>
                                            <input type="text" name="c1_postage[5lbs]" class="form-control c1_postage" placeholder="Postage/Media Mail" value="{{$price_list['5lbs']}}" aria-describedby="basic-addon1">
                                        </div>
                                    </td>
                                    <td>$<span class="c1_landed" id="c1_landed5lbs">150.00</span></td>
                                    <td>$<span class="c1_miscfees" class="c1_miscfees5lbs">0.10</span></td>
                                    <td>$<span id="c1_totalfees5lbs">147.50</span><input type="hidden" name="c1_totalfees[5lbs]"></td>
                                    <td>$<span id="c1_profit_loss5lbs">832.40</span><input type="hidden" name="c1_profit_loss[5lbs]"></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th>5-6lbs</th>
                                    <td>$<span class="c1_closing_cost" id="c1_closing_cost6lbs">1.80</span></td>
                                    <td>$<span class="c1_postage" id="c1_postage6lbs">{{$price_list['6lbs']}}</span>
                                        <div class="input-group d-none">
                                            <span class="input-group-addon" id="basic-addon1">$</span>
                                            <input type="text" name="c1_postage[6lbs]" class="form-control c1_postage" placeholder="Postage/Media Mail" value="{{$price_list['6lbs']}}" aria-describedby="basic-addon1">
                                        </div>
                                    </td>
                                    <td>$<span class="c1_landed" id="c1_landed6lbs">150.00</span></td>
                                    <td>$<span class="c1_miscfees" class="c1_miscfees6lbs">0.10</span></td>
                                    <td>$<span id="c1_totalfees6lbs">147.50</span><input type="hidden" name="c1_totalfees[6lbs]"></td>
                                    <td>$<span id="c1_profit_loss6lbs">832.40</span><input type="hidden" name="c1_profit_loss[6lbs]"></td>
                                    <td></td>
                                </tr>
                                <tr  class="d-none">
                                    <th>6-7lbs</th>
                                    <td>$<span class="c1_closing_cost" id="c1_closing_cost7lbs">1.80</span></td>
                                    <td>
                                        <div class="input-group">
                                            <span class="input-group-addon" id="basic-addon1">$</span>
                                            <input type="text" name="c1_postage[7lbs]" class="form-control c1_postage" placeholder="Postage/Media Mail" value="29.20" aria-describedby="basic-addon1">
                                        </div>
                                    </td>
                                    <td>$<span class="c1_landed" id="c1_landed7lbs">150.00</span></td>
                                    <td>$<span class="c1_miscfees" class="c1_miscfees7lbs">0.10</span></td>
                                    <td>$<span id="c1_totalfees7lbs">147.50</span><input type="hidden" name="c1_totalfees[7lbs]"></td>
                                    <td>$<span id="c1_profit_loss7lbs">832.40</span><input type="hidden" name="c1_profit_loss[7lbs]"></td>
                                    <td></td>
                                </tr>
                                <tr class="d-none">
                                    <th>7-8lbs</th>
                                    <td>$<span class="c1_closing_cost" id="c1_closing_cost8lbs">1.80</span></td>
                                    <td>
                                        <div class="input-group">
                                            <span class="input-group-addon" id="basic-addon1">$</span>
                                            <input type="text" name="c1_postage[8lbs]" class="form-control c1_postage" placeholder="Postage/Media Mail" value="36.75" aria-describedby="basic-addon1">
                                        </div>
                                    </td>
                                    <td>$<span class="c1_landed" id="c1_landed8lbs">150.00</span></td>
                                    <td>$<span class="c1_miscfees" class="c1_miscfees8lbs">0.10</span></td>
                                    <td>$<span id="c1_totalfees8lbs">147.50</span><input type="hidden" name="c1_totalfees[8lbs]"></td>
                                    <td>$<span id="c1_profit_loss8lbs">832.40</span><input type="hidden" name="c1_profit_loss[8lbs]"></td>
                                    <td></td>
                                </tr>
                                <tr class="d-none">
                                    <th>8-9lbs</th>
                                    <td>$<span class="c1_closing_cost" id="c1_closing_cost9lbs">1.80</span></td>
                                    <td>
                                        <div class="input-group">
                                            <span class="input-group-addon" id="basic-addon1">$</span>
                                            <input type="text" name="c1_postage[9lbs]" class="form-control c1_postage" placeholder="Postage/Media Mail" value="40.90" aria-describedby="basic-addon1">
                                        </div>
                                    </td>
                                    <td>$<span class="c1_landed" id="c1_landed9lbs">150.00</span></td>
                                    <td>$<span class="c1_miscfees" class="c1_miscfees9lbs">0.10</span></td>
                                    <td>$<span id="c1_totalfees9lbs">147.50</span><input type="hidden" name="c1_totalfees[9lbs]"></td>
                                    <td>$<span id="c1_profit_loss9lbs">832.40</span><input type="hidden" name="c1_profit_loss[9lbs]"></td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>2018 Closing Cost
                                    </th>
                                    <th>Postage/Media Mail
                                    </th>
                                    <th>15% of Landed
                                    </th>
                                    <th>Misc Fees
                                    </th>
                                    <th>Total Fees
                                    </th>
                                    <th style="width: 150px;">
                                        Desired Profit:
                                        <div class="input-group d-none">
                                            <span class="input-group-addon" id="basic-addon1">$</span>
                                            <input type="text" name="desired_profit" id="desired_profit" class="form-control" placeholder="Desired Profit" value="5.55" aria-describedby="basic-addon1">
                                        </div>
                                    </th>
                                    <th>Landed
                                    </th>
                                    <th>Listed</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th>Under 1lbs</th>
                                    <td>$<span class="c2_closing_cost" id="c2_closing_cost1lbs">1.80</span></td>
                                    <td>$<span id="c2_postage1lbs">5.60</span></td>
                                    <td>$<span id="c2_landedpercent1lbs">147.50</span><input type="hidden" name="c2_landedpercent[1lbs]"></td>
                                    <td>$<span class="c2_miscfees" class="c2_miscfees1lbs">0.10</span></td>
                                    <td>$<span id="c2_totalfees1lbs">147.50</span><input type="hidden" name="c2_totalfees[1lbs]"></td>
                                    <td>$<span id="c2_desired_profit1lbs">147.50</span><input type="hidden" name="c2_desired_profit[1lbs]"></td>
                                    <td>$<span id="c2_landed1lbs">147.50</span><input type="hidden" name="c2_landed[1lbs]"></td>
                                    <td>$<span id="c2_listed1lbs">147.50</span><input type="hidden" name="c2_listed[1lbs]"></td>
                                </tr>
                                <tr>
                                    <th>1-2lbs</th>
                                    <td>$<span class="c2_closing_cost" id="c2_closing_cost2lbs">1.80</span></td>
                                    <td>$<span id="c2_postage2lbs">5.60</span></td>
                                    <td>$<span id="c2_landedpercent2lbs">147.50</span><input type="hidden" name="c2_landedpercent[2lbs]"></td>
                                    <td>$<span class="c2_miscfees" class="c2_miscfees2lbs">0.10</span></td>
                                    <td>$<span id="c2_totalfees2lbs">147.50</span><input type="hidden" name="c2_totalfees[2lbs]"></td>
                                    <td>$<span id="c2_desired_profit2lbs">147.50</span><input type="hidden" name="c2_desired_profit[2lbs]"></td>
                                    <td>$<span id="c2_landed2lbs">147.50</span><input type="hidden" name="c2_landed[2lbs]"></td>
                                    <td>$<span id="c2_listed2lbs">147.50</span><input type="hidden" name="c2_listed[2lbs]"></td>
                                </tr>
                                <tr>
                                    <th>2-3lbs</th>
                                    <td>$<span class="c2_closing_cost" id="c2_closing_cost3lbs">1.80</span></td>
                                    <td>$<span id="c2_postage3lbs">5.60</span></td>
                                    <td>$<span id="c2_landedpercent3lbs">147.50</span><input type="hidden" name="c2_landedpercent[3lbs]"></td>
                                    <td>$<span class="c2_miscfees" class="c2_miscfees3lbs">0.10</span></td>
                                    <td>$<span id="c2_totalfees3lbs">147.50</span><input type="hidden" name="c2_totalfees[3lbs]"></td>
                                    <td>$<span id="c2_desired_profit3lbs">147.50</span><input type="hidden" name="c2_desired_profit[3lbs]"></td>
                                    <td>$<span id="c2_landed3lbs">147.50</span><input type="hidden" name="c2_landed[3lbs]"></td>
                                    <td>$<span id="c2_listed3lbs">147.50</span><input type="hidden" name="c2_listed[3lbs]"></td>
                                </tr>
                                <tr>
                                    <th>3-4lbs</th>
                                    <td>$<span class="c2_closing_cost" id="c2_closing_cost4lbs">1.80</span></td>
                                    <td>$<span id="c2_postage4lbs">5.60</span></td>
                                    <td>$<span id="c2_landedpercent4lbs">147.50</span><input type="hidden" name="c2_landedpercent[4lbs]"></td>
                                    <td>$<span class="c2_miscfees" class="c2_miscfees4lbs">0.10</span></td>
                                    <td>$<span id="c2_totalfees4lbs">147.50</span><input type="hidden" name="c2_totalfees[4lbs]"></td>
                                    <td>$<span id="c2_desired_profit4lbs">147.50</span><input type="hidden" name="c2_desired_profit[4lbs]"></td>
                                    <td>$<span id="c2_landed4lbs">147.50</span><input type="hidden" name="c2_landed[4lbs]"></td>
                                    <td>$<span id="c2_listed4lbs">147.50</span><input type="hidden" name="c2_listed[4lbs]"></td>
                                </tr>
                                <tr>
                                    <th>4-5lbs</th>
                                    <td>$<span class="c2_closing_cost" id="c2_closing_cost5lbs">1.80</span></td>
                                    <td>$<span id="c2_postage5lbs">5.60</span></td>
                                    <td>$<span id="c2_landedpercent5lbs">147.50</span><input type="hidden" name="c2_landedpercent[5lbs]"></td>
                                    <td>$<span class="c2_miscfees" class="c2_miscfees5lbs">0.10</span></td>
                                    <td>$<span id="c2_totalfees5lbs">147.50</span><input type="hidden" name="c2_totalfees[5lbs]"></td>
                                    <td>$<span id="c2_desired_profit5lbs">147.50</span><input type="hidden" name="c2_desired_profit[5lbs]"></td>
                                    <td>$<span id="c2_landed5lbs">147.50</span><input type="hidden" name="c2_landed[5lbs]"></td>
                                    <td>$<span id="c2_listed5lbs">147.50</span><input type="hidden" name="c2_listed[5lbs]"></td>
                                </tr>
                                <tr>
                                    <th>5-6lbs</th>
                                    <td>$<span class="c2_closing_cost" id="c2_closing_cost6lbs">1.80</span></td>
                                    <td>$<span id="c2_postage6lbs">5.60</span></td>
                                    <td>$<span id="c2_landedpercent6lbs">147.50</span><input type="hidden" name="c2_landedpercent[6lbs]"></td>
                                    <td>$<span class="c2_miscfees" class="c2_miscfees6lbs">0.10</span></td>
                                    <td>$<span id="c2_totalfees6lbs">147.50</span><input type="hidden" name="c2_totalfees[6lbs]"></td>
                                    <td>$<span id="c2_desired_profit6lbs">147.50</span><input type="hidden" name="c2_desired_profit[6lbs]"></td>
                                    <td>$<span id="c2_landed6lbs">147.50</span><input type="hidden" name="c2_landed[6lbs]"></td>
                                    <td>$<span id="c2_listed6lbs">147.50</span><input type="hidden" name="c2_listed[6lbs]"></td>
                                </tr>
                                <tr class="d-none">
                                    <th>6-7lbs</th>
                                    <td>$<span class="c2_closing_cost" id="c2_closing_cost7lbs">1.80</span></td>
                                    <td>$<span id="c2_postage7lbs">5.60</span></td>
                                    <td>$<span id="c2_landedpercent7lbs">147.50</span><input type="hidden" name="c2_landedpercent[7lbs]"></td>
                                    <td>$<span class="c2_miscfees" class="c2_miscfees7lbs">0.10</span></td>
                                    <td>$<span id="c2_totalfees7lbs">147.50</span><input type="hidden" name="c2_totalfees[7lbs]"></td>
                                    <td>$<span id="c2_desired_profit7lbs">147.50</span><input type="hidden" name="c2_desired_profit[7lbs]"></td>
                                    <td>$<span id="c2_landed7lbs">147.50</span><input type="hidden" name="c2_landed[7lbs]"></td>
                                    <td>$<span id="c2_listed7lbs">147.50</span><input type="hidden" name="c2_listed[7lbs]"></td>
                                </tr>
                                <tr class="d-none">
                                    <th>7-8lbs</th>
                                    <td>$<span class="c2_closing_cost" id="c2_closing_cost8lbs">1.80</span></td>
                                    <td>$<span id="c2_postage8lbs">5.60</span></td>
                                    <td>$<span id="c2_landedpercent8lbs">147.50</span><input type="hidden" name="c2_landedpercent[8lbs]"></td>
                                    <td>$<span class="c2_miscfees" class="c2_miscfees8lbs">0.10</span></td>
                                    <td>$<span id="c2_totalfees8lbs">147.50</span><input type="hidden" name="c2_totalfees[8lbs]"></td>
                                    <td>$<span id="c2_desired_profit8lbs">147.50</span><input type="hidden" name="c2_desired_profit[8lbs]"></td>
                                    <td>$<span id="c2_landed8lbs">147.50</span><input type="hidden" name="c2_landed[8lbs]"></td>
                                    <td>$<span id="c2_listed8lbs">147.50</span><input type="hidden" name="c2_listed[8lbs]"></td>
                                </tr>
                                <tr class="d-none">
                                    <th>8-9lbs</th>
                                    <td>$<span class="c2_closing_cost" id="c2_closing_cost9lbs">1.80</span></td>
                                    <td>$<span id="c2_postage9lbs">5.60</span></td>
                                    <td>$<span id="c2_landedpercent9lbs">147.50</span><input type="hidden" name="c2_landedpercent[9lbs]"></td>
                                    <td>$<span class="c2_miscfees" class="c2_miscfees9lbs">0.10</span></td>
                                    <td>$<span id="c2_totalfees9lbs">147.50</span><input type="hidden" name="c2_totalfees[9lbs]"></td>
                                    <td>$<span id="c2_desired_profit9lbs">147.50</span><input type="hidden" name="c2_desired_profit[9lbs]"></td>
                                    <td>$<span id="c2_landed9lbs">147.50</span><input type="hidden" name="c2_landed[9lbs]"></td>
                                    <td>$<span id="c2_listed9lbs">147.50</span><input type="hidden" name="c2_listed[9lbs]"></td>
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
})
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
    var misc_fees = 0.10;
    var landed_price = 1000;
    var shipping = 0;
    var list_price = 1000;
    var c1_landed = 0;
    var closing_cost = 1.80;
    var C1CalculateProfit = function() {
      var _init = function() {
        _updateClosingCost();
        _updatelandedpercent();
        _updateMiscFees();
      }

      var _updateClosingCost = function() {
        $('.c1_closing_cost').text(closing_cost.toFixed(2));
      }

      var _updatelandedpercent = function() {
        c1_landed = (parseFloat(landed_price)/100)*15;
        $('.c1_landed').text(c1_landed.toFixed(2));
        // _updatelandedPrice();
      }

      var _updatelandedPrice = function() {
        landed_price = (parseFloat(list_price)+parseFloat(shipping));
        $('#landed_price').text(landed_price.toFixed(2));
        _updatelandedpercent();
        _updateTotalFees();
      }

      var _updateMiscFees = function() {
        $('.c1_miscfees').text(misc_fees.toFixed(2));
        _updateTotalFees();
      }


      var _updateTotalFeesBylbs = function(name='') {
        var c1closingcost = $('#c1_closing_cost'+name).text();
        var c1postage = $("input[name='c1_postage["+name+"]']").val();
        var c1landed = $("#c1_landed"+name).text();
        var c1TotalFees = (parseFloat(c1closingcost)+parseFloat(c1postage)+parseFloat(c1landed)+parseFloat(misc_fees))-parseFloat(item_cost);
        $('#c1_totalfees'+name).text(c1TotalFees.toFixed(2));
        $("input[name='c1_totalfees["+name+"]']").val(c1TotalFees);
        // console.log($("input[name='c1_totalfees["+name+"]']").val());
      }

      var _updateTotalFees = function() {
        _updateTotalFeesBylbs('1lbs');
        _updateTotalFeesBylbs('2lbs');
        _updateTotalFeesBylbs('3lbs');
        _updateTotalFeesBylbs('4lbs');
        _updateTotalFeesBylbs('5lbs');
        _updateTotalFeesBylbs('6lbs');
        _updateTotalFeesBylbs('7lbs');
        _updateTotalFeesBylbs('8lbs');
        _updateTotalFeesBylbs('9lbs');

        _updateTotalProfit();
      }

      var _updateTotalProfitBylbs = function(name='') {
        var c1closingcost = $('#c1_closing_cost'+name).text();
        var c1postage = $("input[name='c1_postage["+name+"]']").val();
        var c1landed = $("#c1_landed"+name).text();
        var c1TotalFees = $("input[name='c1_totalfees["+name+"]']").val();
        var c1TotalProfit = parseFloat(landed_price)-parseFloat(c1closingcost)-parseFloat(c1postage)-parseFloat(c1landed)-parseFloat(misc_fees);
        if(name == '1lbs' || name == '3lbs')
        {
          c1TotalProfit = parseFloat(c1TotalProfit)-parseFloat(item_cost)-parseFloat(misc_fees);
        }else if(name == '5lbs')
        {
          c1TotalProfit = parseFloat(c1TotalProfit)-parseFloat(item_cost)-parseFloat(14);
        }else if(name == '6lbs')
        {
          var c1TotalProfit = parseFloat(landed_price)-parseFloat(c1closingcost)-parseFloat(c1postage)-parseFloat(c1landed);
        }else if(name == '7lbs')
        {
          var c1TotalProfit = parseFloat(landed_price)-parseFloat(c1landed)-parseFloat(c1postage)-parseFloat(c1TotalFees)-parseFloat(item_cost)-parseFloat(14);
        }else if(name == '8lbs')
        {
          var c1TotalProfit = parseFloat(landed_price)-parseFloat(c1closingcost)-parseFloat(c1postage)-parseFloat(c1landed);
        }else if(name == '9lbs')
        {
          var c1TotalProfit = parseFloat(landed_price)-parseFloat(c1landed)-parseFloat(c1postage)-parseFloat(c1closingcost)-parseFloat(list_price)-parseFloat(item_cost)-parseFloat(14);
        }
        $('#c1_profit_loss'+name).text(c1TotalProfit.toFixed(2));
        $("input[name='c1_profit_loss["+name+"]']").val(c1TotalProfit);
        if(c1TotalProfit <= 0)
        {
          $('#c1_profit_loss'+name).parents('td').css('color', 'red');
        }else{
          $('#c1_profit_loss'+name).parents('td').css('color', 'green');
        }
        // console.log($("input[name='c1_totalfees["+name+"]']").val());
      }

      var _updateTotalProfit = function() {
        _updateTotalProfitBylbs('1lbs');
        _updateTotalProfitBylbs('2lbs');
        _updateTotalProfitBylbs('3lbs');
        _updateTotalProfitBylbs('4lbs');
        _updateTotalProfitBylbs('5lbs');
        _updateTotalProfitBylbs('6lbs');
        _updateTotalProfitBylbs('7lbs');
        _updateTotalProfitBylbs('8lbs');
        _updateTotalProfitBylbs('9lbs');  
      }
      
      return {
        init: _init,
        updatelandedpercent: _updatelandedpercent,
        updatelandedPrice: _updatelandedPrice,
        updateMiscFees: _updateMiscFees,
        updateTotalFees: _updateTotalFees,
        updateTotalProfit: _updateTotalProfit
      }
    }();
    C1CalculateProfit.init();

    $(document).on('keyup', '#item_cost', function(event) {
      var cost = $(this).val();
      if($.trim(cost) != '')
      {
        item_cost = cost;
      }else{
        item_cost = 0;
      }
      
      C1CalculateProfit.updateTotalFees();
      C2CalculateProfit.init();
    });
    
    $(document).on('keyup', '#list_price', function(event) {
      var listprice = $(this).val();
      if($.trim(listprice) != '')
      {
        list_price = listprice;
        
      }else{
        list_price = 0;
      }
      C1CalculateProfit.updatelandedPrice();
      C2CalculateProfit.init();
    });

    $(document).on('keyup', '#shipping', function(event) {
      var shipping_p = $(this).val();
      if($.trim(shipping_p) != '')
      {
        shipping = shipping_p;
      }else{
        shipping = 0;
      }
      
      C1CalculateProfit.updatelandedPrice();
      C2CalculateProfit.init();
    });

    $(document).on('keyup', '#misc_fees', function(event) {
      var miscfees = $(this).val();
      if($.trim(miscfees) != '')
      {
        misc_fees = miscfees;
      }else{
        misc_fees = 0;
      }
      C1CalculateProfit.updateMiscFees();
      C2CalculateProfit.init();
    });

    $(document).on('keyup', '.c1_postage', function(event) {
      C1CalculateProfit.updateTotalFees();
      C2CalculateProfit.updatePstage();
      C2CalculateProfit.init();
    });

    var C2CalculateProfit = function() {
      var _init = function() {
        _updateClosingCost();
        _updateMiscFees();
        _updatePstage();
        _updateLanded();
        _updateLandedPercentage();
        _updateDesiredProfit();
        
        _updateLanded();
        _updateLandedPercentage();
        _updateDesiredProfit();
        
        _updateLanded();
        _updateLandedPercentage();
        _updateDesiredProfit();

        _updateLanded();
        _updateLandedPercentage();
        _updateDesiredProfit();
        
        _updateLanded();
        _updateLandedPercentage();
        _updateDesiredProfit();
        _updateLanded();
        _updateLandedPercentage();
        _updateDesiredProfit();

        _updateLanded();
        _updateLandedPercentage();
        _updateDesiredProfit();

        _updateLanded();
        _updateLandedPercentage();
        _updateDesiredProfit();

        _updateLanded();
        _updateLandedPercentage();
        _updateDesiredProfit();
        _updateTotalFees();
        _updateListed();
      }

      var _updateClosingCost = function() {
        $('.c2_closing_cost').text(closing_cost.toFixed(2));
      }

      var _updatelandedpercent = function() {
        c1_landed = (parseFloat(landed_price)/100)*15;
        $('.c1_landed').text(c1_landed.toFixed(2));
        // _updatelandedPrice();
      }

      var _updatelandedPrice = function() {
        landed_price = (parseFloat(list_price)+parseFloat(shipping));
        $('#landed_price').text(landed_price.toFixed(2));
        // _updatelandedpercent();
        // _updateTotalFees();
      }

      var _updateMiscFees = function() {
        $('.c2_miscfees').text(misc_fees.toFixed(2));
        // _updateTotalFees();
      }

      var _updatePstageBylbs = function(name='') {
        var c1postage = $("input[name='c1_postage["+name+"]']").val();
        c1postage = parseFloat(c1postage);
        $('#c2_postage'+name).text(c1postage.toFixed(2));
      }

      var _updatePstage = function() {
        _updatePstageBylbs('1lbs');
        _updatePstageBylbs('2lbs');
        _updatePstageBylbs('3lbs');
        _updatePstageBylbs('4lbs');
        _updatePstageBylbs('5lbs');
        _updatePstageBylbs('6lbs');
        _updatePstageBylbs('7lbs');
        _updatePstageBylbs('8lbs');
        _updatePstageBylbs('9lbs');
        
      }

      var _updateLandedPercentageBylbs = function(name='') {
        var c2landedPercent = $("input[name='c2_landed["+name+"]']").val();
        c2landedPercent = (parseFloat(c2landedPercent)/100)*15;
        $('#c2_landedpercent'+name).text(c2landedPercent.toFixed(2));
        $("input[name='c2_landedpercent["+name+"]']").val(c2landedPercent);
        // console.log(c2landedPercent);
      }

      var _updateLandedPercentage = function() {
        _updateLandedPercentageBylbs('1lbs');
        _updateLandedPercentageBylbs('2lbs');
        _updateLandedPercentageBylbs('3lbs');
        _updateLandedPercentageBylbs('4lbs');
        _updateLandedPercentageBylbs('5lbs');
        _updateLandedPercentageBylbs('6lbs');
        _updateLandedPercentageBylbs('7lbs');
        _updateLandedPercentageBylbs('8lbs');
        _updateLandedPercentageBylbs('9lbs');
        
      }

      var _updateTotalFeesBylbs = function(name='') {
        var c2closingcost = $('#c2_closing_cost'+name).text();
        var c2postage = $('#c2_postage'+name).text();
        var c2landedpercent = $("input[name='c2_landedpercent["+name+"]']").val();
        
        var c2TotalFees = (parseFloat(c2closingcost)+parseFloat(c2postage)+parseFloat(c2landedpercent)+parseFloat(misc_fees));
        $('#c2_totalfees'+name).text(c2TotalFees.toFixed(2));
        $("input[name='c2_totalfees["+name+"]']").val(c2TotalFees);
        // console.log(c2closingcost);
        // console.log(c2postage);
        // console.log(c2landedpercent);
      }

      var _updateTotalFees = function() {
        _updateTotalFeesBylbs('1lbs');
        _updateTotalFeesBylbs('2lbs');
        _updateTotalFeesBylbs('3lbs');
        _updateTotalFeesBylbs('4lbs');
        _updateTotalFeesBylbs('5lbs');
        _updateTotalFeesBylbs('6lbs');
        _updateTotalFeesBylbs('7lbs');
        _updateTotalFeesBylbs('8lbs');
        _updateTotalFeesBylbs('9lbs');

        // _updateTotalProfit();
      }

      var _updateDesiredProfitBylbs = function(name='') {
        var c2closingcost = $('#c2_closing_cost'+name).text();
        var c2postage = $('#c2_postage'+name).text();
        var c2landedpercent = $("input[name='c2_landedpercent["+name+"]']").val();
        var c2landed = $("input[name='c2_landed["+name+"]']").val();
        
        var c2TotalDesiredProfit = (parseFloat(c2landed)-parseFloat(c2landedpercent)-parseFloat(c2postage)-parseFloat(c2closingcost));
        if(name == '1lbs')
        {
          var c2TotalDesiredProfit = (parseFloat(c2landed)-parseFloat(c2landedpercent)-parseFloat(c2postage)-parseFloat(c2closingcost)-parseFloat(misc_fees)-parseFloat(item_cost));
        }
        $('#c2_desired_profit'+name).text(c2TotalDesiredProfit.toFixed(2));
        $("input[name='c2_desired_profit["+name+"]']").val(c2TotalDesiredProfit);
        // console.log($("input[name='c1_totalfees["+name+"]']").val());
        
      }

      var _updateDesiredProfit = function() {
        _updateDesiredProfitBylbs('1lbs');
        _updateDesiredProfitBylbs('2lbs');
        _updateDesiredProfitBylbs('3lbs');
        _updateDesiredProfitBylbs('4lbs');
        _updateDesiredProfitBylbs('5lbs');
        _updateDesiredProfitBylbs('6lbs');
        _updateDesiredProfitBylbs('7lbs');
        _updateDesiredProfitBylbs('8lbs');
        _updateDesiredProfitBylbs('9lbs');

        // _updateTotalProfit();
      }

      var _updateLandedBylbs = function(name='') {
        var c2closingcost = $('#c2_closing_cost'+name).text();
        var c2postage = $('#c2_postage'+name).text();
        var c2desiredprofit = $("input[name='c2_desired_profit[1lbs]']").val();
        var c2Totallanded = (parseFloat(desired_profit)+parseFloat(c2closingcost)+parseFloat(c2postage)+parseFloat(misc_fees))/parseFloat(0.85);
        if(name == '1lbs')
        {
          var c2Totallanded = (parseFloat(desired_profit)+parseFloat(c2closingcost)+parseFloat(c2postage)+parseFloat(misc_fees))/parseFloat(0.85);
        }else if(name == '2lbs')
        {
          var c2desiredprofit = $("input[name='c2_desired_profit[1lbs]']").val();
          var c2Totallanded = (parseFloat(c2desiredprofit)+parseFloat(c2closingcost)+parseFloat(c2postage))/parseFloat(0.85);

        }else if(name == '3lbs')
        {
          var c2desiredprofit = $("input[name='c2_desired_profit[2lbs]']").val();
          var c2Totallanded = (parseFloat(c2desiredprofit)+parseFloat(c2closingcost)+parseFloat(c2postage))/parseFloat(0.85);
        }else if(name == '4lbs')
        {
          var c2desiredprofit = $("input[name='c2_desired_profit[3lbs]']").val();
          var c2Totallanded = (parseFloat(c2desiredprofit)+parseFloat(c2closingcost)+parseFloat(c2postage))/parseFloat(0.85);
        }else if(name == '5lbs')
        {
          var c2desiredprofit = $("input[name='c2_desired_profit[4lbs]']").val();
          var c2Totallanded = (parseFloat(c2desiredprofit)+parseFloat(c2closingcost)+parseFloat(c2postage))/parseFloat(0.85);
        }else if(name == '6lbs')
        {
          var c2desiredprofit = $("input[name='c2_desired_profit[5lbs]']").val();
          var c2Totallanded = (parseFloat(c2desiredprofit)+parseFloat(c2closingcost)+parseFloat(c2postage))/parseFloat(0.85);
        }else if(name == '7lbs')
        {
          var c2desiredprofit = $("input[name='c2_desired_profit[6lbs]']").val();
          var c2Totallanded = (parseFloat(c2desiredprofit)+parseFloat(c2closingcost)+parseFloat(c2postage))/parseFloat(0.85);
        }else if(name == '8lbs')
        {
          var c2desiredprofit = $("input[name='c2_desired_profit[7lbs]']").val();
          var c2Totallanded = (parseFloat(c2desiredprofit)+parseFloat(c2closingcost)+parseFloat(c2postage))/parseFloat(0.85);
        }else if(name == '9lbs')
        {
          var c2desiredprofit = $("input[name='c2_desired_profit[8lbs]']").val();
          var c2Totallanded = (parseFloat(c2desiredprofit)+parseFloat(c2closingcost)+parseFloat(c2postage))/parseFloat(0.85);
        }
        
        $('#c2_landed'+name).text(c2Totallanded.toFixed(2));
        $("input[name='c2_landed["+name+"]']").val(c2Totallanded);
        // console.log(c2Totallanded);
        // console.log(c2desiredprofit);
      }

      var _updateLanded = function() {
        _updateLandedBylbs('1lbs');
        _updateLandedBylbs('2lbs');
        _updateLandedBylbs('3lbs');
        _updateLandedBylbs('4lbs');
        _updateLandedBylbs('5lbs');
        _updateLandedBylbs('6lbs');
        _updateLandedBylbs('7lbs');
        _updateLandedBylbs('8lbs');
        _updateLandedBylbs('9lbs');

        // _updateListed();
      }

      var _updateListedBylbs = function(name='') {
        var c2landed = $("input[name='c2_landed["+name+"]']").val();
        var c2Totallisted = (parseFloat(c2landed)-parseFloat(3.99));
        $('#c2_listed'+name).text(c2Totallisted.toFixed(2));
        $("input[name='c2_listed["+name+"]']").val(c2Totallisted);
        // console.log($("input[name='c1_totalfees["+name+"]']").val());
      }

      var _updateListed = function() {
        _updateListedBylbs('1lbs');
        _updateListedBylbs('2lbs');
        _updateListedBylbs('3lbs');
        _updateListedBylbs('4lbs');
        _updateListedBylbs('5lbs');
        _updateListedBylbs('6lbs');
        _updateListedBylbs('7lbs');
        _updateListedBylbs('8lbs');
        _updateListedBylbs('9lbs');

        // _updateTotalProfit();
      }

      var _updateTotalProfitBylbs = function(name='') {
        var c1closingcost = $('#c1_closing_cost'+name).text();
        var c1postage = $("input[name='c1_postage["+name+"]']").val();
        var c1landed = $("#c1_landed"+name).text();
        var c1TotalFees = $("input[name='c1_totalfees["+name+"]']").val();
        var c1TotalProfit = parseFloat(landed_price)-parseFloat(c1closingcost)-parseFloat(c1postage)-parseFloat(c1landed)-parseFloat(misc_fees);
        if(name == '1lbs' || name == '3lbs')
        {
          c1TotalProfit = parseFloat(c1TotalProfit)-parseFloat(item_cost)-parseFloat(misc_fees);
        }else if(name == '5lbs')
        {
          c1TotalProfit = parseFloat(c1TotalProfit)-parseFloat(item_cost)-parseFloat(14);
        }else if(name == '6lbs')
        {
          var c1TotalProfit = parseFloat(landed_price)-parseFloat(c1closingcost)-parseFloat(c1postage)-parseFloat(c1landed);
        }else if(name == '7lbs')
        {
          var c1TotalProfit = parseFloat(landed_price)-parseFloat(c1landed)-parseFloat(c1postage)-parseFloat(c1TotalFees)-parseFloat(item_cost)-parseFloat(14);
        }else if(name == '8lbs')
        {
          var c1TotalProfit = parseFloat(landed_price)-parseFloat(c1closingcost)-parseFloat(c1postage)-parseFloat(c1landed);
        }else if(name == '9lbs')
        {
          var c1TotalProfit = parseFloat(landed_price)-parseFloat(c1landed)-parseFloat(c1postage)-parseFloat(c1closingcost)-parseFloat(list_price)-parseFloat(item_cost)-parseFloat(14);
        }
        $('#c1_profit_loss'+name).text(c1TotalProfit.toFixed(2));
        $("input[name='c1_profit_loss["+name+"]']").val(c1TotalProfit);
        if(c1TotalProfit <= 0)
        {
          $('#c1_profit_loss'+name).parents('td').css('color', 'red');
        }else{
          $('#c1_profit_loss'+name).parents('td').css('color', 'green');
        }
        // console.log($("input[name='c1_totalfees["+name+"]']").val());
      }

      var _updateTotalProfit = function() {
        _updateTotalProfitBylbs('1lbs');
        _updateTotalProfitBylbs('2lbs');
        _updateTotalProfitBylbs('3lbs');
        _updateTotalProfitBylbs('4lbs');
        _updateTotalProfitBylbs('5lbs');
        _updateTotalProfitBylbs('6lbs');
        _updateTotalProfitBylbs('7lbs');
        _updateTotalProfitBylbs('8lbs');
        _updateTotalProfitBylbs('9lbs');  
      }
      
      return {
        init: _init,
        updatelandedpercent: _updatelandedpercent,
        updatelandedPrice: _updatelandedPrice,
        updateMiscFees: _updateMiscFees,
        updatePstage: _updatePstage,
        updateLanded: _updateLanded,
        updateTotalFees: _updateTotalFees,
        updateTotalProfit: _updateTotalProfit
      }
    }();
    C2CalculateProfit.init();
    $(document).on('keyup', '#desired_profit', function(event) {
      var desired_profitv = $(this).val();
      if($.trim(desired_profitv) != '')
      {
        desired_profit = desired_profitv;
      }else{
        desired_profit = 0;
      }
      
      C2CalculateProfit.updateLanded();
    });
  </script>
@endpush