<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Balance extends Model
{

    public $timestamps = false;

    public function deposito(float $value): Array
    {
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
            return [
                'success' => true,
                'message' => 'Registro inserido com sucesso'
            ];
        }

        return [
            'success' => false,
            'message' => 'Falha ao tentar inserir o registro'
        ];
    }

}
