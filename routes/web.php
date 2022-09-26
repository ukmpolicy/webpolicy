<?php

use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DivisionController;
use App\Http\Controllers\Admin\DocumentationController;
use App\Http\Controllers\Guest\GuestController;
use App\Http\Controllers\Admin\HighlighController;
use App\Http\Controllers\Admin\MailController;
use App\Http\Controllers\Admin\MemberController;
use App\Http\Controllers\Admin\OfficerController;
use App\Http\Controllers\Admin\ORController;
use App\Http\Controllers\Admin\SourceController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Guest\FormController;
use App\Http\Controllers\Guest\OpenRecruitmentController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// OLD

Route::middleware('sm')->group(function() {

    Route::get('/', [GuestController::class, 'index'])->name('main.home');
    
    Route::get('/introduction', function() {
        return view('user.introduction');
    })->name('main.introduction');
    
    Route::get('/article', [GuestController::class, 'articles'])->name('main.articles');
    Route::get('/article/{slug}', [GuestController::class, 'article'])->name('main.article');
    Route::get('/documentation', [GuestController::class, 'documentation'])->name('main.documentations');
    Route::get('/division/{division}', [GuestController::class, 'detailDivision'])->name('main.division');
    
    Route::prefix('open-recruitment')->group(function() {
        Route::get('/', [OpenRecruitmentController::class, 'index'])->name('open-recruitment.index');
    
        Route::prefix('/')->middleware('auth')->group(function() {
            Route::post('/save', [OpenRecruitmentController::class, 'save'])->name('open-recruitment.save');
            Route::get('/form', [OpenRecruitmentController::class, 'form'])->name('open-recruitment.form');
        });
    });
    
    // Route::prefix('open-recruitment')->group(function() {
    //     Route::get('/', [ORController::class, 'index'])->name('open-recruitment');
    //     Route::middleware('or')->group(function() {
            // Route::post('/', [ORController::class, 'store'])->name('open-recruitment.store');
    //         Route::get('/form', [ORController::class, 'viewForm'])->name('open-recruitment.form');
    //         // Route::get('/success', [ORController::class, 'successPage'])->name('open-recruitment.success');
    //         Route::get('/download-proof/{nim}', [ORController::class, 'proof'])->name('open-recruitment.proof');
    //         Route::get('/check/{nim}', [ORController::class, 'check'])->name('open-recruitment.check');
    //     });
    // });
    
    Route::prefix('manager')->middleware('pm')->group(function() {
    
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');
        
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
    
        });
    
        Route::prefix('open-recruitment')->middleware('auth')->group(function() {
    
            Route::get('/', [OpenRecruitmentController::class, 'manager'])->name('open-recruitment.admin.index');
            Route::get('/download', [OpenRecruitmentController::class, 'download'])->name('open-recruitment.admin.download');
            Route::get('/setting', [OpenRecruitmentController::class, 'viewSettings'])->name('open-recruitment.admin.setting');
            Route::post('/setting/save', [OpenRecruitmentController::class, 'saveSettings'])->name('open-recruitment.admin.setting.save');
    
            // Route::get('/', [ORController::class, 'orManager'])
            // ->name('member.or');
    
            // Route::get('/settings', [ORController::class, 'viewSettings'])
            // ->name('member.or.settings');
            
            // Route::post('/settings/save', [ORController::class, 'saveSettings'])
            // ->name('member.or.settings.save');
    
            // Route::post('/done/{id}', [ORController::class, 'orDone'])
            // ->name('member.or.done');
    
            // Route::get('/download', [ORController::class, 'downloadDataOR'])
            // ->name('member.or.download');
            
            // Route::post('/reset', [ORController::class, 'reset'])
            // ->name('member.or.reset');
        });
        
        Route::prefix('library')->middleware('auth')->group(function() {
            Route::get('/', [SourceController::class, 'index'])
            ->name('library');
        
            Route::delete('/{id}', [SourceController::class, 'destroy'])
            ->name('library.delete');
        });
        
        Route::resource('highligh', HighlighController::class)->middleware('auth')
        ->name('index', 'highligh')
        ->name('store', 'highligh.store')
        ->name('destroy', 'highligh.destroy')
        ->name('update', 'highligh.update');
        
        Route::prefix('documentation')->middleware('auth')->group(function() {
            Route::get('/', [DocumentationController::class, 'index'])
            ->name('documentation');
        
            Route::post('/event', [DocumentationController::class, 'storeEvent'])
            ->name('documentation.store.event');
            
            Route::post('/video', [DocumentationController::class, 'storeVideo'])
            ->name('documentation.store.video');
        
            Route::delete('/{event_id}/{documenter_id}', [DocumentationController::class, 'destroyDocumenter'])
            ->name('documentation.destroy.documenter');
        
            Route::delete('/{event_id}', [DocumentationController::class, 'destroyEvent'])
            ->name('documentation.destroy.event');
    
            Route::put('/rename/{event_id}/{document_id}', [DocumentationController::class, 'renameDocument'])
            ->name('documentation.rename.document');
    
            Route::put('/rename/{event_id}', [DocumentationController::class, 'renameEvent'])
            ->name('documentation.rename.event');
        });
        
        Route::prefix('mail')->middleware('auth')->group(function() {
            Route::get('/', [MailController::class, 'index'])
            ->name('mail');
    
            Route::post('/', [MailController::class, 'store'])
            ->name('mail.store');
            
            Route::post('/reply/{id}', [MailController::class, 'reply'])
            ->name('mail.reply');
            
            Route::get('/show/{id}', [MailController::class, 'show'])
            ->name('mail.detail');
            
            Route::delete('/{id}', [MailController::class, 'destroy'])
            ->name('mail.destroy');
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
            ->name('login.view');
        
            Route::post('/login', [AuthController::class, 'login'])
            ->name('login');
            
            Route::get('/register', [AuthController::class, 'registerView'])
            ->name('register.view');
        
            Route::post('/register', [AuthController::class, 'register'])
            ->name('register');
            
            Route::post('/logout', [AuthController::class, 'logout'])
            ->name('logout');
        });
        
        Route::prefix('officer')->group(function() {
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
            Route::put('/{division_id}/program/{program_id}', [DivisionController::class, 'updateProgram'])
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
    
        Route::prefix('role')->group(function() {
            Route::get('/', [RoleController::class, 'index'])->name('role');
            Route::post('/', [RoleController::class, 'store'])->name('role.store');
            Route::post('/add_access/{id}', [RoleController::class, 'addAccess'])->name('role.add_access');
            Route::put('/{id}', [RoleController::class, 'update'])->name('role.update');
            Route::delete('/{id}', [RoleController::class, 'destroy'])->name('role.destroy');
        });
    });
    
    Route::prefix("source")->group(function() {
        Route::post('/video', [SourceController::class, 'storeVideo'])
        ->name('source.store.video');
    });
    
    Route::get('summernote-image-upload', [PostController::class, 'index']);
    Route::post('post-summernote-image-upload', [PostController::class, 'store']);
    
    // Route::get('/home', [App\Http\Controllers\Guest\GuestController::class, 'index'])->name('home');
    
    // NOW
    
    Auth::routes();
    
    Route::get('/home', [App\Http\Controllers\Guest\GuestController::class, 'index'])->name('home');
});