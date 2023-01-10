<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use App\Models\Ideas;
use App\Models\IdeasCategories;

class AdminController extends Controller
{

    public function ideasList(): Factory|View|Application
    {
        return view('admin.ideasList', ['ideas' => Ideas::all(), 'categories' => IdeasCategories::all()]);
    }

    public function categoriesList(): Factory|View|Application
    {
        $categories = [];
        foreach (IdeasCategories::all() as $category) {
            $categories[$category->id] = [
                'id' => $category->id,
                'title' => $category->title,
                'description' => $category->description,
                'likes' => 0,
                'status' => $category->status,
                'ideas' => 0
            ];
            foreach (Ideas::all() as $idea) {
                if ($idea->ideas_categories_id == $category->id) {
                    $categories[$category->id]['likes'] += $idea->likes;
                    $categories[$category->id]['ideas'] ++;
                }
            }
        }
        return view('admin.categoriesList', ['categories' => $categories]);
    }

    public function addNewIdea()
    {
        return view('admin.addNewIdea', ['categories' => IdeasCategories::all()]);
    }

    public function saveNewCategory(Request $request)
    {
        $path = '';
        if ($request->file) {
            $path = $request->file('file')->store('public');
            $path = explode('/', $path);
            unset($path[0]);
            $path = implode($path);
            $path = 'storage/' . $path;
        }
        IdeasCategories::create([
            'title' => $request->title,
            'description' => $request->description,
            'file' => $path,
        ]);
        return redirect('/admin/categories-list');
    }
    public function saveNewIdea(Request $request)
    {
        $path = '';
        $category = IdeasCategories::find($request->category_id);
        $idea = $category->ideas()->create([
            'author' => $request->author,
            'title' => $request->title,
            'status' => $request->status,
            'description' => $request->description,
            'likes' => 0,
            'file' => $path,
        ]);
        return redirect('/admin/ideas-list');
    }
    public function deleteIdea(Request $request)
    {
        $idea = Ideas::find($request->id);
        $idea->delete();

        return redirect('/admin/ideas-list');
    }

    public function deleteCategory(Request $request)
    {
        $idea = IdeasCategories::find($request->id);
        $idea->delete();

        return redirect('/admin/categories-list');
    }

    public function updateIdea(Request $request)
    {
        $data = Ideas::find($request->id);
        $idea = [
            'id' => $data->id,
            'author' => $data->author,
            'title' => $data->title,
            'description' => $data->description,
            'status' => $data->status,
            'category' => IdeasCategories::find($data->ideas_categories_id)->title,
            'categoryId' => $data->ideas_categories_id
        ];
        return view('admin.addNewIdea', [
            'idea' => $idea,
            'categories' => IdeasCategories::all()
        ]);
    }

    public function saveUpdatedIdea(Request $request)
    {
        $idea = Ideas::find($request->idea_id);

        $idea->author = $request->author;
        $idea->ideas_categories_id = $request->category_id;
        $idea->title = $request->title;
        $idea->description = $request->description;
        $idea->status = $request->status;

        $idea->save();

        return redirect('/admin/ideas-list');
    }

    public function updateCategory(Request $request)
    {
        $data = IdeasCategories::find($request->id);
        $category = [
            'id' => $data->id,
            'title' => $data->title,
            'description' => $data->description,
            'status' => $data->status,
            'file' => $data->file
        ];
        return view('admin.addNewCategory', [
            'category' => $category,
        ]);
    }

    public function saveUpdatedCategory(Request $request)
    {
        $category = IdeasCategories::find($request->category_id);

        $category->title = $request->title;
        $category->description = $request->description;
        $category->status = $request->category_status;
        if ($request->file) {
            $path = $request->file('file')->store('public');
            $path = explode('/', $path);
            unset($path[0]);
            $path = implode($path);
            $path = 'storage/' . $path;
            $category->file = $path;
        }
        $category->save();

        return redirect('/admin/categories-list');
    }
}
