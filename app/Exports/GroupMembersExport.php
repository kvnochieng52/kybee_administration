<?php

namespace App\Exports;

use App\Models\Group;
use App\Models\GroupMember;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class GroupMembersExport implements FromCollection, WithHeadings, WithEvents
{

    protected $request;
    protected $type;
    protected $groups_count;

    protected $group_details;
    protected $group_members;
    protected $group_leader;

    function __construct($request, $type)
    {
        $this->request = $request;
        $this->type = $type;

        $this->group_details = Group::groupByID($request->input('group_id'));
        $this->group_members = GroupMember::groupMembersByGroupExcel($request->input('group_id'));
        $this->group_leader = GroupMember::leftJoin('farmers', 'group_members.farmer_id', '=', 'farmers.id')
            ->where('group_id', $request->input('group_id'))
            ->where('group_leader', 1)
            ->first([
                'farmers.first_name',
                'farmers.last_name'
            ]);
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

                $event->sheet->getStyle('A5:A5')->applyFromArray([
                    'font' => [
                        'bold' => true,
                    ],
                ]);

                $event->sheet->getStyle('A6:A6')->applyFromArray([
                    'font' => [
                        'bold' => true,
                    ],
                ]);

                $event->sheet->getStyle('A7:A7')->applyFromArray([
                    'font' => [
                        'bold' => true,
                    ],
                ]);

                $event->sheet->getStyle('A8:A8')->applyFromArray([
                    'font' => [
                        'bold' => true,
                    ],
                ]);

                $event->sheet->getStyle('A9:A9')->applyFromArray([
                    'font' => [
                        'bold' => true,
                    ],
                ]);


                $event->sheet->getStyle('A10:A10')->applyFromArray([
                    'font' => [
                        'bold' => true,
                    ],
                ]);

                $event->sheet->getStyle('A11:Q11')->applyFromArray([
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
            ['FSPN-AFRICA GROUP DETAILS & MEMBERS REPORT'],
            ['Group Name:' . $this->group_details->group_name],
            ['Group Leader:' . $this->group_leader->first_name . " " . $this->group_leader->last_name],
            ['Group ID:' . $this->group_details->id],
            ['County:' . $this->group_details->county_name],
            ['Sub County:' . $this->group_details->sub_county_name],
            ['Date Created:' . Carbon::parse($this->group_details->created_at)->format('d-m-Y')],
            ['Date: ' . Carbon::now()->format('d-F-Y g:i:s a')],
            ['Initiated By:' . User::find(Auth::user()->id)->name],
            ['Members Count: ' . count($this->group_members)],
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
        return  $this->group_members;
    }
}
