<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\USPSPriceList;
use App\Models\LoginHistory;
use App\Models\User;
use Stevebauman\Location\Facades\Location;
use Browser;
use Carbon\Carbon;

class DashboardController extends Controller
{
    //
    public function dashboard()
    {
        // $position = Location::get('161.185.160.93');
        // dump($position);
        // if () {
        //     // Successfully retrieved position.
        //     echo $position->countryName;
        // } else {
        //     // Failed retrieving position.
        // }
        // echo Browser::deviceModel();
        // exit();
        // dd(Auth::user()->type);
        if(Auth::user()->type != 'admin')
            return redirect()->route('calculator','en');

        $monthly_hits = LoginHistory::whereMonth('created_at', date('m'))
        ->whereYear('created_at', date('Y'))
        ->count();
        $today_hits = LoginHistory::whereDate('created_at', date('Y-m-d'))->count();
        $total_hits = LoginHistory::count();
        $login_states = LoginHistory::select('state', DB::raw('count(*) as total'))
                 ->groupBy('state')
                 ->orderByDesc('total')
                 ->get();
            
        // exit();
        return view('dashboard')->with(compact('monthly_hits','today_hits', 'login_states','total_hits'));
    }

    public function calculator($locale='en')
    {
        App::setLocale($locale);
        $uspsprice_list = USPSPriceList::get();
        $price_list = array();
        foreach ($uspsprice_list as $row) {
            $price_list[$row->lbs.'lbs'] = $row->price;
        }
        
        // $country = $request->country ?? '.com';
        // $fba_price = $request->fba_price ?? '';
        // $mf_price = $request->mf_price ?? '';
        // $item_cost = $request->item_cost ?? '';
        // $inbound_shipping = $request->inbound_shipping ?? '';
        // $shipping = $request->shipping ?? '';
        // $misc_fees = $request->misc_fees ?? '';

        $country = '.com';
        $fba_price = '';
        $mf_price = '';
        $item_cost = '';
        $inbound_shipping = '';
        $shipping = '';
        $misc_fees = '';

        // dump($price_list);
        return view('newcalculator')->with(compact('price_list','locale', 'country', 'fba_price','mf_price', 'item_cost', 'inbound_shipping', 'shipping', 'misc_fees'));
    }

    public function ip_address_hits()
    {
        $login_history = LoginHistory::orderByDesc('created_at')->get();
        return view('ip_address_hits')->with(compact('login_history'));
    }

    public function users()
    {
        $users = User::orderByDesc('created_at')->get();
        return view('users')->with(compact('users'));
    }

    public function uspsPriceList()
    {
        $uspsprice_list = USPSPriceList::get();
        return view('usps_price_list')->with(compact('uspsprice_list'));
    }
    
}
