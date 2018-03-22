<?php

namespace App\Models;

/**
 *
 * @author Gabriel Schmidt Cordeiro <gabrielscordeiro2012@gmail.com>
 * 
 */

use Illuminate\Database\Eloquent\Model;

class Historic extends Model
{

    protected $fillable = ['type', 'amount', 'total_before', 'total_after', 'user_id_transaction', 'date'];

}
