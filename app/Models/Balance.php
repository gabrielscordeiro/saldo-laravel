<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Balance extends Model
{

    public $timestamps = false;

    public function deposito(float $value): Array
    {
        $this->amount += number_format($value, 2, '.', '');
        $deposito = $this->save();

        if ($deposito) {
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
