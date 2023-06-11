<?php

namespace App\Http\Controllers;

use App\Http\Resources\Player\PlayerCollection;
use App\Http\Resources\Player\PlayerResource;   
use App\Models\Player;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PlayerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $players = Player::all();
        if (is_null($players)) {
            return response()->json('No players found', 404);
        }
        return response()->json([
            'players' => new PlayerCollection($players)
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
            'name' => 'required|string|max:255|unique:players',
            'birth' => 'required|integer|between:1970,2023',
            'nationality' => 'required|string|max:255',
            'sport' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'trophies' => 'required|integer|between:0,30',
            'team_id' =>  'required|integer|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $team = Team::find($request->team_id);
        if (is_null($team)) {
            return response()->json('Team not found', 404);
        }

        $player = Player::create([
            'name' => $request->name,
            'birth' => $request->birth,
            'nationality' => $request->nationality,
            'sport' => $request->sport,
            'role' => $request->role,
            'trophies' => $request->trophies,
            'team_id' => $request->team_id,
        ]);

        return response()->json([
            'Player inserted' => new PlayerResource($player)
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Player  $player
     * @return \Illuminate\Http\Response
     */
    public function show($player_id)
    {
        $player = Player::find($player_id);
        if (is_null($player)) {
            return response()->json('Player not found', 404);
        }
        return response()->json([
            'player' => new PlayerResource($player)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Player  $player
     * @return \Illuminate\Http\Response
     */
    public function edit(Player $player)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Player  $player
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Player $player)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'birth' => 'required|integer|between:1970,2023',
            'nationality' => 'required|string|max:255',
            'sport' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'trophies' => 'required|integer|between:0,30',
            'team_id' =>  'required|integer|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $team = Team::find($request->team_id);
        if (is_null($team)) {
            return response()->json('Team not found', 404);
        }

        $player->name = $request->name;
        $player->birth = $request->birth;
        $player->nationality = $request->nationality;
        $player->sport = $request->sport;
        $player->role = $request->role;
        $player->trophies = $request->trophies;
        $player->team_id = $request->team_id;

        $player->save();

        return response()->json([
            'Player updated' => new PlayerResource($player)
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Player  $player
     * @return \Illuminate\Http\Response
     */
    public function destroy(Player $player)
    {
        $player->delete();

        return response()->json('Player deleted');
    }
}
