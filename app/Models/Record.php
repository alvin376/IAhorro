<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    use HasFactory;

    /*
	 * Un registro pertenece a un experto hipotecario
     */
    public function employee() {
    	return $this->belongsTo(Employee::class);
    }
}
