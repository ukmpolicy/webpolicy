<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DivisionController;
use App\Http\Controllers\DocumentationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\OfficerController;
use App\Http\Controllers\ORController;
use App\Http\Controllers\SourceController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Maintenance Route
// Route::view('/{app}', 'maintenance')->where('app', '.*');

Route::get('/', [HomeController::class, 'index'])->name('main.home');

Route::get('/introduction', function() {
    return view('user.introduction');
})->name('main.introduction');

Route::get('/article', [HomeController::class, 'articles'])->name('main.articles');
Route::get('/article/{slug}', [HomeController::class, 'article'])->name('main.article');
Route::get('/documentation', [HomeController::class, 'documentation'])->name('main.documentations');

Route::prefix('open-recruitment')->group(function() {
    Route::get('/', [ORController::class, 'index'])->name('open-recruitment');
    Route::middleware('or')->group(function() {
        Route::post('/', [ORController::class, 'store'])->name('open-recruitment.store');
        Route::get('/form', [ORController::class, 'viewForm'])->name('open-recruitment.form');
        // Route::get('/success', [ORController::class, 'successPage'])->name('open-recruitment.success');
        Route::get('/download-proof/{nim}', [ORController::class, 'proof'])->name('open-recruitment.proof');
        Route::get('/check/{nim}', [ORController::class, 'check'])->name('open-recruitment.check');
    });
});



Route::prefix('manager')->group(function() {

    Route::get('/', function () {
        return view('admin.pages.dashboard.index');
    })->name('dashboard')->middleware('auth');
    
    Route::prefix('member')->middleware('auth')->group(function() {
        Route::get('/', [MemberController::class, 'index'])
        ->name('member');
    
        Route::get('/{id}/edit', [MemberController::class, 'edit'])
        ->name('member.edit');
    
        Route::post('/', [MemberController::class, 'store'])
        ->name('member.store');
    
        Route::delete('{id}', [MemberController::class, 'destroy'])
        ->name('member.delete');
    
        Route::put('/{id}', [MemberController::class, 'update'])
        ->name('member.update');

        // Open Recruitment
        Route::get('/or', [MemberController::class, 'orManager'])
        ->name('member.or');

        Route::post('/or/done/{id}', [MemberController::class, 'orDone'])
        ->name('member.or.done');

        Route::get('/or/download', [MemberController::class, 'downloadDataOR'])
        ->name('member.or.download');

    });
    
    Route::prefix('library')->middleware('auth')->group(function() {
        Route::get('/', [SourceController::class, 'index'])
        ->name('library');
    
        Route::delete('/{id}', [SourceController::class, 'destroy'])
        ->name('library.delete');
    });
    
    Route::prefix('documentation')->middleware('auth')->group(function() {
        Route::get('/', [DocumentationController::class, 'index'])
        ->name('documentation');
    
        Route::post('/event', [DocumentationController::class, 'storeEvent'])
        ->name('documentation.store.event');
    
        Route::delete('/{event_id}/{documenter_id}', [DocumentationController::class, 'destroyDocumenter'])
        ->name('documentation.destroy.documenter');
    
        Route::delete('/{event_id}', [DocumentationController::class, 'destroyEvent'])
        ->name('documentation.destroy.event');
    });
    
    Route::prefix('article')->middleware('auth')->group(function() {
        Route::get('/', [ArticleController::class, 'index'])
        ->name('article');
        
        Route::post('/', [ArticleController::class, 'store'])
        ->name('article.store');
        
        Route::get('/{id}/edit', [ArticleController::class, 'edit'])
        ->name('article.edit');
        
        Route::put('/{id}', [ArticleController::class, 'update'])
        ->name('article.update');
        
        Route::delete('/{id}', [ArticleController::class, 'destroy'])
        ->name('article.destroy');
        
        Route::post('/category', [ArticleController::class, 'storeCategory'])
        ->name('article.category.store');
    
        Route::delete('/category/{id}', [ArticleController::class, 'destroyCategory'])
        ->name('article.category.destroy');
    });
    
    Route::prefix('auth')->group(function() {
        Route::get('/login', [AuthController::class, 'loginView'])
        ->name('login');
    
        Route::post('/login', [AuthController::class, 'login'])
        ->name('login');
        
        Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');
    });
    
    Route::prefix('office')->group(function() {
       Route::get('/', [OfficerController::class, 'index'])
       ->name('office');
       Route::get('/create', [OfficerController::class, 'create'])
       ->name('office.create');
       Route::get('/{id}/edit', [OfficerController::class, 'edit'])
       ->name('office.edit');
       Route::post('/', [OfficerController::class, 'store'])
       ->name('office.store');
       Route::put('/{id}', [OfficerController::class, 'update'])
       ->name('office.update');
       Route::delete('/{id}', [OfficerController::class, 'destroy'])
       ->name('office.destroy');
    });
    
    Route::prefix('division')->group(function() {
        Route::get('/', [DivisionController::class, 'index'])
        ->name('division');
        Route::post('/', [DivisionController::class, 'store'])
        ->name('division.store');
        Route::get('/{id}/edit', [DivisionController::class, 'edit'])
        ->name('division.edit');
        Route::put('/{id}', [DivisionController::class, 'update'])
        ->name('division.update');
        Route::delete('/{id}', [DivisionController::class, 'destroy'])
        ->name('division.destroy');
        Route::post('/{division_id}/program', [DivisionController::class, 'storeProgram'])
        ->name('division.program.store');
        Route::put('/{division_id}/program/{program_id}', [DivisionController::class, 'updateProram'])
        ->name('division.program.update');
        Route::delete('/{division_id}/program/{program_id}', [DivisionController::class, 'destroyProgram'])
        ->name('division.program.destroy');
    });
    
    Route::prefix('user')->group(function() {
        Route::get('/', [UserController::class, 'index'])
        ->name('user');
        Route::post('/', [UserController::class, 'store'])
        ->name('user.store');
        Route::put('/{id}', [UserController::class, 'update'])
        ->name('user.update');
        Route::delete('/{id}', [UserController::class, 'destroy'])
        ->name('user.destroy');
    });
});

Route::get('summernote-image-upload', [PostController::class, 'index']);
Route::post('post-summernote-image-upload', [PostController::class, 'store']);