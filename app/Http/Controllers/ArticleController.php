<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\Source;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    public function index(Request $request) {
        $data['categories'] = Category::where('type', 0)->get();
        $data['articles'] =  $this->getArticles($request);
        $data['page'] = 1;
        $data['perPage'] = 1;
        return view('admin.pages.article.index', $data);
    }

    
    public function getArticles(Request $request) {
        $articles = Article::where('creator_id', Auth::user()->id)
        ->select('articles.id', 'categories.name as category', 'users.username as creator', 'title')
        ->join('categories', 'articles.category_id', '=', 'categories.id')
        ->join('users', 'articles.creator_id', '=', 'users.id');

        if ($request->category) {
            $articles = $articles->where('category_id', $request->category);
        }

        if ($request->search) {
            $articles = $articles->where('title', 'like', '%'. $request->search . '%');
        }

        return $articles->get();
    }

    public function store(Request $request) {
        $this->validate($request, [
            "title" => "required|min:5",
            "category_id" => "required",
        ]);

        $article = new Article();
        $article->title = strtolower($request->title);
        $article->slug = Str::slug($request->title);
        $article->creator_id = Auth::user()->id;
        $article->category_id = $request->category_id;
        $article->save();

        return redirect()->route('article.edit', ['id' => $article->id])->with('success', 'Artikel berhasil dibuat');
    }

    public function destroy($id) {
        $article = Article::find($id);
        if ($article) {
            $temp = $article;
            $article->delete();
            return redirect()->route('article')->with('success', 'Artikel berhasil dihapus');
        }
        return redirect()->route('article')->with('failed', 'Artikel gagal dihapus');
    }

    public function edit($id) {
        $article = Article::find($id);
        if ($article) {
            $data['image'] = Source::find($article->thumbnail);
            $data['categories'] = Category::where('type', 0)->get();
            $data['article'] = $article;
            return view('admin.pages.article.edit', $data);
        }
        return redirect()->route('article');
    }

    public function update(Request $request, $id) {
        $this->validate($request, [
            "title" => "required|min:5",
            "thumbnail" => "required|exists:sources,id",
            "content" => "required",
            "category_id" => "required",
        ]);
        $article = Article::find($id);
        if ($article) {
            $article->title = strtolower($request->title);
            $article->thumbnail = $request->thumbnail;
            $article->content = $this->getContent($request->content);
            $article->category_id = $request->category_id;
            $article->save();
            return redirect()->route('article.edit', ['id' => $article->id])->with('success', 'Perubahan berhasil disimpan');
        }
        return redirect()->route('article.edit', ['id' => $article->id])->with('failed', 'Perubahan gagal disimpan');
    }

    public function getContent($description) {
        $dom = new \DomDocument();
 
        $dom->loadHtml($description, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);    
  
        $images = $dom->getElementsByTagName('img');

        foreach($images as $k => $img){
 
 
            $data = $img->getAttribute('src');
  
            list($type, $data) = explode(';', $data);
  
            list(, $data)      = explode(',', $data);
  
            $data = base64_decode($data);
  
            $filename = time().rand(0,99999).'.png';
            $dir= "/uploads/library/";
  
            $path = public_path() . $dir . $filename;
  
            file_put_contents($path, $data);
            
            $source = new Source();
            $source->path = $filename;
            $source->description = $filename;
            $source->author_id = Auth::user()->id;
            $source->type = 0;
            $source->save();
  
            $img->removeAttribute('src');
  
            $img->setAttribute('src', $dir.$filename);
  
         }
  
  
        return $dom->saveHTML();
    }

    public function storeCategory(Request $request) {
        $this->validate($request, [
            "name" => "required",
        ]);
        $category = new Category();
        $category->name = $request->name;
        $category->type = 0;
        $category->save();

        return redirect()->route('article')->with('success', 'Kategori berhasil ditambahkan');
    }

    public function destroyCategory($id) {
        $category = Category::find($id);
        if ($category) {
            $category->delete();
            return redirect()->route('article')->with('success', 'Kategori berhasil dihapus');
        }
        return redirect()->route('article')->with('success', 'Kategori gagal dihapus');
    }
}
