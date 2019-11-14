<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlacesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('countries')->insert(array(
            array(
                'name' => 'Andorra',
                'abbreviation' => 'AD',
            ),
            array(
                'name' => 'Belgium',
                'abbreviation' => 'BE',
            ),
            array(
                'name' => 'Canada',
                'abbreviation' => 'CA',
            ),
            array(
                'name' => 'Czech Republic',
                'abbreviation' => 'CZ',
            )

        ));

        DB::table('places')->insert(array(
            array(
                'country_id' => '1',
                'place_name' => 'Canillo',
                'state' => '',
                'state_abbreviation' => '',
                'longitude' => '1.6667',
                'latitude' => '42.5833',
            ),
            array(
                'country_id' => '2',
                'place_name' => 'Bruxelles',
                'state' => 'Bruxelles-Capitale',
                'state_abbreviation' => 'BRU',
                'longitude' => '4.3528',
                'latitude' => '50.8466',
            ),
            array(
                'country_id' => '3',
                'place_name' => 'Whitehorse',
                'state' => 'Yukon',
                'state_abbreviation' => 'YT',
                'longitude' => '-135.0534',
                'latitude' => '60.7227',
            ),
            array(
                'country_id' => '4',
                'place_name' => 'Rozstání',
                'state' => 'Prostějov',
                'state_abbreviation' => '3709',
                'longitude' => '16.8333',
                'latitude' => '49.4',
            ),
            array(
                'country_id' => '4',
                'place_name' => 'Praha 10-Vinohrady (část) x)',
                'state' => 'Hlavní město Praha',
                'state_abbreviation' => '3100',
                'longitude' => '14.4619',
                'latitude' => '50.0036',
            ),
            array(
                'country_id' => '4',
                'place_name' => 'Vršovice (část)',
                'state' => 'Hlavní město Praha',
                'state_abbreviation' => '3100',
                'longitude' => '14.4619',
                'latitude' => '50.0036',
            ),
            array(
                'country_id' => '4',
                'place_name' => 'Žižkov (část)',
                'state' => 'Hlavní město Praha',
                'state_abbreviation' => '3100',
                'longitude' => '14.4619',
                'latitude' => '50.0036',
            ),
            array(
                'country_id' => '4',
                'place_name' => 'Vinohrady (část)',
                'state' => 'Hlavní město Praha',
                'state_abbreviation' => '3100',
                'longitude' => '14.4619',
                'latitude' => '50.0036',
            ),
            array(
                'country_id' => '4',
                'place_name' => 'Praha 10-Malešice (část) x)',
                'state' => 'Hlavní město Praha',
                'state_abbreviation' => '3100',
                'longitude' => '14.4619',
                'latitude' => '50.0036',
            ),
            array(
                'country_id' => '4',
                'place_name' => 'Strašnice (část)',
                'state' => 'Hlavní město Praha',
                'state_abbreviation' => '3100',
                'longitude' => '14.4619',
                'latitude' => '50.0036',
            ),
            array(
                'country_id' => '4',
                'place_name' => 'Praha 10-Žižkov (část) x)',
                'state' => 'Hlavní město Praha',
                'state_abbreviation' => '3100',
                'longitude' => '14.4619',
                'latitude' => '50.0036',
            ),
            array(
                'country_id' => '4',
                'place_name' => 'Praha 10-Strašnice (část) x)',
                'state' => 'Hlavní město Praha',
                'state_abbreviation' => '3100',
                'longitude' => '14.4619',
                'latitude' => '50.0036',
            ),
            array(
                'country_id' => '4',
                'place_name' => 'Malešice (část)',
                'state' => 'Hlavní město Praha',
                'state_abbreviation' => '3100',
                'longitude' => '14.4619',
                'latitude' => '50.0036',
            ),
            array(
                'country_id' => '4',
                'place_name' => 'Praha 10-Vršovice (část) x)',
                'state' => 'Hlavní město Praha',
                'state_abbreviation' => '3100',
                'longitude' => '14.4619',
                'latitude' => '50.0036',
            )

        ));

        DB::table('z_codes')->insert(array(

            array(
                'places_id' => '1',
                'country_id' => '1',
                'zip_code' => 'AD100',
            ),
            array(
                'places_id' => '2',
                'country_id' => '2',
                'zip_code' => 'AD100',
            ),
            array(
                'places_id' => '3',
                'country_id' => '3',
                'zip_code' => 'Y1A',
            ),
            array(
                'places_id' => '4',
                'country_id' => '4',
                'zip_code' => '798 62',
            ),
            array(
                'places_id' => '5',
                'country_id' => '4',
                'zip_code' => '100 00',
            ),
            array(
                'places_id' => '6',
                'country_id' => '4',
                'zip_code' => '100 00',
            ),
            array(
                'places_id' => '7',
                'country_id' => '4',
                'zip_code' => '100 00',
            ),
            array(
                'places_id' => '8',
                'country_id' => '4',
                'zip_code' => '100 00',
            ),
            array(
                'places_id' => '9',
                'country_id' => '4',
                'zip_code' => '100 00',
            ),
            array(
                'places_id' => '10',
                'country_id' => '4',
                'zip_code' => '100 00',
            ),
            array(
                'places_id' => '11',
                'country_id' => '4',
                'zip_code' => '100 00',
            ),
            array(
                'places_id' => '12',
                'country_id' => '4',
                'zip_code' => '100 00',
            ),
            array(
                'places_id' => '13',
                'country_id' => '4',
                'zip_code' => '100 00',
            ),
            array(
                'places_id' => '14',
                'country_id' => '4',
                'zip_code' => '100 00',
            ),


        ));
    }
}
