<?php

namespace Dipesh79\LaravelKhalti;

use Illuminate\Support\Facades\Http;

class LaravelKhalti
{
    private $secret_key;
    private $env;
    private $website_url;
    private $callback_url;

    public function __construct()
    {
        $this->secret_key = config('khalti.sck');
        $this->env = config('khalti.env');
        $this->website_url = config('khalti.url');
        $this->callback_url = config('khalti.callback_url');
    }

    public function khaltiCheckout($amount, $poi, $pon)
    {
        if ($this->env == "Sandbox") {
            $khalti_url = "https://a.khalti.com/api/v2/";
        } elseif ($this->env == "Live") {
            $khalti_url = "https://khalti.com/api/v2/";
        } else {
            return "Please specify environment.";
        }

        $headers = [
            'Authorization' => 'Key ' . $this->secret_key
        ];
        $body =  [
            'return_url' => $this->callback_url,
            'website_url' => $this->website_url,
            'amount' => $amount * 100,
            'purchase_order_id' => $poi,
            'purchase_order_name' => $pon
        ];

        $response = Http::withHeaders($headers)->post($khalti_url . 'epayment/initiate/',$body);
        $pidx = $response['pidx'];
        $url = $response['payment_url'];
        $result = [
            'pidx'=>$pidx,
            'url'=>$url
        ];
        return $result; 
    }
}
