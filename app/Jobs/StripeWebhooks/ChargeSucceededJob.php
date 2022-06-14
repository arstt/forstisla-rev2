<?php

namespace App\Jobs\StripeWebhooks;

use App\Models\Payment;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Spatie\WebhookClient\Models\WebhookCall;
use App\Notifications\ChargeSuccessNotification;
use App\Services\InvoicesService;

class ChargeSucceededJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $webhookCall;

    public function __construct(WebhookCall $webhookCall)
    {
        $this->webhookCall = $webhookCall;
    }

    public function handle()
    {
        $charge = $this->webhookCall->payload['data']['object'];

        $user = User::where('stripe_id', $charge['customer'])->first();

        if ($user) {
            $payment = Payment::create([
                'user_id'  => $user->id,
                'stripe_id' => $charge['id'],
                'subtotal' => $charge['amount'],
                'total'    => $charge['amount']
            ]);

            (new InvoicesService())->generateInvoice($payment);

            $user->notify(new ChargeSuccessNotification($payment));
        }
    }
}
