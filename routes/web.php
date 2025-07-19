<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use Illuminate\Container\Attributes\Auth;
use App\Http\Controllers\TenderController;
use App\Http\Controllers\PengawasController;


Route::get('/', [AuthController::class, 'index'])->name('utama');

route::get('/login',[AuthController::class, 'login'])->name('login')->middleware('guest');
route::post('/login',[AuthController::class, 'authenticate'])->name('authenticate');
route::post('/logout',[AuthController::class, 'logout'])->name('logout');
Route::post('/register',[AuthController::class, 'register'])->name('register');

Route::middleware(['checkLogin'])->group(function () {
//admin
    Route::middleware(['isAdmin'])->group(function () {
        // admin dashboard
        Route::get('/dashboard-admin',[AdminController::class, 'index'])->name('dashboard-admin');
        // user management
            Route::get('/users',[AdminController::class, 'show'])->name('admin-show');
            Route::post('/admin-users-activate/{id}',[AdminController::class, 'activeUser'])->name('admin-users-activate');
            Route::get('/add-users',[AdminController::class, 'add'])->name('admin-add');
            Route::post('/users/store',[AdminController::class, 'store'])->name('admin-store');
            Route::get('/users/edit/{id}',[AdminController::class, 'edit'])->name('admin-edit');
            Route::match(['post', 'put'], '/users/update/{id}', [AdminController::class, 'update'])->name('admin-update');
            Route::get('/users/view/{id}',[AdminController::class, 'view'])->name('admin-view');
        // end user management

        // proyek
            Route::get('/proyek/add',[AdminController::class, 'addProyek'])->name('admin-add-proyek');
            Route::post('/proyek/store',[AdminController::class, 'storeProyek'])->name('admin-store-proyek');
            Route::get('/proyek/edit/{id}',[AdminController::class, 'editProyek'])->name('admin-edit-proyek');
            Route::match(['post', 'put'], '/proyek/update/{id}', [AdminController::class, 'updateProyek'])->name('admin-update-proyek');
            Route::get('/proyek/view/{id}',[AdminController::class, 'viewProyek'])->name('admin-view-proyek');
            Route::get('/proyek',[AdminController::class, 'proyek'])->name('admin-proyek');
            Route::DELETE('/proyek/delete/{id}',[AdminController::class, 'deleteProyek'])->name('admin-delete-proyek');
        // end proyek
    });
// end admin

    //tender
    Route::get('/tender',[TenderController::class, 'index'])->name('tender.index');
    route::get('/dashboard-tender',[TenderController::class, 'index'])->name('dashboard-tender');
    //end tender
    
//pengawas
    Route::get('/pengawas',[PengawasController::class, 'index'])->name('pengawas-index');
    route::get('/dashboard-pengawas',[PengawasController::class, 'index'])->name('dashboard-pengawas');
    //proyek pengawas
        Route::get('/pengawas/proyek',[PengawasController::class, 'proyekPengawas'])->name('pengawas-proyek');
        Route::get('/pengawas/view/proyek/{id}',[PengawasController::class, 'viewProyek'])->name('pengawas-view-proyek');
    // end proyek pengawas
    // monitoring pengawas
        route::get('/monitoring/add/{id}',[PengawasController::class, 'addMonitoring'])->name('add-monitoring');
        Route::get('/monitoring/cekk/{id}',[PengawasController::class, 'proyekMonitotingPengawas'])->name('proyek-monitoring-pengawas');
        Route::post('/monitoring/store',[PengawasController::class, 'storeMonitoring'])->name('store-monitoring');
    // end monitoring pengawas
//end pengawas


    // proyek management
        

        //monitoring management
        Route::get('/monitoring/cek/{id}',[AdminController::class, 'proyekMonitotingAdmin'])->name('proyek-monitoring-admin');
        Route::get('/monitoring/cekdoc/{id}',[AdminController::class, 'cekdoc'])->name('cek-doc');
        
    

    // end proyek management
    //end admin
});