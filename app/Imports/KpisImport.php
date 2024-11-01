<?php

namespace App\Imports;

use App\Models\Kpis;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class KpisImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     * 
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        // dd($row); // Debugging to see the structure of $row array
        return new Kpis([
            'name' => $row['ten_nhan_vien'],
            'diem' => $row['diem'],
            'thang' => $row['thang'],
            'nam' => $row['nam'],
        ]);
    }
    
}


