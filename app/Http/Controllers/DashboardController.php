<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Encounter;
use App\Models\Group;
use App\Models\Student;
use App\Models\StudentProfile;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $user_id = session('user_id');
        $community_id = session('community_id');
        $role = session('role');

        $students_count = Student::query()
            ->when(auth()->user()->hasExactRoles('catechist'), function ($query) use ($user_id) {
                $students = $query->whereHas('groups', function ($query) use ($user_id) {
                        $groups = auth()->user()->groups()->where('year', date('Y'))->where('finished', false)->pluck('id');
                        return $query->whereIn('group_id', $groups);
                    }
                );
            })
            ->where('status', 'Ativo')
            ->count();

        $catechists_count = User::role('catechist')->count();
        $groups_count = Group::query()->where('finished', false)->count();
        $events = Event::query()
            ->whereDate('start_date', '>=', date('Y-m-d'))
            ->orderBy('start_date', 'asc')->orderBy('start_time', 'asc')
            ->get();

        foreach ($events as $event) {
            if ($event->start_date->format('Y-m-d') == Carbon::parse(now())->format('Y-m-d')) {
                $event['date'] = 'Hoje';
            } else if ($event->start_date->format('Y-m-d') == Carbon::parse(now()->addDay())->format('Y-m-d')) {
                $event['date'] = 'Amanhã';
            } else {
                $event['date'] = Carbon::parse($event->start_date)->format('d/m');
            }
        }

        $birthdays = Student::query()
            ->whereRaw('DAYOFYEAR(curdate()) <= DAYOFYEAR(birthday) AND DAYOFYEAR(curdate()) + 4 >=  dayofyear(birthday)')
            ->with('grade')
            ->orWhereRaw('DAYOFYEAR(curdate()) >= DAYOFYEAR(birthday) AND DAYOFYEAR(curdate()) - 3 <=  dayofyear(birthday)')
            ->orderByRaw('DAYOFYEAR(birthday)')
            ->get();

        $baptisms = StudentProfile::query()
            ->whereHas('student')
            ->whereRaw('DAYOFYEAR(curdate()) <= DAYOFYEAR(baptism_date) AND DAYOFYEAR(curdate()) + 4 >=  dayofyear(baptism_date)')
            ->orWhereRaw('DAYOFYEAR(curdate()) >= DAYOFYEAR(baptism_date) AND DAYOFYEAR(curdate()) - 3 <=  dayofyear(baptism_date)')
            ->orderByRaw('DAYOFYEAR(baptism_date)')
            ->with('student.grade')
            ->get();
        $baptisms = $baptisms->where('student', '<>', null);

        if (auth()->user()->hasRole('catechist')) {
            $today_group = auth()->user()->groups()->whereHas('encounters', function ($query) {
                $query->whereDate('date', date('Y-m-d'))->where('date', '<=', date('Y-m-d H:i:s'));
            })->with('encounters', function ($query) {
                $query->whereDate('date', date('Y-m-d'))->first();
            })->first();
        } else {
            $today_group = null;
        }

        return view('dashboard', [
            'role' => $role,
            'name' => strstr(session('user_name'), ' ', true),
            // 'community' => $this->community ?? null,
            'students_count' => $students_count,
            'catechists_count' => $catechists_count,
            'groups_count' => $groups_count,
            'events' => $events,
            'birthdays' => $birthdays,
            'baptisms' => $baptisms,
            'today_group' => $today_group,
        ]);
    }
}
