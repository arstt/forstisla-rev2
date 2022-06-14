<?php

namespace App\Http\Controllers;

use App\Models\Feature;
use App\Models\FeaturePlan;
use App\Models\Payment;
use App\Models\Plan;
use App\Services\InvoicesService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use \Laravel\Cashier\Subscription;

class BillingController extends Controller
{
    public function index()
    {
        // $payment = Payment::with('user')->find(5);
        // return (new InvoicesService())->generatePayment($payment);


        $plans = Plan::all();
        $feature_plan = FeaturePlan::all();
        $features = Feature::all();
        $currentPlan = auth()->user()->subscription('default') ?? NULL;
        //$paymentMethods = auth()->user()->paymentMethods();
        //$defaultPaymentMethod = auth()->user()->defaultPaymentMethod();

         $paymentMethods = NULL;
         $defaultPaymentMethod = NULL;
         if (!is_null($currentPlan)) {
             $paymentMethods       = auth()->user()->paymentMethods();
             $defaultPaymentMethod = auth()->user()->defaultPaymentMethod();
            }

            $payments = Payment::where('user_id', auth()->id())->latest()->get();

            return view('billing.index', compact('plans', 'currentPlan', 'paymentMethods', 'defaultPaymentMethod', 'payments','features','feature_plan'));
    }

    public function cancel()
    {
        auth()->user()->subscription('default')->cancel();
        return redirect()->route('billing');
    }

    public function resume()
    {
        auth()->user()->subscription('default')->resume();
        return redirect()->route('billing');
    }

    public function downloadInvoice($paymentId) {
        $payment = Payment::where('user_id', auth()->id())->where('id', $paymentId)->firstOrFail();
        $filename = storage_path('app/invoices/' . $payment->id . '.pdf');
        if (!file_exists($filename)) {
            abort(404);
        }

        return response()->download($filename);
    }
}
