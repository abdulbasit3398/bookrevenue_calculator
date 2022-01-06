<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\LoginHistory;
use Stevebauman\Location\Facades\Location;
use Browser;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {
        $request->authenticate();

        $request->session()->regenerate();
        $ip_address = $request->ip();
        
        if ($position = Location::get($ip_address)) {
            // Successfully retrieved position.
            $countryName = $position->countryName;
            $regionName = $position->regionName;
            $cityName = $position->cityName;
            $zipCode = $position->zipCode;
        } else {
            // Failed retrieving position.
            $countryName = '';
            $regionName = '';
            $cityName = '';
            $zipCode = '';
        }
        $browserName = Browser::browserName();
        $OSName = Browser::platformName();
        $deviceModel = Browser::deviceModel();
        $deviceType = '';
        if (Browser::isMobile()) {
            $deviceType = 'mobile';
        }else if(Browser::isTablet()) {
            $deviceType = 'tablet';
        }else if(Browser::isDesktop()) {
            $deviceType = 'desktop';
        }
        
        LoginHistory::create([
            'user_id' => Auth::user()->id,
            'ip_address' => $ip_address,
            'zip_code' => $zipCode,
            'city' => $cityName,
            'state' => $regionName,
            'country' => $countryName,
            'browser_name' => $browserName,
            'os_name' => $OSName,
            'device_model' => $deviceModel,
            'device_type' => $deviceType,
        ]);
        return redirect(RouteServiceProvider::HOME);
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
