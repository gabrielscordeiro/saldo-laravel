<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Balance;
use App\Http\Requests\MoneyValidationFormRequest;

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

    public function depositoStore(MoneyValidationFormRequest $request)
    {
        /* Caso nao tenha nenhum registro na tabela relacionado ao usuário ele
         * irá criar um registro com os valores default
         */
        $balance = auth()->user()->balance()->firstOrCreate([]);
        $response = $balance->deposito($request->valorRecarga);

        if ($response['success']) {
            return redirect()
                            ->route('admin.balance')
                            ->with('success', $response['message']);
        } else {
            return redirect()
                            ->back()
                            ->with('error', $response['message']);
        }
    }

    public function saque()
    {
        return view('admin.balance.saque');
    }
    
    public function saqueStore(MoneyValidationFormRequest $request)
    {
        /* Caso nao tenha nenhum registro na tabela relacionado ao usuário ele
         * irá criar um registro com os valores default
         */
        $balance = auth()->user()->balance()->firstOrCreate([]);
        $response = $balance->deposito($request->valorSaque);

        if ($response['success']) {
            return redirect()
                            ->route('admin.balance')
                            ->with('success', $response['message']);
        } else {
            return redirect()
                            ->back()
                            ->with('error', $response['message']);
        }
    }

}
