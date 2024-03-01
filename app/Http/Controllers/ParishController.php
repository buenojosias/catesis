<?php

namespace App\Http\Controllers;

use App\Models\Parish;
use Illuminate\Http\Request;

class ParishController extends Controller
{
    public function index()
    {
        return view('parishes.index');
    }

    public function show(Parish $parish)
    {
        if($parish->tenancy_type == 'multi')
            $communities = $parish->communities()->withCount('active_students')->get();

        $catechists = $parish->users()->orderBy('name', 'asc')->whereActive(true)->get();
        $coordinators = $parish->coordinators;
        $students = $parish->students()->where('status', 'Ativo')->count();
        $groups = $parish->groups()->where('finished', false)->count();

        return view('parishes.show', [
            'parish' => $parish,
            'communities' => $communities ?? null,
            'catechists' => $catechists,
            'coordinators' => $coordinators,
            'students' => $students,
            'groups' => $groups,
        ]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
