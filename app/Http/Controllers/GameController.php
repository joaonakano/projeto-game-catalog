<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;

class GameController extends Controller
{
    public function index()
    {
        $games = Game::all();
        return view('games.index', compact('games'));
    }

    public function create()
    {
        return view('games.create');
    }

    public function store(Request $request)
    {
        //dd("Dados chegaram, antes da validação");
        $request->validate([
            "name" => "required",
            "description" => "required|max:250",
            "release_date" => "required",
            "developer" => "required|max:50",
            "publisher" => "required|max:50"
        ]);

        $gameData = [
            "uuid" => uuid_create(),
            "name" => $request->name,
            "description" => $request->description,
            "release_date" => $request->release_date,
            "developer" => $request->developer,
            "publisher" => $request->publisher,
        ];

        Game::create( $gameData);
        
        return redirect()->route('games.index')->with('status',  __("Game Successfully Created"));
    }

    public function show(Game $game)
    {
    }

    public function edit(Game $game)
    {
        return view('games.edit', compact("game"));
    }

    public function update(Request $request, Game $game)
    {
    }

    public function destroy(Game $game)
    {
    }
}
