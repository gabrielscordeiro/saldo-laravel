<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Balance;

class BalanceController extends Controller
{

    public function index()
    {
        $balance = auth()->user()->balance;
        $amount = $balance ? $balance->amount : 0;
        return view('admin.balance.index', compact('amount'));
    }

    public function deposito()
    {
        return view('admin.balance.deposito');
    }

    public function depositoStore(Request $request)
    {
        /* Caso nao tenha nenhum registro na tabela relacionado ao usuário ele
         * irá criar um registro com os valores default
         */
        $balance = auth()->user()->balance()->firstOrCreate([]);
        $balance->deposito($request->valorDeposito);
    }

}
