<?php

namespace App\Exports;

use App\Models\Quote;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class QuoteExport implements FromCollection,WithHeadings
{
    public function headings():array{
        return [
            'Id',
            'Name',
            'Email',
            'Phone',
            'Zip Code',
            'Date',
            'Description',
            'Scheduled Date'
        ];
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
      return Quote::query()->select('id','name','email','phone','zip_code','date','description' )->get();

    }
}
