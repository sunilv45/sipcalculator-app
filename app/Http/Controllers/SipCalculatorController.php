<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use NumberFormatter;

class SipCalculatorController extends Controller
{
    public function index()
    {
        return view('calculators.sipcalculator');
    }
    public function retirementcalculator()
    {
        return view('calculators.retirementcalculator');
    }
    public function swpcalculator()
    {
        return view('calculators.swpcalculator');
    }
    public function setupsipcalculator()
    {
        return view('calculators.setupsipcalculator');
    }
    public function sipvaluecalculator()
    {
        return view('calculators.sipvaluecalculator');
    }

    public function calculate(Request $request)
    {
        $request->validate([
            'target' => 'required|numeric',
            'existing_investment' => 'numeric',
            'years' => 'required|numeric',
            'returns' => 'required|numeric',
        ]);

        $target = $request->input('target');
        $existingInvestment = $request->input('existing_investment', 0);
        $years = $request->input('years');
        $returns = $request->input('returns');

        $amtInvested = round($existingInvestment * pow(1 + ($returns / 100), $years));

        $monthlyInvestment = round(
            ((round(($target - $amtInvested) * pow(1 + (0 / 100), $years))) *
                ($returns / (100 * 12))) /
                (pow(1 + (($returns / (100 * 12))), ($years * 12)) - 1)
        );

        $formattedMonthlyInvestment = $this->formatCurrency($monthlyInvestment);

        return view('sip_calculator.result', compact('amtInvested', 'formattedMonthlyInvestment'));
    }

    private function formatCurrency($amount)
    {
        $formatter = new NumberFormatter('en-IN', NumberFormatter::CURRENCY);
        return $formatter->formatCurrency($amount, 'INR');
    }
}
