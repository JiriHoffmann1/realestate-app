<?php

use App\Http\Controllers\ProfileController;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Backend\PropertyTypeController;
use App\Http\Controllers\Backend\PropertyController;
use App\Http\Middleware\RedirectIfAuthenticated;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', [UserController::class, 'index']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/user/profile', [UserController::class, 'userProfile'])->name('user.profile');
    Route::post('/user/profile/store', [UserController::class, 'userProfileStore'])->name('user.profile.store');
    Route::get('/user/logout', [UserController::class, 'userLogout'])->name('user.logout');
    Route::get('/user/change/password', [UserController::class, 'userChangePassword'])->name('user.change.password');
    Route::post('/user/password/update', [UserController::class, 'userPasswordUpdate'])->name('user.password.update');

});

require __DIR__.'/auth.php';


Route::middleware(['auth', 'role:admin'])->group(function() {
    Route::get('/admin/dashboard', [AdminController::class, 'adminDashboard'])->name('admin.dashboard');
    Route::get('/admin/profile', [AdminController::class, 'adminProfile'])->name('admin.profile');
    Route::get('/admin/logout', [AdminController::class, 'adminLogout'])->name('admin.logout');
    Route::post('/admin/profile/store', [AdminController::class, 'adminProfileStore'])->name('admin.profile.store');
    Route::get('admin/change/password', [AdminController::class, 'adminChangePassword'])->name('admin.change.password');
    Route::post('/admin/update/password', [AdminController::class, 'adminUpdatePassword'])->name('admin.update.password');

});



Route::middleware(['auth', 'role:agent'])->group(function() {
    Route::get('/agent/dashboard', [AgentController::class, 'agentDashboard'])->name('agent.dashboard');
});

Route::get('/admin/login', [AdminController::class, 'adminLogin'])->name('admin.login')->middleware(RedirectIfAuthenticated::class);


Route::middleware(['auth', 'role:admin'])->group(function() {

    Route::controller(PropertyTypeController::class)->group(function () {
        Route::get('/all/type', 'allType')->name('all.type');
        Route::get('/add/type', 'addType')->name('add.type');
        Route::post('/store/type', 'storeType')->name('store.type');
        Route::get('/edit/type/{id}', 'editType')->name('edit.type');
        Route::post('/update/type', 'updateType')->name('update.type');
        Route::get('/delete/type/{id}', 'deleteType')->name('delete.type');
    });

    Route::controller(PropertyTypeController::class)->group(function () {
        Route::get('/all/amenities', 'allAmenity')->name('all.amenities');
        Route::get('/add/amenity', 'addAmenity')->name('add.amenity');
        Route::post('/store/amenity', 'storeAmenity')->name('store.amenity');
        Route::get('/edit/amenity/{id}', 'editAmenity')->name('edit.amenity');
        Route::post('/update/amenity', 'updateAmenity')->name('update.amenity');
        Route::get('/delete/amenity/{id}', 'deleteAmenity')->name('delete.amenity');
    });
    Route::controller(PropertyController::class)->group(function () {
        Route::get('/all/properties', 'allProperties')->name('all.properties');
        Route::get('/add/property', 'addProperty')->name('add.property');
        Route::post('/store/property', 'storeProperty')->name('store.property');
        Route::get('/edit/property/{id}', 'editProperty')->name('edit.property');
        Route::post('/update/property', 'updateProperty')->name('update.property');
        Route::post('/update/property/thumbnail', 'updatePropertyThumbnail')->name('update.property.thumbnail');
        Route::post('/update/property/multiImg', 'updatePropertyMultiImg')->name('update.property.multiImg');
        Route::get('/property/multiImg/delete/{id}', 'propertyMultiImgDelete')->name('property.multiImg.delete');
        Route::post('/store/new/multiImg', 'storeNewMultiImg')->name('store.new.multiImg');
        Route::post('/update/property/facilities', 'updatePropertyFacilities')->name('update.property.facilities');
        Route::get('/delete/property/{id}', 'deleteProperty')->name('delete.property');
        Route::get('/details/property/{id}', 'detailsProperty')->name('details.property');
        Route::post('/deactivate/property', 'deactivateProperty')->name('deactivate.property');
        Route::post('/activate/property', 'activateProperty')->name('activate.property');


    });


});
