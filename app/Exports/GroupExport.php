<?php

namespace App\Exports;

use App\Models\Farmer;
use App\Models\Group;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class GroupExport implements FromCollection, WithHeadings, WithEvents
{

    protected $request;
    protected $type;
    protected $groups_count;

    function __construct($request, $type, $groups_count)
    {
        $this->request = $request;
        $this->type = $type;
        $this->groups_count = $groups_count;
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
                $event->sheet->getStyle('A4:A4')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'size' => 12,
                    ],
                ]);

                $event->sheet->getStyle('A5:G5')->applyFromArray([
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
            ['FSPN-AFRICA GROUPS REPORT'],
            ['Initiated By:' . User::find(Auth::user()->id)->name],
            ['Date: ' . Carbon::now()->format('d-F-Y g:i:s a')],
            ['Group Count: ' . $this->groups_count],
            [
                'Group Name',
                'Group ID',
                'County',
                'Sub County',
                'Date Created',
                'Created By',
                'Comments'

            ]
        ];
    }
    /**
     * @return \Illuminate\Support\Collection
     */

    public function collection()
    {
        return Group::searchGroups($this->request, $this->type);
    }
}
