<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Goutte\Client;
use Symfony\Component\HttpClient\HttpClient;
use App\Models\USPSPriceList;

class scrapingController extends Controller
{
    //
    public function ScrapData()
    {
        $lbs=1;
        $goutteClient = new Client(HttpClient::create(['timeout' => 120, 'verify_host' => false]));
        // $guzzleClient = new Client(array(
        //     'timeout' => 120,
        //     'verify' => false
        // ));
        // $goutteClient->setClient($guzzleClient);

        $crawler = $goutteClient->request('GET', 'https://pe.usps.com/text/dmm300/notice123.htm');
        USPSPriceList::truncate();
        
        $crawler->filter('#_c059 span')->each(function ($node) use (&$data, &$lbs) {
            $price = str_replace('$', '',$node->text());
            if($lbs <=15)
            {
            $pricelist = new USPSPriceList;

            $pricelist->lbs = $lbs;
            $pricelist->price = $price;
            $pricelist->save();
            // dump($node->text());
            $lbs = $lbs+1;
            }else{
                return true;
            }
        });
    }
}
