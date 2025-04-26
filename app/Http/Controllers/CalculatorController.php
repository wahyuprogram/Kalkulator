<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CalculatorController extends Controller
{
    public function calculate(Request $request)
    {
        $request->validate([
            'num1' => 'required|numeric',
            'num2' => 'required|numeric',
            'operation' => 'required',
        ]);

        $num1 = $request->input('num1');
        $num2 = $request->input('num2');
        $operation = $request->input('operation');
        $result = null;
        $history = session('history', []);

        switch ($operation) {
            case 'add':
                $result = $num1 + $num2;
                $history[] = "$num1 + $num2 = $result";
                break;
            case 'subtract':
                $result = $num1 - $num2;
                $history[] = "$num1 - $num2 = $result";
                break;
            case 'multiply':
                $result = $num1 * $num2;
                $history[] = "$num1 × $num2 = $result";
                break;
            case 'divide':
                if ($num2 == 0) {
                    return back()->withErrors(['Pembagian dengan nol tidak bisa.'])->withInput();
                }
                $result = $num1 / $num2;
                $history[] = "$num1 ÷ $num2 = $result";
                break;
            default:
                return back()->withErrors(['Operasi tidak valid.'])->withInput();
        }

        session(['history' => $history]);

        return redirect()->back()->with('result', $result);
    }
}