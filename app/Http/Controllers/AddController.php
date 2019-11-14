<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Country;
use App\Place;
use App\Z_code;
use foo\bar;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AddController extends Controller
{

    private $countries = [
    'Andorra' => 'AD',
    'Argentina' => 'AR',
    'American Samoa' => 'AS',
    'Austria' => 'AT',
    'Australia' => 'AU',
    'Bangladesh' => 'BD',
    'Belgium' => 'BE',
    'Bulgaria' => 'BG',
    'Brazil' => 'BR',
    'Canada' => 'CA',
    'Switzerland' => 'CH',
    'Czech Republic' => 'CZ',
    'Germany' => 'DE',
    'Denmark' => 'DK',
    'Dominican Republic' => 'DO',
    'Spain' => 'ES',
    'Finland' => 'FI',
    'Faroe Islands' => 'FO',
    'France' => 'FR',
    'Great Britain' => 'GB',
    'French Guyana' => 'GF',
    'Guernsey' => 'GG',
    'Greenland' => 'GL',
    'Guadeloupe' => 'GP',
    'Guatemala' => 'GT',
    'Guam' => 'GU',
    'Guyana' => 'GY',
    'Croatia' => 'HR',
    'Hungary' => 'HU',
    'Isle of Man' => 'IM',
    'India' => 'IN',
    'Iceland' => 'IS',
    'Italy' => 'IT',
    'Jersey' => 'JE',
    'Japan' => 'JP',
    'Liechtenstein' => 'LI',
    'Sri Lanka' => 'LK',
    'Lithuania' => 'LT',
    'Luxembourg' => 'LU',
    'Monaco' => 'MC',
    'Moldavia' => 'MD',
    'Marshall Islands' => 'MH',
    'Macedonia' => 'MK',
    'Northern Mariana Islands' => 'MP',
    'Martinique' => 'MQ',
    'Mexico' => 'MX',
    'Malaysia' => 'MY',
    'Holland' => 'NL',
    'Norway' => 'NO',
    'New Zealand' => 'NZ',
    'Phillippines' => 'PH',
    'Pakistan' => 'PK',
    'Poland' => 'PL',
    'Saint Pierre and Miquelon' => 'PM',
    'Puerto Rico' => 'PR',
    'Portugal' => 'PT',
    'French Reunion' => 'RE',
    'Russia' => 'RU',
    'Sweden' => 'SE',
    'Slovenia' => 'SI',
    'Svalbard & Jan Mayen Islands' => 'SJ',
    'Slovak Republic' => 'SK',
    'San Marino' => 'SM',
    'Thailand' => 'TH',
    'Turkey' => 'TR',
    'United States' => 'US',
    'Vatican' => 'VA',
    'Virgin Islands' => 'VI',
    'Mayotte' => 'YT',
    'South Africa' => 'ZA'
    ];

    public function index(){
        return view('add',['countries' => $this->countries]);
    }

    public function store(Request $request){

        $request->validate([
            'countriesSelect1' => 'required',
            'zip_code' => 'required',
        ]);

        $now = Carbon::now()->toDateTimeString();
        $arr = explode('/',request('countriesSelect1'));

        $country_name       = $arr[1];
        $state_abbreviation = $arr[0];

        $zip_code       = request('zip_code');

        $where_country =[
            ['zip_code', $zip_code],
            ['name', $country_name],
            ['abbreviation', $state_abbreviation]
        ];
        $data_from_db = DB::table('z_codes')
                                                ->join('places', 'z_codes.places_id', '=', 'places.id')
                                                ->join('countries', 'z_codes.country_id', '=', 'countries.id')
                                                ->where($where_country)
                                                ->select('z_codes.*', 'places.*', 'countries.*')
                                                ->get();

        /*if we have that country*/
        if(count($data_from_db) > 0){
//            return view('countries.index')->with('places',$data_from_db);
            return view('countries.index')->with('last_zip_code',$zip_code);

        }else{
            /*get from api*/
            $url = "http://api.zippopotam.us/{$state_abbreviation}/{$zip_code}";

            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_VERBOSE, 1);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

            $response = null;
            if (curl_errno($ch)) {
            // moving to display page to display curl errors
                echo curl_errno($ch);
                echo curl_error($ch);
            } else {
            //getting response from server
                $response = curl_exec($ch);
                curl_close($ch);
            }
            $response = json_decode($response, true);

            if(!empty($response)){
                $country_name           = $response['country'];
                $state_abbreviation     = $response['country abbreviation'];
                $zip_code               = $response['post code'];
//
                if($response['places']){
                    $places = $response['places'];

                    /*check if we already have this country*/
                    $country_check = DB::table('countries')->where('name', $country_name)->where('abbreviation', $state_abbreviation)->first();
                    /*Add to countries */
                    if(!empty($country_check)){
                        $country_id = $country_check->id;
                    }else{
                        $countries = new Country;

                        $countries->name            = $country_name;
                        $countries->abbreviation    = $state_abbreviation;
                        $countries->created_at      = $now;
                        $countries->save();
                        $country_id = $countries->id;
                    }

                    for ($j = 0; $j < count($places); $j++) {

                        /*Add to places */
                        $place = new Place;

                        $place->country_id          = $country_id;
                        $place->place_name          = $places[$j]["place name"];
                        $place->state               = $places[$j]["state"];
                        $place->state_abbreviation  = $places[$j]["state abbreviation"];
                        $place->longitude           = $places[$j]["longitude"];
                        $place->latitude            = $places[$j]["latitude"];
                        $place->created_at          = $now;
                        $place->save();
                        $place_id = $place->id;


                        /*Add to zip_code */
                        $z_codes = new Z_code;

                        $z_codes->places_id     = $place_id;
                        $z_codes->country_id    = $country_id;
                        $z_codes->zip_code      = $zip_code;
                        $z_codes->created_at    = $now;
                        $z_codes->save();

                    }
                    /*show stored data*/
                    return view('countries.index')->with('last_zip_code',$zip_code);

                }
            }
            $data_to_return = "There are no places found with this zip_code({$zip_code}) and Country({$country_name})";
            return view('add',['countries' => $this->countries ,'error_data' => $data_to_return]);
        }
    }

}
