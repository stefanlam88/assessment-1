<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Stripe\PaymentIntent;

class UserController extends Controller
{
    public function purchase(Request $request)
    {
        $options = [
            'return_url' => 'https://example.com/checkout/success', // Replace with your actual return URL
        ];

        $user = User::firstOrCreate(
            [
                'email' => $request->input('email'),
            ],
            [
                'password' => Hash::make(Str::random(12)),
                'name' => $request->input('first_name').' '.$request->input('last_name'),
                'address' => $request->input('address'),
                'city' => $request->input('city'),
                'state' => $request->input('state'),
                'zipcode' => $request->input('zipcode'),
            ]
        );

        try {
            $payment = $user->charge(
                $request->input('amount'),
                $request->input('payment_method_id'),
                [
                    'options' => $options,
                ]
            );

            $payment = $payment->asStripePaymentIntent();

            $order = $user->orders()
                ->create([
                    'transaction_id' => $payment->id,
                    'total' => $payment->amount,
                ]);

            foreach (json_decode($request->input('cart'), true) as $item) {
                $order->products()
                    ->attach($item['id'], ['quantity' => $item['quantity']]);
            }
            $order->load('products');

            return $order;
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
}
