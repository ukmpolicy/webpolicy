<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Officer extends Model
{
    use HasFactory;

    public static function getOfficer() {
        if (Period::getPeriodeActive()) {
            return Officer::select(
                'officers.id',
                'members.name',
                'members.nim',
                'officers.picture',
                'positions.name as position',
                'divisions.name as division'
            )
            ->leftJoin('members','officers.member_id','=','members.id')
            ->leftJoin('positions','officers.position_id','=','positions.id')
            ->leftJoin('divisions','positions.division_id','=','divisions.id')
            ->where('positions.period_id', Period::getPeriodeActive()->id)
            ->get();
        }
        return [];
    }

    public static function getOfficersByDivision($id) {
        if (Period::getPeriodeActive()) {
            return Officer::select(
                'officers.id',
                'members.name',
                'members.nim',
                'officers.picture',
                'positions.name as position',
                'divisions.name as division'
            )
            ->leftJoin('members','officers.member_id','=','members.id')
            ->leftJoin('positions','officers.position_id','=','positions.id')
            ->leftJoin('divisions','positions.division_id','=','divisions.id')
            ->where('positions.period_id', Period::getPeriodeActive()->id)
            ->where('positions.division_id', $id)
            ->get();
        }
        return [];
    }

    public static function getCoreOfficer() {
        if (Period::getPeriodeActive()) {
            return Officer::select(
                'officers.id',
                'members.name',
                'members.nim',
                'officers.picture',
                'positions.name as position',
                'divisions.name as division'
            )
            ->leftJoin('members','officers.member_id','=','members.id')
            ->leftJoin('positions','officers.position_id','=','positions.id')
            ->leftJoin('divisions','positions.division_id','=','divisions.id')
            ->where('positions.period_id', Period::getPeriodeActive()->id)
            ->where('positions.sub_in_position_id', null)
            ->orderBy('positions.index', 'ASC')
            ->get();
        }
        return [];
    }
}
