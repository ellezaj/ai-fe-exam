<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Article;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return inertia('Article/AllMedia', ['articles' => Article::with(['company', 'editor', 'writer'])->paginate(10)]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia('Article/CreateArticle', ['companies' => Company::where(['status' => 1])->get()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $fields = $request->validate([
            'company' => ['required'],
            'title' => ['required'],
            'link' => ['required'],
            'date' => ['required'],
            'content' => ['required'],
            'image' => ['required','file','max:3000','mimes:png,jpg,jpeg'],
        ]);

        $path = "";
        if($request->hasFile('image')){
            $file = $request->file('image');
            $filename = $file->hashName();
            $path = Storage::disk('public')->putFileAs(
                'images', $request->file('image'), $filename
            );
        }

        $userId = Auth::id();
        $fields['date'] =  Carbon::parse($request->date)->format('Y-m-d');
        $fields['image'] = $path;
        $fields['status'] = 2; // For Edit
        $fields['writer'] = $userId;
        $fields['editor'] = $userId;

        $company = Article::create($fields);
        return redirect()->intended('dashboard');
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        return inertia('Article/ViewArticle', ['article' => $article, 'companies' => Company::where(['status' => 1])->get()]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        return inertia('Article/EditArticle', ['article' => $article, 'companies' => Company::where(['status' => 1])->get()]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Article $article)
    {
        $fields = $request->validate([
            'company' => ['required'],
            'title' => ['required'],
            'link' => ['required', 'url'],
            'date' => ['required'],
            'content' => ['required'],
            'status' => ['required'],
        ]);

        $path = $article->image;
        if($request->hasFile('image')){
            $fields['image'] = $request->validate([
                'image' => ['required','file','max:3000','mimes:png,jpg,jpeg'],
            ]);

            $file = $request->file('image');
            $filename = $file->hashName();
            $path = Storage::disk('public')->putFileAs(
                'images', $request->file('image'), $filename
            );

            $fields['image'] = $path;
        }

        $userId = Auth::id();
        $fields['date'] =  Carbon::parse($request->date)->format('Y-m-d');
        $fields['editor'] = $userId;

        $article->update($fields);
        return redirect()->intended('dashboard');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        $article->delete();
        return redirect()->intended('article');
    }
}
