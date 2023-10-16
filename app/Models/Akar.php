<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Akar extends Model
{
    protected $fillable = ['input_number', 'square_root', 'method', 'execution_time'];

    public static function calculateSquareRoot($inputNumber)
    {
        
        $result = DB::select('CALL CalculateSquareRoot(?, @squareRoot)', [$inputNumber]);
        $squareRoot = DB::select('SELECT @squareRoot as squareRoot')[0]->squareRoot;

        return $squareRoot;
    }
}
