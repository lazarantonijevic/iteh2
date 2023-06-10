<?php

namespace App\Http\Controllers;

use App\Http\Resources\Coach\CoachCollection;
use App\Http\Resources\Coach\CoachResource;
use App\Models\Coach;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CoachController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $coaches = Coach::all();
        if (is_null($coaches)) {
            return response()->json('No coaches found', 404);
        }
        return response()->json([
            'coaches' => new CoachCollection($coaches)
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
            'name' => 'required|string|max:255|unique:coaches',
            'birth' => 'required|integer|between:1940,2023',
            'team_id' =>  'required|integer|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $team = Team::find($request->team_id);
        if (is_null($team)) {
            return response()->json('Team not found', 404);
        }

        $coach = Coach::create([
            'name' => $request->name,
            'birth' => $request->birth,
            'team_id' => $request->team_id
        ]);

        return response()->json([
            'Coach inserted' => new CoachResource($coach)
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Coach  $coach
     * @return \Illuminate\Http\Response
     */
    public function show(Coach $coach)
    {
        $coach = Coach::find($coach_id);
        if (is_null($coach)) {
            return response()->json('Coach not found', 404);
        }
        return response()->json([
            'coach' => new CoachResource($coach)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Coach  $coach
     * @return \Illuminate\Http\Response
     */
    public function edit(Coach $coach)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Coach  $coach
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Coach $coach)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'birth' => 'required|integer|between:1940,2023',
            'team_id' =>  'required|integer|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $team = Team::find($request->team_id);
        if (is_null($team)) {
            return response()->json('Team not found', 404);
        }

        $coach->name = $request->name;
        $coach->birth = $request->birth;
        $coach->team_id = $request->team_id;

        $coach->save();

        return response()->json([
            'Coach updated' => new CoachResource($coach)
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Coach  $coach
     * @return \Illuminate\Http\Response
     */
    public function destroy(Coach $coach)
    {
        $coach->delete();

        return response()->json('Coach deleted');
    }
}
