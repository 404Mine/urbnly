<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Storepage;
use App\Livewire\ProductsPage;
use App\Livewire\CartItemsPage;
use App\Livewire\CheckOut;
use App\Livewire\SuccessPage;
use App\Livewire\CustomerProfile;
use App\Livewire\StoreProfilePage;

use Filament\Http\Controllers;
use Filament\Http\Controllers\FilamentController;

Route::get('/default', function () {
    return view('welcome');
});

Route::get('/', function () {
    return view('ui.index');
});

Route::get('/Contacts', function () {
    return view('ui.contacts');
});

Route::get('/Error', function () {
    return view('errors.401');
});

Route::get('/Online-Store', Storepage::class);

Route::get('/Cart-Items', CartItemsPage::class);

Route::get('/Check-Out', CheckOut::class);

Route::get('/Success', SuccessPage::class);

Route::get('/User-Profile', CustomerProfile::class);

/**
 * The route /Users is already being used
 * If you overwrite it here, the EndUserPanelProvider will
 * No Longer work
 * 
 * That panel is for Login of EndUsers
 * By : @404Mine
 */

 /**
  * The route /admin is alredy being used
  * If you overwrite it here, the AdminPanelProvider will
  * No Longer work
  *
  * That panel is for Login of Admin
  * By : @404Mine
  */