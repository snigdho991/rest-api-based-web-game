<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Cms\RoleController;
use App\Http\Controllers\Ums\AdminToolsController;
use App\Http\Controllers\Cms\ThemeController;
use App\Http\Controllers\Ums\FamilyAdminToolsController;
use App\Http\Controllers\Ums\UserToolsController;
use App\Http\Controllers\Cms\IndexController;
use App\Http\Controllers\Ums\ProfileController;



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

Route::get('/apps/all-clear', function() {
    Artisan::call('optimize:clear');
});

Route::middleware(['guest'])->get('/', function () {
    return view('auth.login');
});

Route::middleware(['guest'])->get('/register', function () {
    abort(403);
})->name('register');

// Route::get('/generate-role', [RoleController::class, 'generate_role'])->name('generate.role');

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
	Route::post('/save-theme', [ThemeController::class, 'select_theme'])->name('select.theme');
	Route::get('/dashboard-index-api', [IndexController::class, 'dashboard_index_api'])->name('dashboard.index.api');

	Route::post('/user/save/basic-info', [ProfileController::class, 'save_basic_info'])->name('save.basic.info');
	Route::post('/user/save/change-password', [ProfileController::class, 'change_auth_password'])->name('change.auth.password');
		
	Route::group(['prefix' => 'administrator'], function(){
		Route::get('/dashboard', [AdminToolsController::class, 'dashboard'])->name('dashboard');
		Route::get('/all-families', [AdminToolsController::class, 'all_families'])->name('all.families');
		Route::get('/users-by-family/{family}', [AdminToolsController::class, 'users_by_family'])->name('users.by.family');
		Route::post('/family/save-local-admin', [AdminToolsController::class, 'store_local_admin'])->name('store.local.admin');
		Route::delete('/family/destroy-local-admin/{id}', [AdminToolsController::class, 'destroy_local_admin'])->name('destroy.local.admin');

		Route::get('/api-url', [AdminToolsController::class, 'api_url'])->name('api.url');
		Route::post('/update-api-url', [AdminToolsController::class, 'update_api_url'])->name('update.api.url');
	});

	Route::group(['prefix' => 'family-admin'], function(){
		Route::get('/dashboard', [FamilyAdminToolsController::class, 'family_admin_dashboard'])->name('family.admin.dashboard');
		Route::get('/my-family/{family}', [FamilyAdminToolsController::class, 'my_family'])->name('my.family');

		Route::post('/save/shooter-one', [FamilyAdminToolsController::class, 'shooter_one'])->name('shooter.one');
		Route::post('/delete/shooter-one/{shooter_one}', [FamilyAdminToolsController::class, 'delete_shooter_one'])->name('delete.shooter.one');

		Route::post('/save/shooter-two', [FamilyAdminToolsController::class, 'shooter_two'])->name('shooter.two');
		Route::post('/delete/shooter-two/{shooter_two}', [FamilyAdminToolsController::class, 'delete_shooter_two'])->name('delete.shooter.two');

		Route::post('/save/shooter-three', [FamilyAdminToolsController::class, 'shooter_three'])->name('shooter.three');
		Route::post('/delete/shooter-three/{shooter_three}', [FamilyAdminToolsController::class, 'delete_shooter_three'])->name('delete.shooter.three');
		Route::post('/family/save-user', [FamilyAdminToolsController::class, 'store_user'])->name('store.user');
		Route::post('/delete/player/{id}', [FamilyAdminToolsController::class, 'delete_player'])->name('delete.player');
	});

	Route::group(['prefix' => 'user'], function(){
		Route::get('/dashboard', [UserToolsController::class, 'user_dashboard'])->name('user.dashboard');
		Route::get('/{family}/{player}', [UserToolsController::class, 'user_details'])->name('user.details');
		Route::post('/save/found', [UserToolsController::class, 'save_found'])->name('submit.found');
		Route::post('/delete/found/{player}', [UserToolsController::class, 'delete_found'])->name('delete.found');

		Route::post('/save/comment', [UserToolsController::class, 'save_comment'])->name('submit.comment');
		Route::post('/delete/comment/{player}', [UserToolsController::class, 'delete_comment'])->name('delete.comment');
	});

});
