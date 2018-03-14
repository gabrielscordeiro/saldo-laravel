<?php

$this->group(['middleware' => ['auth'], 'namespace' => 'Admin'], function() {
    $this->get('admin', 'AdminController@index')->name('admin');
});


$this->get('/', 'Site\SiteController@index')->name('home');

Auth::routes();

