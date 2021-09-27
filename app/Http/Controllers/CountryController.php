<?php

namespace App\Http\Controllers;

use Country;
use Illuminate\Http\Request;
use App\Models\countries;

class CountryController extends Controller
{
    public function index()
    {
        
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.printful.com/countries",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "cache-control: no-cache",
            "postman-token: 9bf8d8f9-38b5-b53b-229c-19f4aa178e77"
        ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
        echo "cURL Error #:" . $err;
        } else {
            $data=json_decode($response,true);
            foreach($data['result'] as $val){
                $Country_name=$val['name'];
                $Country_code=$val['code'];
                $Country = countries::where('country', $Country_name)->first();
                if (!$Country) {
    
                    $res = countries::create([
                        'country' => $Country_name,
                        'country_code' => $Country_code,
                    ]);
                }
                
            }
    
            return response([
                'message' => ['Process Done']
            ], 202);
        }
    }
}
