<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentMethodController extends Controller
{
    public function create()
    {
        $intent = auth()->user()->createSetupIntent();
        return view('payment-method.create', compact('intent'));
    }

    public function store(Request $request)
    {
        try {
            auth()->user()->addPaymentMethod($request->input('payment-method'));
            if ($request->input('default') == 1) {
                auth()->user()->updateDefaultPaymentMethod($request->input('payment-method'));
            }
        } catch (\Exception $e) {
            return redirect()->back()->withError($e->getMessage());
        }

        return redirect()->route('billing')->withMessage('Payment method added successfully');
    }

    public function markDefault(Request $request, $paymentMethod)
    {
        try {
            auth()->user()->updateDefaultPaymentMethod($paymentMethod);
        } catch (\Exception $e) {
            return redirect()->back()->withError($e->getMessage());
        }

        return redirect()->route('billing')->withMessage('Payment method updated successfully');
    }

    public function destroy($id)
    {
        //
    }
}
