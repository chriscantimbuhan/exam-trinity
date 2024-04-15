<?php

use App\Domain\Contact\Models\Contact;
use Illuminate\Support\Facades\Route;

Route::prefix('api/contacts')
    ->namespace('App\Domain\Contact\Controllers')
    ->as('contacts.')
    ->group(function () {
        Route::get('/', 'ContactController@index')->name('index');
        Route::get('/{' . Contact::ROUTE_KEY . '}', 'ContactController@show')->name('show');
        Route::post('/', 'ContactController@store')->name('store');
        Route::put('/{' . Contact::ROUTE_KEY . '}', 'ContactController@update')->name('update');
        Route::delete('/{' . Contact::ROUTE_KEY . '}', 'ContactController@destroy')->name('destroy');
    });
