<?php

namespace App\Http\Controllers;

use App\Models\Status;
use App\Models\Filial;
use App\Models\Info;
use App\Models\Operator;
use App\Models\Terrorist;
use Illuminate\Http\Request;
use App\Imports\TerroristImport;
use Maatwebsite\Excel\Facades\Excel;

class AtcController extends Controller
{
    public function atc()
    {
        return view('atc');
    }

    public function atc_check()
    {
        $filails = Filial::all();

        return view('atc__check', array("filails" => $filails));
    }

    public function atc_check_post(Request $request)
    {
        $request->validate(array(
            "date_op" => "required",
            "filial" => "required"
        ));

        $filial = Filial::where("name_podr", "=", $request->filial)->first();
        $results = Operator::whereDate("date_in", "=", $request->date_op)->where("podsetka", "=", $filial->podsetka)->get();

        return view('atc__check', array("results" => $results));
    }

    public function atc_add_filial()
    {
        return view('atc__add_filial');
    }

    public function atc_add_filial_post(Request $request)
    {
        $request->validate(array(
            "name_filial" => "required",
            "podr_filial" => "required",
            "podsetka" => "required"

        ));

        Filial::create(array(
            "name_podr" => $request->name_filial,
            "podr" => $request->podr_filial,
            "podsetka" => $request->podsetka
        ));

        return redirect()->route("atc_add_filial");
    }


    public function atc_update()
    {
        $statuses = Status::all();
        return view('atc__update', array("statuses" => $statuses));
    }

    public function atc_update_post(Request $request)
    {

        set_time_limit(9999999 * 60);

        if ($request->has('import')) 
        {
            $request->validate(array(
                'status' => 'required',
                'excel_file' => 'required|file',
            ));

            Terrorist::where('status_id', "=", $request->status)->where("post_type", "=", 0)->delete();
            Excel::import(new TerroristImport($request), $request->file('excel_file'));
            return redirect()->route('atc_update_post');
        }

        if ($request->has('update')) 
        {
            $request->validate(array(
                'status' => 'required',
            ));

            $this->update_atc_data($request->status);
        }

    }

    private function update_atc_data($status)
    {
        if ($status == 1) 
        {
            Terrorist::where('status_id', "=", $status)->where("post_type", "=", 1)->delete();
            $arr = $this->xml_parser("https://scsanctions.un.org/resources/xml/en/consolidated.xml");

            if (array_key_exists('INDIVIDUALS', $arr)) 
            {
                if (array_key_exists('INDIVIDUAL', $arr['INDIVIDUALS'])) 
                {
                    $INDIVIDUALS = $arr['INDIVIDUALS']['INDIVIDUAL'];
                    $array_one = $this->muttahid($INDIVIDUALS, $status);
                    $this->addTerrors($array_one, $status, 1);
                }
            }

            if (array_key_exists('ENTITIES', $arr)) 
            {
                if (array_key_exists('ENTITY', $arr['ENTITIES'])) 
                {
                    $ENTITIES = $arr['ENTITIES']['ENTITY'];
                    $array_two = $this->muttahid($ENTITIES, $status);
                    $this->addTerrors($array_two, $status, 1);
                }
            }

            $arr = $this->xml_parser("https://scsanctions.un.org/al-qaida/");

            if (array_key_exists('INDIVIDUALS', $arr)) 
            {
                if (array_key_exists('INDIVIDUAL', $arr['INDIVIDUALS'])) 
                {
                    $INDIVIDUALS = $arr['INDIVIDUALS']['INDIVIDUAL'];
                    $array_one = $this->muttahid($INDIVIDUALS, $status);
                    $this->addTerrors($array_one, $status, 1);
                }
            }

            if (array_key_exists('ENTITIES', $arr)) 
            {
                if (array_key_exists('ENTITY', $arr['ENTITIES'])) 
                {
                    $ENTITIES = $arr['ENTITIES']['ENTITY'];
                    $array_two = $this->muttahid($ENTITIES, $status);
                    $this->addTerrors($array_two, $status, 1);
                }
            }

        } 
        elseif ($status == 2) 
        {

            Terrorist::where('status_id', "=", $status)->where("post_type", "=", 1)->delete();

            $arr = $this->xml_parser("https://www.treasury.gov/ofac/downloads/sdn.xml");
            $data = $arr['sdnEntry'];

            $array = array();

            foreach ($data as $item) 
            {

                $fio = $dateBith = '';

                if (array_key_exists('lastName', $item)) 
                {
                    $fio = $item['lastName'];
                }

                if (array_key_exists('dateOfBirthList', $item)) 
                {
                    if (array_key_exists('dateOfBirthItem', $item['dateOfBirthList'])) 
                    {
                        if (array_key_exists('dateOfBirth', $item['dateOfBirthList']['dateOfBirthItem'])) 
                        {
                            $dateBith = $item['dateOfBirthList']['dateOfBirthItem']['dateOfBirth'];
                        }
                    }
                }

                $data =  array(
                    "status_id" => $status,
                    "post_type" => 1,
                    "fio" => $fio,
                    "date_birth" => $dateBith,
                    "date_add" => '',
                    "document_type" => '',
                    "document_number" => '',
                    "comment" => ''
                );

                array_push($array, $data);
            }

            $this->addTerrors($array, $status, 1);
        }

        return redirect()->route('atc_update_post');
    }


