<?php

namespace App\Http\Controllers\Admin;

/**
 *
 * @author Gabriel Schmidt Cordeiro <gabrielscordeiro2012@gmail.com>
 * 
 */

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Balance;
use App\Http\Requests\MoneyValidationFormRequest;
use App\User;

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
        $response = $balance->deposito($request->valorMoney);

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
        $response = $balance->saque($request->valorMoney);

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

    public function transferir()
    {
        return view('admin.balance.transferir');
    }

    public function confirmaTransferencia(Request $request, User $user)
    {
        if (!$sender = $user->getSender($request->sender)) {
            return redirect()
                            ->back()
                            ->with('error', 'Usuário informado não encontrado!');
        } elseif ($sender->id === auth()->user()->id) {
            return redirect()
                            ->back()
                            ->with('error', 'Você não pode transferir dinheiro para você mesmo!');
        } else {
            $balance = auth()->user()->balance;
            return view('admin.balance.confirma-transferencia', compact('sender', 'balance'));
        }
    }

    public function transferenciaStore(MoneyValidationFormRequest $request, User $user)
    {

        if (!$sender = $user->find($request->sender_id)) {
            return redirect()
                            ->route('balance.transferencia')
                            ->with('success', 'Recebedor não encontrado');
        } else {
            $balance = auth()->user()->balance()->firstOrCreate([]);
            $response = $balance->realizarTransferencia($request->valorMoney, $sender);

            if ($response['success']) {
                return redirect()
                                ->route('admin.balance')
                                ->with('success', $response['message']);
            } else {
                return redirect()
                                ->route('admin.balance')
                                ->with('error', $response['message']);
            }
        }
    }

}
