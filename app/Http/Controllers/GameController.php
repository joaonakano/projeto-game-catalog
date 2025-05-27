<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class GameController extends Controller
{
    public function validationMessages() {
        return [
            "name.required" => __('Name is required'),
            "name.max" => __("Name has max 250 characters"),
            "name.regex" => __("Name has invalid characters"),
            "name.unique" => __('Name exists'),

            "description.required" => __('Description is required'),
            "description.regex" => __('Description has invalid characters'),
            "description.max" => __('Description has max 200 characters'),

            "release_date.required" => __('Release date is required'),
            "release_date.date" => __('Date is not valid'),

            "developer.required" => __('Developer is required'),
            "developer.regex" => __('Developer has invalid characters'),
            "developer.max" => __('Developer has max 50 characters'),
            
            "publisher.required" => __('Publisher is required'),
            "publisher.regex" => __('Publisher has invalid characters'),
            "publisher.max" => __('Publisher has max 50 characters'),
        ];
    }

    public function validationRules(Game $game = null) {
        $nameRule = [
            "required",
            "max:250",
            "regex:/[A-Za-z0-9]/",
            Rule::unique("games", "name")->ignore(optional($game)->uuid, 'uuid'),
        ];

        return [
            "name" => $nameRule,
            "description" => "required|max:250|regex:/[A-Za-z0-9]/",
            "release_date" => "required|date",
            "developer" => "required|max:50|regex:/[A-Za-z0-9]/",
            "publisher" => "required|max:50|regex:/[A-Za-z0-9]/"
        ];
    }

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
        $request->validate($this->validationRules(), $this->validationMessages());

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
        return view("games.game", compact('game'));
    }

    public function edit(Game $game)
    {
        return view('games.edit', compact("game"));
    }

    public function update(Request $request, Game $game)
    {

        $request->validate($this->validationRules($game), $this->validationMessages());
        
        $game->update($request->all());

        return redirect()->route("games.index")->with("status", __("The update has been sent successfully"));

    }

    public function destroy(Game $game)
    {
        $game->delete();

        return redirect()->route('games.index')->with('status', __("Game Successfully Deleted"));
    }
}
