<?php

$this->group(['middleware' => ['auth'], 'namespace' => 'Admin', 'prefix' => 'admin'], function() {
    $this->get('/', 'AdminController@index')->name('admin.home');
    
    $this->get('balance/historico','BalanceController@historico')->name('admin.historico');
    
    $this->post('balance/transferencia/store','BalanceController@transferenciaStore')->name('transferencia.store');   
    $this->post('balance/transferencia/confirmaTransferencia','BalanceController@confirmaTransferencia')->name('confirma.transferencia');   
    $this->get('balance/transferencia','BalanceController@transferir')->name('balance.transferencia');   
    
    $this->get('balance/saque','BalanceController@saque')->name('balance.saque');   
    $this->post('balance/saque/store','BalanceController@saqueStore')->name('saque.store');       
    
    $this->post('balance/deposito/store', 'BalanceController@depositoStore')->name('deposito.store');
    $this->get('balance/deposito', 'BalanceController@deposito')->name('balance.deposito');
    
    $this->get('balance', 'BalanceController@index')->name('admin.balance');
});


$this->get('/', 'Site\SiteController@index')->name('home');

Auth::routes();

