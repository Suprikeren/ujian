<?php

namespace App\Exports;

use App\Models\TblStock;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
// use Maatwebsite\Excel\Concerns\FromCollection;

class StocskExports implements FromQuery, WithMapping,WithHeadings,ShouldAutoSize
{
    use Exportable;
    private $counter = 1;
    /**
    * @return \Illuminate\Support\Collection
    */
    public function query()
    {
        return TblStock::query();
    }
    public function map($stock):array{
        return [
            $this->counter++,
            $stock->barang->nama_barang,
            $stock->qty,
        ];
    }
    public function headings(): array
    {
        return [
            ['daftar stock'],
            [' No', 'nama barang', 'qty'],
         ];

        // return [
        //     'No',
        //     'nama barang',
        //     'qty',
        // ];
    }
}
