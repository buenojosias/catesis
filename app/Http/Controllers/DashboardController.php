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
    public function __construct()
    {
        $community;
    }


    public function __invoke()
    {
        $user = auth()->user();
        if (auth()->user()->community) {
            $this->community = $user->community;
        }
        $students_count = Student::query()
            ->when(auth()->user()->hasAnyRole(['coordinator', 'secretary']), function ($query) {
                $query->where('community_id', $this->community->id);
            })
            ->when(auth()->user()->hasRole('catechist'), function ($query) {
                $students = $query->whereHas(
                    'groups',
                    function ($query) {
                            $groups = auth()->user()->groups()->where('year', date('Y'))->where('finished', false)->pluck('id');
                            return $query->whereIn('group_id', $groups);
                        }
                );
            })
            ->where('status', 'ativo')
            ->count();

        $catechists_count = User::query()
            ->when(auth()->user()->community, function ($query) {
                $query->where('community_id', $this->community->id);
            })
            ->count();

        $groups_count = Group::query()
            ->when(auth()->user()->community, function ($query) {
                $query->where('community_id', $this->community->id);
            })
            ->where('finished', false)
            ->count();

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

        $birthdays = Student::query()->
            when(auth()->user()->community, function ($query) {
                $query->where('community_id', $this->community->id)->with('grade');
            })
            ->when(!auth()->user()->community, function ($query) {
                $query->with('community');
            })
            ->whereRaw('DAYOFYEAR(curdate()) <= DAYOFYEAR(birthday) AND DAYOFYEAR(curdate()) + 4 >=  dayofyear(birthday)')
            ->orWhereRaw('DAYOFYEAR(curdate()) >= DAYOFYEAR(birthday) AND DAYOFYEAR(curdate()) - 3 <=  dayofyear(birthday)')
            ->orderByRaw('DAYOFYEAR(birthday)')
            ->get();

        return view('dashboard', [
            'user' => $user,
            'name' => strstr($user->name, ' ', true),
            'community' => $this->community ?? null,
            'students_count' => $students_count,
            'catechists_count' => $catechists_count,
            'groups_count' => $groups_count,
            'events' => $events,
            'birthdays' => $birthdays,
        ]);
    }
}
