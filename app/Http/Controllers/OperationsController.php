<?php

namespace App\Http\Controllers;

use App\Models\Terrorist;
use Illuminate\Http\Request;

use App\Imports\TerroristImport;
use Maatwebsite\Excel\Facades\Excel;

class OperationsController extends Controller
{
    public function check()
    {
        return view('check');
    }

    public function check_clients_bank()
    {
        return view('check__clients_banks');
    }

    public function check_clients_bank_post(Request $request)
    {

        $request->validate(array(
            'percent' => 'required',
            'excel_file' => 'required|file',
        ));

        set_time_limit(9999999999 * 3600);

        $obj = simplexml_load_file($request->file('excel_file')->getRealPath());
        $persons = json_decode(json_encode($obj->Persons), true);

        $terrorists = Terrorist::select('fio', 'date_birth')->get();

        $array = array();

        foreach ($persons['Person'] as $person) {
            foreach ($terrorists as $terrorist) {

                $excel_fio = strtoupper(trim($person['@attributes']['FIO']));
                $sql_fio = strtoupper(trim($terrorist->fio));

                similar_text($sql_fio, $excel_fio, $perc);

                if ($perc > $request->percent) {
                    array_push($array, array(
                        'fio_xml' => $person['@attributes']['FIO'],
                        'date_birth_xml' => $person['@attributes']['BIRTH'],
                        'fio_sql' => $terrorist->fio,
                        'date_birth_sql' => $terrorist->date_birth,
                        'percent' => (int)$perc
                    ));
                }
            }
        }

        return view('check__clients_banks', ['result' => $array]);
    }

    public function check_clients_cberbank()
    {
        return view('check__cberbank');
    }

    public function check_clients_cberbank_post(Request $request)
    {

        $request->validate(array(
            'percent' => 'required',
            'excel_file' => 'required|file',
        ));

        set_time_limit(9999999999 * 3600);

        $clients = Excel::toArray(new TerroristImport($request), $request->file('excel_file'));
        $terrorists = Terrorist::select('fio', 'date_birth')->get();
        $array = array();

        foreach ($clients as $client) {
            foreach ($client as $item) {
                foreach ($terrorists as $terrorist) {
                    $excel_fio = strtoupper(trim($item[1] . ' ' . $item[2] . ' ' . $item[3]));
                    $sql_fio = strtoupper(trim($terrorist->fio));

                    similar_text($sql_fio, $excel_fio, $perc);

                    if ($perc > $request->percent) 
                    {
                        array_push($array, array(
                            'fio_xml' => $excel_fio,
                            'date_birth_xml' => $item[4],
                            'fio_sql' => $terrorist->fio,
                            'date_birth_sql' => $terrorist->date_birth,
                            'percent' => (int)$perc
                        ));
                    }
                }
            }
        }

        return view('check__cberbank', ['result' => $array]);
    }
}
