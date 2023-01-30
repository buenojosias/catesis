<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Encounter;
use App\Models\Group;
use App\Models\Student;
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
            ->when($role == 'catechist', function ($query) use ($user_id) {
                $students = $query->whereHas('groups', function ($query) use ($user_id) {
                    // $groups = Group::query()->whereIn('group_id', $user_id)->where('year', date('Y'))->where('finished', false)->pluck('id');
                    $groups = auth()->user()->groups()->where('year', date('Y'))->where('finished', false)->pluck('id');
                    return $query->whereIn('group_id', $groups);
                    }
                );
            })
            ->where('status', 'Ativo')
            ->count();

        $catechists_count = User::query()->count();
        $groups_count = Group::query()->where('finished', false)->count();
        $events = Event::query()
            ->whereDate('starts_at', '>=', date('Y-m-d'))
            ->orderBy('starts_at')
            ->get();

        foreach ($events as $event) {
            if ($event->starts_at->format('Y-m-d') == Carbon::parse(now())->format('Y-m-d')) {
                $event['date'] = 'Hoje';
            } else if ($event->starts_at->format('Y-m-d') == Carbon::parse(now()->addDay())->format('Y-m-d')) {
                $event['date'] = 'Amanhã';
            } else {
                $event['date'] = Carbon::parse($event->starts_at)->format('d/m');
            }
        }

        $birthdays = Student::query()
            ->when($community_id, function ($query) {
                $query->with('grade');
            })
            ->when(!$community_id, function ($query) {
                $query->with('community');
            })
            ->whereRaw('DAYOFYEAR(curdate()) <= DAYOFYEAR(birthday) AND DAYOFYEAR(curdate()) + 4 >=  dayofyear(birthday)')
            ->orWhereRaw('DAYOFYEAR(curdate()) >= DAYOFYEAR(birthday) AND DAYOFYEAR(curdate()) - 3 <=  dayofyear(birthday)')
            ->orderByRaw('DAYOFYEAR(birthday)')
            ->get();

        return view('dashboard', [
            'role' => $role,
            'name' => strstr(session('user_name'), ' ', true),
            // 'community' => $this->community ?? null,
            'students_count' => $students_count,
            'catechists_count' => $catechists_count,
            'groups_count' => $groups_count,
            'events' => $events,
            'birthdays' => $birthdays,
        ]);
    }
}
