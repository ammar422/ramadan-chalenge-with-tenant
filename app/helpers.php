<?php

use Modules\Users\App\Models\User;

if (!function_exists('fkr')) {
    function fkr($lang = 'ar', $class = null)
    {
        if ($lang == "ar") {
            $lang = "ar_SA";
        } elseif ($lang == "en") {
            $lang = "en_US";
        }

        $fkr = Faker\Factory::create($lang);
        if (!empty($class)) {
            $myclass = 'Faker\\Provider\en_US\\' . $class;
            $fkr->addProvider(new $myclass($fkr));
        }
        return $fkr;
    }
}


if (!function_exists('curlec')) {
    function curlec()
    {
        return new \Razorpay\Api\Api(env('CURLEC_KEY_ID'), env('CURLEC_KEY_SECRET'));
    }
}



if (!function_exists(function: 'fastforx')) {

    function currency_change($from = 'USD', $to = 'MYR')
    {
        // Ensure valid currency codes
        $validCurrencies = ['USD', 'MYR', 'EUR', 'INR', 'GBP', 'AUD']; // List of supported currencies (you can expand this list)

        if (!in_array(strtoupper($from), $validCurrencies)) {
            return ['error' => 'Invalid source currency'];
        }

        if (!in_array(strtoupper($to), $validCurrencies)) {
            return ['error' => 'Invalid target currency'];
        }

        $client = new \GuzzleHttp\Client();

        // Define the API URL
        $url = 'https://api.fastforex.io/fetch-multi';
        $queryParams = [
            'from' => strtoupper($from),  // Ensure currency codes are in uppercase
            'to' => strtoupper($to),      // Ensure currency codes are in uppercase
            'api_key' => env('FAST_FOREX_API_KEY', 'd04b627d6f-b11b51f4c7-sn8jwz'), // Replace with your API key
        ];

        try {
            // Send the GET request
            $response = $client->request('GET', $url, [
                'verify' => false,
                'query' => $queryParams,
            ]);

            // Get the response body
            $responseBody = $response->getBody()->getContents();

            // Decode JSON response
            return json_decode($responseBody, true);
        } catch (\Exception $e) {
            return ['error' => 'Request failed: ' . $e->getMessage()];
        }
    }
}




if (!function_exists('testUser')) {
    function testUser($code = null)
    {
        $data = !empty($code) ? [
            'verification_code' => $code,
            'email_verified_at' => now(), 
        ] : [
            'email_verified_at' => now(), 
        ];

        $user = \Modules\Users\App\Models\User::factory()->create($data);

        // Generate a JWT token for the user
        $token = auth('api')->login($user);

        return ['token' => $token, 'user' => $user];
    }
}


if (!function_exists('transValidation')) {
    function transValidation($validation, $columns = [])
    {
        $trans = [];
        $i = 0;
        foreach (config('translatable.locale') as $locale) {
            $trans[] = [$columns[$i] . ':' . $locale => 'required|string'];
            $i++;
        }
        return array_merge($trans, $validation);
    }
}
