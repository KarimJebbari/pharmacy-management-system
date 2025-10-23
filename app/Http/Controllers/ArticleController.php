<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::latest()->paginate(5); 
        return view('articles.index', compact('articles'));
    }

    public function show($id)
    {
        $article = Article::findOrFail($id);
        return view('articles.show', compact('article'));
    }
    

    public function create()
    {
        return view('articles.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'image' => 'nullable|image|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('articles', 'public');
        }

        Article::create([
            'title' => $request->title,
            'content' => $request->content,
            'image' => $imagePath,
        ]);

        return redirect()->route('articles.index')->with('success', 'L’article a été ajouté avec succès !');
    }
public function createOrEdit($id = null)
{
    $article = $id ? Article::findOrFail($id) : null;
    return view('articles.create', compact('article'));
}
public function destroy($id)
{
    $article = Article::findOrFail($id);

    if ($article->image) {
        Storage::delete('public/' . $article->image);
    }

    $article->delete();

    return redirect()->route('articles.create')->with('success', 'L’article a été supprimé avec succès !');
}
public function edit($id)
{
    $article = Article::findOrFail($id);
    return view('articles.edit', compact('article'));
}

public function update(Request $request, $id)
{
    $article = Article::findOrFail($id);

    $request->validate([
        'title' => 'required|string|max:255',
        'content' => 'required',
        'image' => 'nullable|image|max:2048',
    ]);

    if ($request->hasFile('image')) {
       
        if ($article->image) {
            Storage::delete('public/' . $article->image);
        }
        $article->image = $request->file('image')->store('articles', 'public');
    }

    $article->update([
        'title' => $request->title,
        'content' => $request->content,
        'image' => $article->image,
    ]);

    return redirect()->route('articles.create', ['article' => $article->id])
                     ->with('success', 'L’article a été mis à jour avec succès !');
}
public function showPharmacyPage()
{
    $articles = Article::latest()->paginate(6);
    return view('pharmacy', compact('articles'));
}

 
}

