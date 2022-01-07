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
use Illuminate\Support\Facades\Hash;
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

    public function calculator(Request $request,$locale='en')
    {
        App::setLocale($locale);
        $uspsprice_list = USPSPriceList::get();
        $price_list = array();
        foreach ($uspsprice_list as $row) {
            $price_list[$row->lbs.'lbs'] = $row->price;
        }
        
        $country = $request->country ?? '.com';
        $fba_price = $request->fba_price ?? '';
        $mf_price = $request->mf_price ?? '';
        $item_cost = $request->item_cost ?? '';
        $inbound_shipping = $request->inbound_shipping ?? '';
        $shipping = $request->shipping ?? '';
        $misc_fees = $request->misc_fees ?? '';

        // $country = '.com';
        // $fba_price = '';
        // $mf_price = '';
        // $item_cost = '';
        // $inbound_shipping = '';
        // $shipping = '';
        // $misc_fees = '';

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
    public function profile()
    {
        return view('profile');
    }
    public function update_profile(Request $request)
    {
        $this->validate($request,[
            'profile_name' => 'required',
        ]);

        $user = User::findOrFail(Auth::id());
        $user->name = $request->profile_name;
        if(isset($request->password) && $request->password != ''){
            $this->validate($request,[
                'password' => 'string|min:8|confirmed'
            ]);
            $user->password = Hash::make($request->password);
        }
        $user->save();

        return redirect()->back()->with('message','Data updated successfully.');
    }
    public function add_user()
    {
        return view('add_user');
    }
    public function save_user(Request $request)
    {
        $request->validate([
            'profile_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed|min:8',
        ]);

        $user = new User;
        $user->type = $request->user_type;
        $user->name = $request->profile_name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();
        return redirect()->back()->with('message','User added successfully.');
    }
}
