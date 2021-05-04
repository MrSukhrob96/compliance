<?php

namespace App\Imports;

use App\Models\Terrorist;
use Maatwebsite\Excel\Concerns\ToModel;

use Maatwebsite\Excel\Concerns\Importable;

class TerroristImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */

    use Importable;

    public $status = '';

    public function __construct($request)
    {
        $this->status = $request->status;
    }

    public function model(array $row)
    {
        //$fio = $row[0] ?? '';
        $surname = $row[1] ?? '';
        $lastname = $row[3] ?? '';
        $name = $row[2] ?? '';
        $birth = $row[4] ?? '';
        $fio = trim($surname . " " . $name . " " . $lastname);

        if (str_contains($fio, '(') && str_contains($fio, ')')) {
            
        }

        return new Terrorist([
            "status_id" => $this->status,
            "post_type" => 0,
            "fio" => $fio,
            "date_birth" => $birth,
            "date_add" => '',
            "document_type" => '',
            "document_number" => '',
            "comment" => ''
        ]);

    }



   // if (str_contains($fio, '(') && str_contains($fio, ')')) {
    //     $fio = str_starts_with('(', $fio);

    //     $this->insertEng($fio, $birth);
    // }

    // $fio = explode('(', $fio);


}