    private function addTerrors($data, $status, $typeofPost)
    {
        $i = 0;
        foreach ($data as $item) {
            Terrorist::create(array(
                "status_id" => $item['status_id'],
                "post_type" => $item['post_type'],
                "fio" => $item['fio'],
                "date_birth" => $item['date_birth'],
                "date_add" => $item['date_add'],
                "document_type" => $item['document_type'],
                "document_number" => $item['document_number'],
                "comment" => $item['comment']
            ));
            $i++;
        }

        $result = Info::create(array(
            "date_update" => date("y-m-d"),
            "count_update" => $i,
            "post_type" => $typeofPost,
            "status_id" => $status
        ));

        if (!$result) {
            return false;
        }

        return true;
    }


    private function muttahid($ENTITIES, $status)
    {
        $documentType = $firstName = $secondName = $thirdName = $documentNumber = $fio = $dateBith = $dateAdd = $comments = '';

        $array = array();

        foreach ($ENTITIES as $item) 
        {
            if (array_key_exists('FIRST_NAME', $item)) 
            {
                $firstName = $item['FIRST_NAME'] ?? '';
            }

            if (array_key_exists('SECOND_NAME', $item)) 
            {
                $secondName = $item['SECOND_NAME']  ?? '';
            }

            if (array_key_exists('THIRD_NAME', $item)) 
            {
                $thirdName = $item['THIRD_NAME'] ?? '';
                if (is_array($thirdName)) 
                {
                    $thirdName = '';
                }
            }

            $fio = $firstName . ' ' . $secondName . ' ' . $thirdName;

            if (array_key_exists('INDIVIDUAL_DATE_OF_BIRTH', $item)) 
            {
                if (array_key_exists('DATE', $item['INDIVIDUAL_DATE_OF_BIRTH']))
                {
                    $dateBith = $item['INDIVIDUAL_DATE_OF_BIRTH']['DATE'] ?? '';
                }
                if (array_key_exists('YEAR', $item['INDIVIDUAL_DATE_OF_BIRTH'])) 
                {
                    $dateBith = $item['INDIVIDUAL_DATE_OF_BIRTH']['YEAR'] ?? '';
                }

                if (array_key_exists('FROM_YEAR', $item['INDIVIDUAL_DATE_OF_BIRTH']) && array_key_exists('TO_YEAR', $item['INDIVIDUAL_DATE_OF_BIRTH'])) 
                {
                    $dateBith = $item['INDIVIDUAL_DATE_OF_BIRTH']['FROM_YEAR'] . ' - ' . $item['INDIVIDUAL_DATE_OF_BIRTH']['TO_YEAR'] ?? '';
                }
            }

            if (array_key_exists('LISTED_ON', $item)) 
            {
                $dateAdd = $item['LISTED_ON'] ?? '';
            }


            if (array_key_exists('INDIVIDUAL_DOCUMENT', $item)) 
            {
                if (array_key_exists('TYPE_OF_DOCUMENT', $item['INDIVIDUAL_DOCUMENT'])) 
                {
                    $documentType = $item['INDIVIDUAL_DOCUMENT']['TYPE_OF_DOCUMENT'];
                }

                if (array_key_exists('NUMBER', $item['INDIVIDUAL_DOCUMENT'])) 
                {
                    $documentNumber = $item['INDIVIDUAL_DOCUMENT']['NUMBER'] ?? '';
                }
            }

            if (array_key_exists('COMMENTS1', $item)) 
            {
                $comments = $item['COMMENTS1'] ?? '';

                if (is_array($comments)) 
                {
                    $comments = '';
                }
            }

            $data =  array(
                "status_id" => $status,
                "post_type" => 1,
                "fio" => $fio,
                "date_birth" => $dateBith,
                "date_add" => $dateAdd,
                "document_type" => $documentType,
                "document_number" => $documentNumber,
                "comment" => $comments
            );

            array_push($array, $data);
        }

        return $array;
    }


    private function xml_parser($url)
    {
        $arr = json_decode(json_encode(simplexml_load_string(file_get_contents($url))), true);
        return $arr;
    }
}
