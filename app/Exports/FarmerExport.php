<?php

namespace App\Exports;

use App\Models\Farmer;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class FarmerExport implements FromCollection, WithHeadings, WithEvents
{

    protected $request;
    protected $type;

    function __construct($request, $type)
    {
        $this->request = $request;
        $this->type = $type;
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet->getStyle('A1:A1')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'size' => 15,
                    ],
                ]);


                $event->sheet->getStyle('A2:A2')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'size' => 12,
                    ],
                ]);

                $event->sheet->getStyle('A3:A3')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'size' => 12,
                    ],
                ]);

                $event->sheet->getStyle('A4:x4')->applyFromArray([
                    'font' => [
                        'bold' => true,
                    ],
                ]);
            },
        ];
    }

    public function headings(): array
    {


        return [
            ['FSPN-AFRICA FARMERS REPORT'],
            ['Initiated By:' . User::find(Auth::user()->id)->name],
            ['Date: ' . Carbon::now()->format('d-F-Y g:i:s a')],
            [
                'First Name',
                'Last Name',
                'Account No',
                'Telephone',
                'Alternate Phone',
                'Email',
                'Gender',
                'ID Number/Passport',
                'Town/County',
                'Sub County',
                'Address',
                'Date Of Birth',
                'Total Land Size (Acres)',
                'Produce',
                'Registered By',
                'Date Registered',
                'Comments'

            ]
        ];
    }
    /**
     * @return \Illuminate\Support\Collection
     */

    public function collection()
    {
        return Farmer::searchFarmers($this->request, $this->type);
        //return Farmer::searchFarmers($this->request, $this->type);
    }
}
