<?php

namespace App\Models;

/**
 *
 * @author Gabriel Schmidt Cordeiro <gabrielscordeiro2012@gmail.com>
 * 
 */

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\User;

class Balance extends Model
{

    public $timestamps = false;

    public function deposito(float $value): Array
    {
        DB::beginTransaction();
        
        $totalBefore = $this->amount ? $this->amount : 0;
        $this->amount += number_format($value, 2, '.', '');
        $deposito = $this->save();

        $historic = auth()->user()->historics()->create([
            'type' => 'I',
            'amount' => $value,
            'total_before' => $totalBefore,
            'total_after' => $this->amount,
            'date' => date('Ymd')
        ]);

        if ($deposito && $historic) {
            
            DB::commit();
            
            return [
                'success' => true,
                'message' => 'Registro inserido com sucesso'
            ];
        }else{
            DB::rollback();
            
            return [
                'success' => false,
                'message' => 'Falha ao tentar inserir o registro'
            ];
        }

    }
    
    public function saque(float $value): Array
    {
        if($this->amount < $value){
            return [
                'success' => false,
                'message' => 'Saldo insuficiente para realização do saque'
            ];
        }
        DB::beginTransaction();
        
        $totalBefore = $this->amount ? $this->amount : 0;
        $this->amount -= number_format($value, 2, '.', '');
        $saque = $this->save();

        $historic = auth()->user()->historics()->create([
            'type' => 'O',
            'amount' => $value,
            'total_before' => $totalBefore,
            'total_after' => $this->amount,
            'date' => date('Ymd')
        ]);

        if ($saque && $historic) {
            
            DB::commit();
            
            return [
                'success' => true,
                'message' => 'Registro inserido com sucesso'
            ];
        }else{
            DB::rollback();
            
            return [
                'success' => false,
                'message' => 'Falha ao tentar inserir o registro'
            ];
        }
    }
    
    public function realizarTransferencia(float $value, User $sender):Array
    {
         if($this->amount < $value){
            return [
                'success' => false,
                'message' => 'Saldo insuficiente para realização do saque'
            ];
        }
        
        DB::beginTransaction();
        
        //Atualiza o próprio saldo
        $totalBefore = $this->amount ? $this->amount : 0;
        $this->amount -= number_format($value, 2, '.', '');
        $transfer = $this->save();

        $historic = auth()->user()->historics()->create([
            'type' => 'T',
            'amount' => $value,
            'total_before' => $totalBefore,
            'total_after' => $this->amount,
            'date' => date('Ymd'),
            'user_id_transaction' => $sender->id
        ]);
        
        //Atualiza o Saldo de quem vai receber
        $senderBalance = $sender->balance()->firstOrCreate([]);
        $senderTotalBefore = $senderBalance->amount ? $senderBalance->amount : 0;
        $senderBalance->amount += number_format($value, 2, '.', '');
        $transferSender = $senderBalance->save();

        $historicSender = $sender->historics()->create([
            'type' => 'I',
            'amount' => $value,
            'total_before' => $senderTotalBefore,
            'total_after' => $senderBalance->amount,
            'date' => date('Ymd'),
            'user_id_transaction' => auth()->user()->id
        ]);

        if ($transfer && $historic && $transferSender && $historicSender) {
            
            DB::commit();
            
            return [
                'success' => true,
                'message' => 'Registro inserido com sucesso'
            ];
        }
        
        DB::rollback();

        return [
            'success' => false,
            'message' => 'Falha ao tentar inserir o registro'
        ];
        
    }

}
