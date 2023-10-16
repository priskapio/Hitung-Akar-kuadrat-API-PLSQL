<?php

namespace App\Http\Controllers;

use App\Models\Akar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AkarController extends Controller
{
    public function index()
    {
        $akar = Akar::orderBy('created_at', 'desc')->get();
        $result = null; 
        $executionTime = null; 

        
        return view('index', compact('akar', 'result', 'executionTime'));
    }

    public function calculate(Request $request)
    {
        $inputNumber = $request->input('number');
        $method = $request->input('method');
        $validInput = 1000;
        $startTime = microtime(true);
        $result = null; 
        $executionTime = null;

        
        $inputNumber = str_replace(',', '.', $inputNumber);

        
        if (!is_numeric($inputNumber) || $inputNumber < 0) {
            return redirect()->route('square_root.index')->with('error', 'Input harus berupa bilangan positif yang lebih besar dari 0.');
        }

        if ($inputNumber != $validInput) {
        return redirect()->route('square_root.index')->with('error', 'Input harus tepat 1000.');
        }
        

        if ($method === 'API') {
            $response = Http::get("https://api.mathjs.org/v4/?expr=sqrt($inputNumber)");
            $result = $response->body();
        } elseif ($method === 'PL/SQL') {
            $result = Akar::calculateSquareRoot($inputNumber);
        }
        

        $endTime = microtime(true);
        $executionTime = round($endTime - $startTime, 2);

        $history = new Akar([
            'input_number' => $inputNumber,
            'square_root' => $result,
            'method' => $method,
            'execution_time' => $executionTime,
        ]);

        $history->save();

        return redirect()->route('square_root.index', ['result' => $result, 'executionTime' => $executionTime])->with('result', $result)->with('success', 'Perhitungan berhasil disimpan.');
    }
}