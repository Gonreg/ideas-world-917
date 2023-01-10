<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use App\Models\Ideas;
use App\Models\IdeasCategories;

class UserController extends Controller
{
    public function showIdeas(): Factory|View|Application
    {
        return view('index', [
            'ideas' => Ideas::all(),
            'categories' => IdeasCategories::where('status', 'Включена')->get()
        ]);
    }

    public function addIdea(Request $request)
    {
        $path = '';
        if ($request->file) {
            $path = $request->file('file')->store('public');
            $path = explode('/', $path);
            unset($path[0]);
            $path = implode($path);
            $path = 'storage/' . $path;
        }
        $category = IdeasCategories::find($request->id);
        $idea = $category->ideas()->create([
            'author' => $request->name,
            'title' => $request->title,
            'status' => 'Новая',
            'description' => $request->description,
            'likes' => 0,
            'file' => $path,
        ]);
    }

    public function addLike(Request $request)
    {
        $idea = Ideas::find($request->id);
        $idea->likes += $request->like;
        $idea->save();
    }
}
