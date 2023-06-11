<?php

namespace App\Http\Controllers;

use App\Http\Resources\Team\TeamCollection;
use App\Http\Resources\Team\TeamResource;   
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teams = Team::all();
        if (is_null($teams)) {
            return response()->json('No teams found', 404);
        }
        return response()->json([
            'teams' => new TeamCollection($teams)
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
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:teams',
            'country' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'sport' => 'required|string|max:255',
            'founded' => 'required|integer|between:1800,2023',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $team = Team::create([
            'name' => $request->name,
            'country' => $request->country,
            'city' => $request->city,
            'sport' => $request->sport,
            'founded' => $request->founded,
        ]);

        return response()->json([
            'Team created' => new TeamResource($team)
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function show($team_id)
    {
        $team = Team::find($team_id);
        if (is_null($team)) {
            return response()->json('Team not found', 404);
        }
        return response()->json([
            'teams' => new TeamResource($team)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function edit(Team $team)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Team $team)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'sport' => 'required|string|max:255',
            'founded' => 'required|integer|between:1800,2023',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $team->name = $request->name;
        $team->country = $request->country;
        $team->city = $request->city;
        $team->sport = $request->sport;
        $team->founded = $request->founded;

        $team->save();

        return response()->json([
            'Team updated' => new TeamResource($team)
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function destroy(Team $team)
    {
        $team->delete();

        return response()->json('Team deleted');
    }
}
