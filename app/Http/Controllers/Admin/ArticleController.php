<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use App\Models\Highligh;
use App\Models\Member;
use App\Models\Source;
use App\Models\User;
use App\Notifications\NewArticle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    public function index(Request $request) {
        $articles = $this->getArticles($request)->orderBy('id', 'DESC')->get();
        $page = 1;
        $perPage = 10;
        $maxPage = ceil($articles->count()/$perPage);

        if (is_numeric($request->page)) {
            $page = $request->page;
        }
        $data['categories'] = Category::where('type', 0)->get();
        $data['highlighs'] = Highligh::all();
        $data['articles'] =  $articles;
        $data['page'] = $page;
        $data['perPage'] = $perPage;
        $data['maxPage'] = $maxPage;

        if ($request->page) {
            $data['page'] = $request->page;
        }
        return view('admin.pages.article.index', $data);
    }

    public function migrateThumbnail() {
        $articles = Article::all();
        foreach ($articles as $article) {
            $source = Source::find($article->thumbnail);
            $article->thumbnail = $source->path;
            $article->save();
        }
    }
    
    public function getArticles(Request $request) {
        $articles = Article::select('articles.id', 'categories.name as category', 'title', 'is_public')
        ->join('categories', 'articles.category_id', '=', 'categories.id');

        if ($request->category) {
            $articles = $articles->where('category_id', $request->category);
        }

        if ($request->search) {
            $articles = $articles->where('title', 'like', '%'. $request->search . '%');
        }

        return $articles;
    }

    public function store(Request $request) {
        $this->validate($request, [
            "title" => "required|min:5",
            "category_id" => "required",
        ]);

        $article = new Article();
        $article->title = strtolower($request->title);
        $article->slug = Str::slug($request->title);
        // $article->creator_id = Auth::user()->id;
        $article->category_id = $request->category_id;
        $article->save();

        // Notification::sendNow(Member::all(), new NewArticle($article));

        return redirect()->route('article.edit', ['id' => $article->id])->with('success', 'Artikel berhasil dibuat');
    }

    public function destroy($id) {
        $article = Article::find($id);
        if ($article) {
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
            "content" => "required",
            "category_id" => "required",
        ]);
        $article = Article::find($id);
        if ($article) {
            $filename = $article->thumbnail;

            // dd($request->file('thumbnail'));
            if (($file = $request->file('thumbnail'))) {
                $filename = time().rand(0,99999).'.'.$file->getClientOriginalExtension();
                $dir = 'uploads/';
                $file->move($dir, $filename);
            }
            $article->title = strtolower($request->title);
            $article->slug = Str::slug($request->title);
            $article->thumbnail = $filename;
            $article->content = $this->getContent($request->content);
            $article->category_id = $request->category_id;
            $article->save();
            return redirect()->route('article.edit', ['id' => $article->id])->with('success', 'Perubahan berhasil disimpan');
        }
        return redirect()->route('article.edit', ['id' => $article->id])->with('failed', 'Perubahan gagal disimpan');
    }

    public function switchStatus($id) {
        $article = Article::find($id);
        if ($article) {
            $article->is_public = ($article->is_public) ? false : true;
            $article->save();
            return redirect()->route('article.edit', ['id' => $article->id])->with('success', 'Perubahan berhasil disimpan');
        }
        return redirect()->route('article.edit', ['id' => $article->id])->with('failed', 'Perubahan gagal disimpan');
    }

    public function getContent($description) {
        $dom = new \DomDocument();

        // dd($description);
 
        libxml_use_internal_errors(true);
        $dom->loadHtml($description, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);    
  
        $images = $dom->getElementsByTagName('img');

        foreach($images as $k => $img){
 
 
            $data = $img->getAttribute('src');
            
            $ex = explode('/', $data);
            $dir = "/uploads/";

            $domain = explode(':', request()->getHttpHost());
            if (in_array(strtolower($domain[0]), ['localhost', '127.0.0.1'])) {
                $public_path = "/public/";
            }else {
                $public_path = "/../public_html/";
            }
            // if (!file_exists(base_path() . "/../public_html".$dir.end($ex))) {
            if (!file_exists(base_path() . $public_path . $dir.end($ex))) {
                list($type, $data) = explode(';', $data);
    
      
                list(, $data)      = explode(',', $data);
      
                $data = base64_decode($data);
      
                $filename = time().rand(0,99999).'.png';
      
                $path = base_path() . $public_path . $dir . $filename;
      
                file_put_contents($path, $data);
      
                $img->removeAttribute('src');
      
                $img->setAttribute('src', $dir.$filename);
            }
  
         }
  
  
        return $dom->saveHTML();
    }

    public function storeCategory(Request $request) {
        $this->validate($request, [
            "name" => "required",
        ]);
        $category = new Category();
        $category->name = strtolower($request->name);
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


    public function viewArticle($slug) {
        $user = User::find(Auth::user()->id);
        if (!$user->hasPermission('admin.article')) {
            return redirect()->back();
        }
        $data = Article::where('slug', $slug)->first();
        if ($data) {
            $data = $data->toArray();
            $data['category'] = Category::find($data['category_id']);
            $bulan = [
                'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
            ];
            $time = strtotime($data['created_at']);
            $hari = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
            $bulan = $bulan[(int)date('m', $time) - 1];
            $hari = $hari[(int)date('N', $time)-1];
            // dd($hari);
            $data['created_at'] = $hari.date(', d ', $time) . $bulan. date(' Y H:i', $time);
            return view('guest.pages.article.article', $data);
        }
        return redirect()->route('main.articles');
    }
}
