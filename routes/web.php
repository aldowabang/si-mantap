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

         // profile admin
            Route::get('/profile',[AdminController::class, 'profile'])->name('profile-admin');
            Route::match(['post', 'put'], '/profile/update/{id}', [AdminController::class, 'updateProfile'])->name('update-profile-admin');
        // end profile admin
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

        // dokument
            Route::post('/konfirmasi-dokument-admin/{id}', [AdminController::class, 'konfirmasiDokumentAdmin'])->name('konfirmasi-dokument-admin');
            Route::post('/rejected-dokument-admin/{id}', [AdminController::class, 'rejectedDokumentAdmin'])->name('rejected-dokument-admin');
            Route::post('/konfirmasi-tahap-admin/{id}', [AdminController::class, 'konfirmasiTahapAdmin'])->name('konfirmasi-tahap-admin');
        // end dokument

            Route::get('/monitoring/cek/{id}',[AdminController::class, 'proyekMonitotingAdmin'])->name('proyek-monitoring-admin');
            Route::get('/monitoring/cekdoc/{id}',[AdminController::class, 'cekdoc'])->name('cek-doc');
    });
// end admin

    Route::middleware(['isTender'])->group(function () {
        // tender dashboard
        //tender
        Route::get('/tender',[TenderController::class, 'index'])->name('tender.index');
        route::get('/dashboard-tender',[TenderController::class, 'index'])->name('dashboard-tender');
        Route::get('/tender/proyek',[TenderController::class, 'ProyekTender'])->name('tender-proyek');
        Route::get('/tender/view/proyek/{id}',[TenderController::class, 'viewProyekTender'])->name('tender-view-proyek');
        Route::get('/tender/cekk/{id}',[TenderController::class, 'proyekMonitotingTender'])->name('proyek-monitoring-tender');
        Route::get('/tender/cekdoctender/{id}',[TenderController::class, 'cekDokumenTender'])->name('cek-doc-tender');
        //end tender
        // profile admin
        Route::get('/profile',[TenderController::class, 'profileTender'])->name('profile-tender');
        Route::match(['post', 'put'], '/profile/update/{id}', [TenderController::class, 'updateProfile'])->name('update-profile-tender');
    });

    Route::middleware(['isPengawas'])->group(function () {
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
                Route::get('/monitoring/view/{id}',[PengawasController::class, 'cekDokumenPengawas'])->name('cek-dokument-pengawas');
                Route::match(['post', 'put'], '/monitoring/edit-dokument-pengawas-rev/{id}', [PengawasController::class, 'editDokumentPengawasRev'])->name('edit-dokument-pengawas-rev');
            // end monitoring pengawas
            // dokument pengawas
                Route::get('/dokumen/okk/{id}', [PengawasController::class, 'addDokumentPengawas'])->name('add-dokument-pengawas');
                Route::post('/dokumen/store',[PengawasController::class, 'storeDokumentPengawas'])->name('store-dokument-pengawas');
                Route::get('/dokumen/edit/{id}', [PengawasController::class, 'editDokumentPengawas'])->name('edit-dokument-pengawas');
                Route::match(['post', 'put'], '/dokumen/update/{id}', [PengawasController::class, 'updateDokumentPengawas'])->name('update-dokument-pengawas');
                Route::DELETE('/dokumen/delete/{id}', [PengawasController::class, 'deleteDokumentPengawas'])->name('delete-dokument-pengawas');
                Route::post('/dokumen/konfirmasi/{id}', [PengawasController::class, 'konfirmasiDokument'])->name('konfirmasi-dokument');
                Route::post('/dokumen/konfirmasi-tahap-pengawas/{id}', [PengawasController::class, 'konfirmasiTahapPengawas'])->name('konfirmasi-tahap-pengawas');
                
            // end dokument pengawas

            // Tahap pengawas
                Route::get('/tahap/add/{id}', [PengawasController::class, 'addTahap'])->name('add-tahap');
                Route::post('/tahap/store', [PengawasController::class, 'storeTahap'])->name('store-tahap');
            // end tahap pengawas

            // laporan pengawas
                Route::get('/laporan/pdf/{id}', [PengawasController::class, 'laporanPdfPengawas'])->name('laporan-pdf-pengawas');
        //end pengawas
    });

});