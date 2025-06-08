<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

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

            "game_picture.required" => __('Game image is required'),
            "game_picture.file" => __('Invalid file'),
            "game_picture.mimes" => __('Image must be jpg, png or jpeg'),
            "game_picture.max" => __('Image too large (max 10MB)'),
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
            "publisher" => "required|max:50|regex:/[A-Za-z0-9]/",
            "game_picture" => "required|file|mimes:jpg,png,jpeg|max:10240"
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

        // Processar o upload da imagem
        $imagePath = $this->handleImageUpload($request->file('game_picture'));

        $gameData = [
            "uuid" => Str::uuid(),
            "name" => $request->name,
            "description" => $request->description,
            "release_date" => $request->release_date,
            "developer" => $request->developer,
            "publisher" => $request->publisher,
            "game_picture" => $imagePath,
        ];

        Game::create($gameData);
        
        return redirect()->route('games.index')->with('status', __("Game Successfully Created"));
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
        $rules = $this->validationRules($game);
        $rules['game_picture'] = 'nullable|file|mimes:jpg,png,jpeg|max:10240';
        
        $request->validate($rules, $this->validationMessages());

        $updateData = $request->except('game_picture');

        // Se uma nova imagem foi enviada
        if ($request->hasFile('game_picture')) {
            // Remove a imagem antiga se existir
            $this->deleteImage($game->game_picture);
            
            // Faz upload da nova imagem
            $updateData['game_picture'] = $this->handleImageUpload($request->file('game_picture'));
        }

        $game->update($updateData);

        return redirect()->route("games.index")->with("status", __("The update has been sent successfully"));
    }

    public function destroy(Game $game)
    {
        // Remove a imagem associada
        $this->deleteImage($game->game_picture);
        
        $game->delete();

        return redirect()->route('games.index')->with('status', __("Game Successfully Deleted"));
    }

    /**
     * Handle image upload
     */
    private function handleImageUpload($imageFile)
    {
        $picturesDir = public_path('game_pictures');
        
        // Cria o diretório se não existir
        if (!file_exists($picturesDir)) {
            mkdir($picturesDir, 0777, true);
        }

        $extension = $imageFile->getClientOriginalExtension();
        $filename = 'game_' . time() . '_' . Str::slug($imageFile->getClientOriginalName());
        $imageFile->move($picturesDir, $filename);

        return 'game_pictures/' . $filename;
    }

    /**
     * Delete image file
     */
    private function deleteImage($imagePath)
    {
        if ($imagePath && file_exists(public_path($imagePath))) {
            unlink(public_path($imagePath));
        }
    }
}