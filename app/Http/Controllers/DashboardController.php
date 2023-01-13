<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct() {
        $community;
    }

    public function __invoke()
    {
        $user = auth()->user();
        if(auth()->user()->community) {
            $this->community = $user->community;
        }
        $students_count = Student::query()
            ->when(auth()->user()->hasAnyRole(['coordinator','secretary']), function($query) {
                $query->where('community_id', $this->community->id);
            })
            ->when(auth()->user()->hasRole('catechist'), function($query) {
                $students = $query->whereHas('groups', function($query) {
                    $groups = auth()->user()->groups()->where('year', date('Y'))->where('finished', false)->pluck('id');
                    return $query->whereIn('group_id', $groups);
                });
            })
            ->where('status', 'ativo')
            ->count();

        $catechists_count = User::query()
            ->when(auth()->user()->community, function($query) {
                $query->where('community_id', $this->community->id);
            })
            ->count();

        $groups_count = Group::query()
            ->when(auth()->user()->community, function($query) {
                $query->where('community_id', $this->community->id);
            })
            ->where('finished', false)
            ->count();

        return view('dashboard', [
            'user' => $user,
            'name' => strstr($user->name, ' ', true),
            'community' => $this->community ?? null,
            'students_count' => $students_count,
            'catechists_count' => $catechists_count,
            'groups_count' => $groups_count,
        ]);
    }
}
