<?php

$this->group(['middleware' => ['auth'], 'namespace' => 'Admin', 'prefix' => 'admin'], function() {
    $this->get('balance/deposito', 'BalanceController@depositoStore')->name('deposito.store');
    $this->get('balance/deposito', 'BalanceController@deposito')->name('balance.deposito');
    $this->get('/', 'AdminController@index')->name('admin.home');
    $this->get('balance', 'BalanceController@index')->name('balance');
});


$this->get('/', 'Site\SiteController@index')->name('home');

Auth::routes();

