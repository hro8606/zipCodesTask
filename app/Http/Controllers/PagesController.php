<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PagesController extends Controller
{

    public function index()
    {
        return view('countries.index');
    }

    public function action(Request $request)
    {

        if ($request->ajax()) {
            $output = '';
            $query = $request->get('query');
            if ($query != '') {

                $places = DB::table('z_codes')
                    ->join('places', 'z_codes.places_id', '=', 'places.id')
                    ->join('countries', 'z_codes.country_id', '=', 'countries.id')
                    ->where('z_codes.zip_code', 'like', '%' . $query . '%')
                    ->orWhere('places.place_name', 'like', '%' . $query . '%')
                    ->orWhere('countries.name', 'like', '%' . $query . '%')
                    ->select('z_codes.*', 'places.*', 'countries.*')
                    ->orderBy('z_codes.zip_code', 'desc')
                    ->get();

            } else {
                $places = DB::table('z_codes')
                    ->join('places', 'z_codes.places_id', '=', 'places.id')
                    ->join('countries', 'z_codes.country_id', '=', 'countries.id')
                    ->select('z_codes.*', 'places.*', 'countries.*')
                    ->get();
            }
            $total_row = $places->count();
            if ($total_row > 0) {

                foreach ($places as $row) {
                    $output .= '<tr>
                                    <td>' . $row->name . '</td>
                                    <td>' . $row->abbreviation . '</td>
                                    <td>' . $row->place_name . '</td>
                                    <td>' . $row->state . '</td>
                                    <td>' . $row->longitude . '</td>
                                    <td>' . $row->latitude . '</td>
                                    <td>' . $row->zip_code . '</td>
                                </tr> ';
                }
            } else {
                $output = '
                <tr>
                    <td align="center" colspan="7">No Data Found</td>
                </tr>';
            }
            $data = array(
                'table_data' => $output,
                'total_data' => $total_row
            );

            echo json_encode($data);

        }

    }

}
