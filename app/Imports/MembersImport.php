<?php

namespace App\Imports;

use App\Models\Member;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class MembersImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        // dd($collection);
        foreach ($collection as $i => $data) {
            if ($i > 0) {
                if (!Member::where('nim', $data[0])->first()) {
                    $failed = false;
                    if ($data[0] && $data[1]) $failed = true;

                    if ($failed) {
                        $member = new Member();
                        $member->nim = (is_null($data[0])) ? '' : $data[0];
                        $member->name = strtolower((is_null($data[1])) ? '' : $data[1]);
                        $member->address = strtolower((is_null($data[2])) ? '' : $data[2]);
                        $member->born_at = strtotime((is_null($data[3])) ? '' : $data[3]);
                        $member->birth_place = strtolower((is_null($data[4])) ? '' : $data[4]);
                        $member->phone_number = (is_null($data[5])) ? '' : $data[5];
                        $member->email = strtolower((is_null($data[6])) ? '' : $data[6]);
                        $member->major = strtolower((is_null($data[7])) ? '' : $data[7]);
                        $member->study_program = strtolower((is_null($data[8])) ? '' : $data[8]);
                        $member->joined_at = (is_null($data[9])) ? '' : $data[9];
                        $member->graduation_at = (is_null($data[10])) ? '' : $data[10];
                        $member->other_detail = '';
            
                        $file = explode('\\', (is_null($data[11])) ? '' : $data[11]);
                        $member->profile_picture = end($file);
                        $member->save();
                    }
                }
            }
        }
    }
}
