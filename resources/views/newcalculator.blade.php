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
        <h1 class="h3 mb-0 text-gray-800">{{ __('message.calculator') }}</h1>
        <script src="https://gumroad.com/js/gumroad.js"></script>
        <a class="gumroad-button google-drive-opener" href="https://gum.co/kbdaR">Buy my product</a>
    </div>
    <form action="" method="get" id="language_form" style="width: 100%"> 
    <div class="row justify-content-between">
      
        <div class="col-md-2 mb-2" style="float: left">
          @php
          // $country_arr = array('name' => 'jawad', );
            $country_arr = array(
              '.com' => '',
              '.ca' => '',
              '.com.mx' => '',
              '.co.uk' => '',
              '.de' => '',
              '.fr' => '',
              '.it' => '',
              '.es' => '',
            );
            $country_arr[$country] = 'selected="selected"';
            switch ($country) {
              case '.co.uk':
                $currency = '£';
                break;
              case '.de':
                $currency = '€';
                break;
              case '.fr':
                $currency = '€';
                break;
              case '.it':
                $currency = '€';
                break;
              case '.es':
                $currency = '€';
                break;
              default:
                $currency = '$';
                break;
            }
          @endphp
          <label for=""></label>
          <select name="country" id="country" onChange="C3CalculateProfit.init()" class="form-control">
            <option value=".com" <?=$country_arr['.com']?>>.com</option>
            <option value=".ca" <?=$country_arr['.ca']?>>.ca</option>
            <option value=".com.mx" <?=$country_arr['.com.mx']?>>.com.mx</option>
            <option value=".co.uk" <?=$country_arr['.co.uk']?>>.co.uk</option>
            <option value=".de" <?=$country_arr['.de']?>>.de</option>
            <option value=".fr" <?=$country_arr['.fr']?>>.fr</option>
            <option value=".it" <?=$country_arr['.it']?>>.it</option>
            <option value=".es" <?=$country_arr['.es']?>>.es</option>
          </select>
        </div>

        <div class="col-md-2 mb-2" style="float: right">
          @php
          // $country_arr = array('name' => 'jawad', );
            $country_arr = array(
              'en' => '',
              'ca' => '',
              'mx' => '',
              'uk' => '',
              'de' => '',
              'fr' => '',
              'it' => '',
              'es' => '',
            );
            $country_arr[$locale] = 'selected="selected"';
          @endphp
          <label class="label-control">Language</label>
          {{-- onChange="window.location.href=this.value" --}}
          <select id="language" class="form-control">
            <option value="{{url("calculator/en")}}" <?=$country_arr['en']?>>English</option>
            <option value="{{url("calculator/de")}}" <?=$country_arr['de']?>>German</option>
            <option value="{{url("calculator/fr")}}" <?=$country_arr['fr']?>>French</option>
            <option value="{{url("calculator/it")}}" <?=$country_arr['it']?>>Italian</option>
            <option value="{{url("calculator/es")}}" <?=$country_arr['es']?>>Spenish</option>
          </select>
        </div>
        <div class="col-md-12">
          <div class="table-responsive">
              <table class="table input-table3">
                  <thead>
                      <tr>
                        <th>{{ __('message.fba-landed-price') }} <span class="badge bg-secondary" data-bs-toggle="tooltip" data-bs-placement="top" title="{{__('message.fba-landed-price-desc')}}"><i class="fa fa-question fa-sm"><i></span></th>  
                        <th>{{ __('message.mf-list-price') }}</th>
                        <th>{{ __('message.mf-landed-price') }} <span class="badge bg-secondary" data-bs-toggle="tooltip" data-bs-placement="top" title="{{__('message.mf-landed-price-desc')}}"><i class="fa fa-question fa-sm"><i></span></th>
                        <th>{{ __('message.item-cost') }} <span class="badge bg-secondary" data-bs-toggle="tooltip" data-bs-placement="top" title="{{__('message.item-cost-desc')}}"><i class="fa fa-question fa-sm"><i></span></th>
                        <th>{{ __('message.fba-inbound-cost') }} <span class="badge bg-secondary" data-bs-toggle="tooltip" data-bs-placement="top" title="{{__('message.fba-inbound-cost-desc')}}"><i class="fa fa-question fa-sm"><i></span></th>
                        <th>{{ __('message.shipping') }} <span class="badge bg-secondary" data-bs-toggle="tooltip" data-bs-placement="top" title="{{__('message.shipping-desc')}}"><i class="fa fa-question fa-sm"><i></span></th>
                        <th>{{ __('message.misc-fees') }} <span class="badge bg-secondary" data-bs-toggle="tooltip" data-bs-placement="top" title="{{__('message.misc-fees-desc')}}"><i class="fa fa-question fa-sm"><i><span></th>
                      </tr>
                  </thead>
                  <tbody>
                      <tr>
                          <td>
                              <div class="input-group">
                                  <span class="input-group-addon" id="basic-addon1">{{ $currency }}</span>
                                  <input type="text" name="fba_price" id="fba_price" onkeyup="C3CalculateProfit.init()" class="form-control" value="<?=$fba_price?>" placeholder="0"  aria-describedby="basic-addon1">
                              </div>
                          </td>
                          <td>
                              <div class="input-group">
                                  <span class="input-group-addon" id="basic-addon1">{{ $currency }}</span>
                                  <input type="text" name="mf_price" id="mf_price" onkeyup="C3CalculateProfit.init()" class="form-control" value="<?=$mf_price?>" placeholder="0"  aria-describedby="basic-addon1">
                              </div>
                          </td>
                          <td>{{ $currency }}<span id="landed_price"><?=$mf_price?></span></td>
                          
                          <td>
                              <div class="input-group">
                              <span class="input-group-addon" id="basic-addon0">{{ $currency }}</span>
                              <input type="text" name="item_cost" id="item_cost" onkeyup="C3CalculateProfit.init()" class="form-control" value="<?=$item_cost?>" placeholder="0"   aria-describedby="basic-addon0"/>
                              </div>
                          </td> 
                          <td>
                              <div class="input-group">
                                  <span class="input-group-addon" id="basic-addon1">{{ $currency }}</span>
                                  <input type="text" name="inbound_shipping" id="inbound_shipping" onkeyup="C3CalculateProfit.init()" class="form-control" value="<?=$inbound_shipping?>" placeholder="0"  aria-describedby="basic-addon1">
                              </div>
                          </td>  
                        
                          <td>
                              <div class="input-group">
                                  <span class="input-group-addon" id="basic-addon1">{{ $currency }}</span>
                                  <input type="text" name="shipping" id="shipping" onkeyup="C3CalculateProfit.init()" class="form-control" value="<?=$shipping?>" placeholder="0"  aria-describedby="basic-addon1">
                              </div>
                          </td>
                          
                          <td>
                              <div class="input-group">
                                  <span class="input-group-addon" id="basic-addon1">{{ $currency }}</span>
                                  <input type="text" name="misc_fees" id="misc_fees" onkeyup="C3CalculateProfit.init()" class="form-control" value="<?=$misc_fees?>" placeholder="0"  aria-describedby="basic-addon1">
                              </div>
                          </td>
                          
                      </tr>
                  </tbody>
              </table>
          </div> 
        </div>
      
    </div>
  </form>
    <div class="row">
        <div class="col-md-12">
            
            <div class="card shadow mb-4">
                <div class="card-body">
                 
                  <div class="btn-group" style="float: right;margin-bottom: 10px;">
                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      {{ __('message.hide-show-column') }}
                    </button>
                    <div class="dropdown-menu dropdown-menu-right">
                      <div class="form-check form-check-inline dropdown-item">
                        <input class="form-check-input hidecol" type="checkbox" value="Media Mail Weight" id="col_2">
                        <label class="form-check-label" for="col_2">{{ __('message.media-mail-weight') }}</label>
                      </div>
                      <div class="form-check form-check-inline dropdown-item">
                        <input class="form-check-input hidecol" type="checkbox" value="2021 Closing Cost" id="col_3">
                        <label class="form-check-label" for="col_3">{{ __('message.2021-closing-cost') }}</label>
                      </div>
                      <div class="form-check form-check-inline dropdown-item">
                        <input class="form-check-input hidecol" type="checkbox" value="Storage Cost" id="col_4">
                        <label class="form-check-label" for="col_9">{{ __('message.storage-cost') }}</label>
                      </div>
                      <div class="form-check form-check-inline dropdown-item">
                        <input class="form-check-input hidecol" type="checkbox" value="USPS Postage" id="col_5">
                        <label class="form-check-label" for="col_7">{{ __('message.usps-postage') }}</label>
                      </div>
                      <div class="form-check form-check-inline dropdown-item">
                        <input class="form-check-input hidecol" type="checkbox" value="(MF) Referral Fee" id="col_6">
                        <label class="form-check-label" for="col_4">{{ __('message.mf-referral-fee') }}</label>
                      </div>
                      <div class="form-check form-check-inline dropdown-item">
                        <input class="form-check-input hidecol" type="checkbox" value="(MF) Total Fees" id="col_7">
                        <label class="form-check-label" for="col_8">{{ __('message.mf-total-fees') }}</label>
                      </div>
                      <div class="form-check form-check-inline dropdown-item">
                        <input class="form-check-input hidecol" type="checkbox" value="(MF) Landed Price" id="col_8">
                        <label class="form-check-label" for="col_10">{{ __('message.mflandedprice') }}</label>
                      </div>
                      <div class="form-check form-check-inline dropdown-item">
                        <input class="form-check-input hidecol" type="checkbox" value="(MF) Profit/Loss" id="col_9">
                        <label class="form-check-label" for="col_11">{{ __('message.mf-profit-loss') }}</label>
                      </div>
                      <div class="form-check form-check-inline dropdown-item">
                        <input class="form-check-input hidecol" type="checkbox" value="(MF) Net Margin" id="col_10">
                        <label class="form-check-label" for="col_14">{{ __('message.mf-net-margin') }}</label>
                      </div>
                      <div class="form-check form-check-inline dropdown-item">
                        <input class="form-check-input hidecol" type="checkbox" value="(FBA) Referral Fee" id="col_11">
                        <label class="form-check-label" for="col_5">{{ __('message.fba-referral-fee') }}</label>
                      </div>
                      <div class="form-check form-check-inline dropdown-item">
                        <input class="form-check-input hidecol" type="checkbox" value="(FBA) Pick & Pack Fee" id="col_12">
                        <label class="form-check-label" for="col_6">{{ __('message.fba-pick-pack-fee') }}</label>
                      </div>
                      <div class="form-check form-check-inline dropdown-item">
                        <input class="form-check-input hidecol" type="checkbox" value="(FBA) Landing Price" id="col_13">
                        <label class="form-check-label" for="col_12">{{ __('message.fba-landing-price') }}</label>
                      </div>
                      <div class="form-check form-check-inline dropdown-item">
                        <input class="form-check-input hidecol" type="checkbox" value="FBA Profit/Loss" id="col_14">
                        <label class="form-check-label" for="col_13">{{ __('message.fba-profit-Loss') }}</label>
                      </div>
                      
                      <div class="form-check form-check-inline dropdown-item">
                        <input class="form-check-input hidecol" type="checkbox" value="(FBA) Net Margin" id="col_15">
                        <label class="form-check-label" for="col_15">{{ __('message.fba-net-margin') }}</label>
                      </div>
                      
                    </div>
                  </div>
                    <div class="table-responsive">
                        <table class="table" id="emp_table">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>{{ __('message.media-mail-weight') }}</th>
                                    <th>{{ __('message.2021-closing-cost') }}</th>
                                    <th>{{ __('message.storage-cost') }}</th>
                                    <th>{{ __('message.usps-postage') }}</th>
                                    <th>{{ __('message.mf-referral-fee') }}</th>
                                    <th>{{ __('message.mf-total-fees') }}</th>
                                    <th>{{ __('message.mflandedprice') }}</th>
                                    <th>{{ __('message.mf-profit-loss') }}</th>
                                    <th>{{ __('message.mf-net-margin') }}</th>
                                    <th>{{ __('message.fba-referral-fee') }}</th>
                                    <th>{{ __('message.fba-pick-pack-fee') }}</th>
                                    <th>{{ __('message.fba-landing-price') }}</th>
                                    <th>{{ __('message.fba-profit-Loss') }}</th>
                                    <th>{{ __('message.fba-net-margin') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th>{{ __('message.under') }} 1 lb</th>
                                    <td>1</td>
                                    <td>{{ $currency }}<span class="c3_closing_cost" id="c3_closing_cost1lbs">1.80</span></td>
                                    <td>{{ $currency }}<span class="c3_storage_cost" id="c3_storage_cost1lbs">0.02</span></td>
                                    <td>{{ $currency }}<span class="c3_postage" id="c3_postage1lbs">2.89</span></td>
                                    <td>{{ $currency }}<span class="c3_mf_referral_fee" id="c3_mf_referral_fee1lbs">2.10</span></td>
                                    <td>{{ $currency }}<span class="c3_mf_total_fee" id="c3_mf_total_fee1lbs">3.90</span></td>
                                    <td>{{ $currency }}<span class="c3_mf_landed_price" id="c3_mf_landed_price1lbs">0.00</span></td>
                                    <td>{{ $currency }}<span class="c3_mf_profit_loss" id="c3_mf_profit_loss1lbs">0.00</span></td>
                                    <td><span class="c3_mf_net_margin" id="c3_mf_net_margin1lbs">0</span>%</td>

                                    <td>{{ $currency }}<span class="c3_fbs_referral_fee" id="c3_fbs_referral_fee1lbs">2.10</span></td>
                                    <td>
                                        {{ $currency }}<span class="c3_packfee" id="c3_packfee1lbs">3.48</span>
                                        <span class="c3_inbound_cost d-none" id="c3_inbound_costi1lbs">0.20</span>
                                    </td>
                                    <td>{{ $currency }}<span class="c3_fba_landed_price" id="c3_fba_landed_price1lbs">0.00</span></td>
                                    <td>{{ $currency }}<span class="c3_fba_profit_loss" id="c3_fba_profit_loss1lbs">0.00</span></td>
                                    <td><span class="c3_fba_net_margin" id="c3_fba_net_margin1lbs">0</span>%</td>
                                    
                                </tr>
                                
                                <tr>
                                    <th>1lb - 2lb</th>
                                    <td>2</td>
                                    <td>{{ $currency }}<span class="c3_closing_cost" id="c3_closing_cost2lbs">1.80</span></td>
                                    <td>{{ $currency }}<span class="c3_storage_cost" id="c3_storage_cost2lbs">0.03</span></td>
                                    <td>{{ $currency }}<span class="c3_postage" id="c3_postage2lbs">3.45</span></td>
                                    <td>{{ $currency }}<span class="c3_mf_referral_fee" id="c3_mf_referral_fee2lbs">2.10</span></td>
                                    <td>{{ $currency }}<span class="c3_mf_total_fee" id="c3_mf_total_fee2lbs">3.90</span></td>
                                    <td>{{ $currency }}<span class="c3_mf_landed_price" id="c3_mf_landed_price2lbs">0.00</span></td>
                                    <td>{{ $currency }}<span class="c3_mf_profit_loss" id="c3_mf_profit_loss2lbs">0.00</span></td>
                                    <td><span class="c3_mf_net_margin" id="c3_mf_net_margin2lbs">0</span>%</td>

                                    <td>{{ $currency }}<span class="c3_fbs_referral_fee" id="c3_fbs_referral_fee2lbs">2.10</span></td>
                                    <td>
                                        {{ $currency }}<span class="c3_packfee" id="c3_packfee2lbs">4.90</span>
                                        <span class="c3_inbound_cost d-none" id="c3_inbound_costi2lbs">0.20</span>
                                    </td>
                                    <td>{{ $currency }}<span class="c3_fba_landed_price" id="c3_fba_landed_price2lbs">13.99</span></td>
                                    <td>{{ $currency }}<span class="c3_fba_profit_loss" id="c3_fba_profit_loss2lbs">3.69</span></td>
                                    <td><span class="c3_fba_net_margin" id="c3_fba_net_margin2lbs">0</span>%</td>
                                </tr>
                                <tr>
                                    <th>2lb - 3lb</th>
                                    <td>3</td>
                                    <td>{{ $currency }}<span class="c3_closing_cost" id="c3_closing_cost3lbs">1.80</span></td>
                                    <td>{{ $currency }}<span class="c3_storage_cost" id="c3_storage_cost3lbs">0.03</span></td>
                                    <td>{{ $currency }}<span class="c3_postage" id="c3_postage3lbs">4.01</span></td>
                                    <td>{{ $currency }}<span class="c3_mf_referral_fee" id="c3_mf_referral_fee3lbs">2.10</span></td>
                                    
                                    

                                    <td>{{ $currency }}<span class="c3_mf_total_fee" id="c3_mf_total_fee3lbs">3.90</span></td>
                                    
                                    <td>{{ $currency }}<span class="c3_mf_landed_price" id="c3_mf_landed_price3lbs">0.00</span></td>
                                    <td>{{ $currency }}<span class="c3_mf_profit_loss" id="c3_mf_profit_loss3lbs">0.00</span></td>
                                    <td><span class="c3_mf_net_margin" id="c3_mf_net_margin3lbs">0</span>%</td>
                                    <td>{{ $currency }}<span class="c3_fbs_referral_fee" id="c3_fbs_referral_fee3lbs">2.10</span></td>
                                    <td>
                                        {{ $currency }}<span class="c3_packfee" id="c3_packfee3lbs">5.42</span>
                                        <span class="c3_inbound_cost d-none" id="c3_inbound_costi3lbs">0.60</span>
                                    </td>
                                    <td>{{ $currency }}<span class="c3_fba_landed_price" id="c3_fba_landed_price3lbs">0.00</span></td>
                                    <td>{{ $currency }}<span class="c3_fba_profit_loss" id="c3_fba_profit_loss3lbs">0.00</span></td>

                                    
                                    <td><span class="c3_fba_net_margin" id="c3_fba_net_margin3lbs">0</span>%</td>
                                </tr>
                                <tr>
                                    <th>4lb - 5lb</th>
                                    <td>4</td>
                                    <td>{{ $currency }}<span class="c3_closing_cost" id="c3_closing_cost4lbs">1.80</span></td>
                                    <td>{{ $currency }}<span class="c3_storage_cost" id="c3_storage_cost4lbs">0.03</span></td>
                                    <td>{{ $currency }}<span class="c3_postage" id="c3_postage4lbs">4.57</span></td>
                                    <td>{{ $currency }}<span class="c3_mf_referral_fee" id="c3_mf_referral_fee4lbs">2.10</span></td>
                                    <td>{{ $currency }}<span class="c3_mf_total_fee" id="c3_mf_total_fee4lbs">3.90</span></td>
                                    <td>{{ $currency }}<span class="c3_mf_landed_price" id="c3_mf_landed_price4lbs">0.00</span></td>
                                    <td>{{ $currency }}<span class="c3_mf_profit_loss" id="c3_mf_profit_loss4lbs">0.00</span></td>
                                    <td><span class="c3_mf_net_margin" id="c3_mf_net_margin4lbs">0</span>%</td>
                                    <td>{{ $currency }}<span class="c3_fbs_referral_fee" id="c3_fbs_referral_fee4lbs">2.10</span></td>
                                    <td>
                                        {{ $currency }}<span class="c3_packfee" id="c3_packfee4lbs">5.42</span>
                                        <span class="c3_inbound_cost d-none" id="c3_inbound_costi4lbs">0.80</span>
                                    </td>
                                    <td>{{ $currency }}<span class="c3_fba_landed_price" id="c3_fba_landed_price4lbs">0.00</span></td>
                                    <td>{{ $currency }}<span class="c3_fba_profit_loss" id="c3_fba_profit_loss4lbs">0.00</span></td>
                                    <td><span class="c3_fba_net_margin" id="c3_fba_net_margin4lbs">0</span>%</td>
                                </tr>
                                <tr>
                                    <th>5lb - 6lb</th>
                                    <td>5</td>
                                    <td>{{ $currency }}<span class="c3_closing_cost" id="c3_closing_cost5lbs">1.80</span></td>
                                    <td>{{ $currency }}<span class="c3_storage_cost" id="c3_storage_cost5lbs">0.03</span></td>
                                    <td>{{ $currency }}<span class="c3_postage" id="c3_postage5lbs">5.13</span></td>
                                    <td>{{ $currency }}<span class="c3_mf_referral_fee" id="c3_mf_referral_fee5lbs">2.10</span></td>
                                    <td>{{ $currency }}<span class="c3_mf_total_fee" id="c3_mf_total_fee5lbs">3.90</span></td>
                                    <td>{{ $currency }}<span class="c3_mf_landed_price" id="c3_mf_landed_price5lbs">0.00</span></td>
                                    <td>{{ $currency }}<span class="c3_mf_profit_loss" id="c3_mf_profit_loss5lbs">0.00</span></td>
                                    <td><span class="c3_mf_net_margin" id="c3_mf_net_margin5lbs">0</span>%</td>
                                    <td>{{ $currency }}<span class="c3_fbs_referral_fee" id="c3_fbs_referral_fee5lbs">2.10</span></td>
                                    <td>
                                        {{ $currency }}<span class="c3_packfee" id="c3_packfee5lbs">5.42</span>
                                        <span class="c3_inbound_cost d-none" id="c3_inbound_costi5lbs">1.00</span>
                                    </td>
                                    <td>{{ $currency }}<span class="c3_fba_landed_price" id="c3_fba_landed_price5lbs">0.00</span></td>
                                    <td>{{ $currency }}<span class="c3_fba_profit_loss" id="c3_fba_profit_loss5lbs">0.00</span></td>
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
      
      $('#language').on('change', function () {
        var language  = $(this).val();
        $('#language_form').attr('action', language);
        $('#language_form').submit();
      });
      $('#country').on('change', function () {
        var language  = $('#language').val();
        $('#language_form').attr('action', language);
        $('#language_form').submit();
        // var country  = $(this).val();
        // var colno = 9;
        // if(country == '.com')
        // {
        //   $('#emp_table td:nth-child('+colno+')').show();
        //   $('#emp_table th:nth-child('+colno+')').show();
        // }else{
        //   $('#emp_table td:nth-child('+colno+')').hide();
        //   $('#emp_table th:nth-child('+colno+')').hide();
        // }
      });
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
    
    var country  = '<?=$country?>';
    var colno = 9;
    var fba_refpercent = 15;
    if(country == '.com')
    {
      $('#emp_table td:nth-child('+colno+')').show();
      $('#emp_table th:nth-child('+colno+')').show();
    }else{
      $('#emp_table td:nth-child('+colno+')').hide();
      $('#emp_table th:nth-child('+colno+')').hide();
    }
    var fba_price = 0;
    
    var item_cost = 0;
    var mf_price = 0;
    var landed_price = 0;
    var inbound_shipping = 0;
    var shipping = 0;
    var misc_fees = 0;
    var C3CalculateProfit = function() {
      var _init = function() {
        _updatefbareferralpercent();
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

      var _updatefbareferralpercent = function() {
        var country = $('#country').val();
        console.log(country);
        if(country == '.fr' || country == '.it')
        {
          fba_refpercent = 15.45;
        }else if(country == '.co.uk')
        {
          fba_refpercent = 15.30;
        }else{
          fba_refpercent = 15;
        }
        
      }

      var _updatefbareferralfee = function() {
        var c3_fbarefferralfee = (parseFloat(fba_price)/100)*fba_refpercent;
        $('.c3_fbs_referral_fee').text(c3_fbarefferralfee.toFixed(2));
        
        // console.log(landed_price);
        
      }

      var _updatemfLandedPrice = function() {
        var c3_mf_landed_price = (parseFloat(landed_price)/100)*15;
        $('.c3_mf_landed_price').text(c3_mf_landed_price.toFixed(2));
        // console.log(landed_price);
        
      }

      
      var _updateinboundCostBylbs = function(name='', weight=0) {
        c3Inboundcost = parseFloat(inbound_shipping)*parseFloat(weight);
        $('#c3_inbound_costi'+name).text(c3Inboundcost.toFixed(2));
        // if(c3Inboundcost <= 0)
        // {
        //   $('#c3_inbound_costi'+name).parents('td').css('color', 'red');
        // }else{
        //   $('#c3_inbound_costi'+name).parents('td').css('color', 'green');
        // }
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
        if(c1TotalProfit <= 0)
        {
          $('#c3_mf_profit_loss'+name).parents('td').css('color', 'red');
        }else{
          $('#c3_mf_profit_loss'+name).parents('td').css('color', 'green');
        }
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
        if(fbaTotalProfit <= 0)
        {
          $('#c3_fba_profit_loss'+name).parents('td').css('color', 'red');
        }else{
          $('#c3_fba_profit_loss'+name).parents('td').css('color', 'green');
        }
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
        if(Math.round(mfmargin) <= 0)
        {
          $('#c3_mf_net_margin'+name).parents('td').css('color', 'red');
        }else{
          $('#c3_mf_net_margin'+name).parents('td').css('color', 'green');
        }
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
        // console.log(Math.round(fbamargin));
        $('#c3_fba_net_margin'+name).text(Math.round(fbamargin));
        if(Math.round(fbamargin) <= 0)
        {
          $('#c3_fba_net_margin'+name).parents('td').css('color', 'red');
        }else{
          $('#c3_fba_net_margin'+name).parents('td').css('color', 'green');
        }
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
        updateFBAMargin: _updateFBAMargin,
        updateFBAreferralPercent: _updatefbareferralpercent
      }
    }();
    C3CalculateProfit.init();

    
   
  </script>
@endpush