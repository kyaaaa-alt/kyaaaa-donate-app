<?php namespace Core\Conf\Kyaaaa;

use Core\Conf\Kyaaaa\DB;

class Tripay {
    public function __construct() {
        $builder = DB::query('settings')->select('*');
        $settings = $builder->get();
        $this->merchantCode = $settings[0]->merchant_code;
        $this->apiKey = $settings[0]->merchant_api_key;
        $this->privateKey = $settings[0]->merchant_private_key;
        $this->endpoint = $settings[0]->endpoint;
    }

    public function payment_channel() {
        $apiKey = $this->apiKey;
        $payload = ['code' => ''];
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_FRESH_CONNECT  => true,
            CURLOPT_URL            => 'https://tripay.co.id/'.$this->endpoint.'/merchant/payment-channel?'.http_build_query($payload),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER         => false,
            CURLOPT_HTTPHEADER     => ['Authorization: Bearer '.$apiKey],
            CURLOPT_FAILONERROR    => false,
            CURLOPT_IPRESOLVE      => CURL_IPRESOLVE_V4
        ));

        $response = json_decode(curl_exec($curl));
        $error = json_decode(curl_error($curl));
        curl_close($curl);

        if ($response->success == true) {
            foreach ($response->data as $row){
                if ($row->active == true){
                    $result[] = $row;
                }
            }
            return array_reverse($result, true);
        } else {
            $err = $response->message;
            echo "<script>
            alert('". $err ."');
            window.history.go(-1);
            </script>";
            exit();
        }
    }

    public function request_payment($payload) {
        /* @ ContohPayload
        $payload = [
        'payment_method' => '',
        'name' => '',
        'email' => '',
        'phone' => '',
        'amount' => 'total price',
        'order_items' => [
        [
        'name'        => 'Nama Produk 1',
        'price'       => 500000,
        'quantity'    => 1,
        ]
        ],
        ];
         */
        // $payload = json_decode($payload);
        date_default_timezone_set('Asia/Jakarta');
        $today = date('dmyHis');

        $apiKey       = $this->apiKey;
        $privateKey   = $this->privateKey;
        $merchantCode = $this->merchantCode;
        $merchantRef  = 'INVD/'. substr($payload['phone'], -3) . '/' . $today;

        $data = [
            'method'         => $payload['payment_method'],
            'merchant_ref'   => $merchantRef,
            'amount'         => $payload['amount'],
            'customer_name'  => $payload['name'],
            'customer_email' => $payload['email'],
            'customer_phone' => $payload['phone'],
            'order_items'    => $payload['order_items'],
            'return_url'   => base_url(),
            'expired_time' => (time() + (24 * 60 * 60)),
            'signature'    => hash_hmac('sha256', $merchantCode.$merchantRef.$payload['amount'], $privateKey)
        ];

        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_FRESH_CONNECT  => true,
            CURLOPT_URL            => 'https://tripay.co.id/'.$this->endpoint.'/transaction/create',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER         => false,
            CURLOPT_HTTPHEADER     => ['Authorization: Bearer '.$apiKey],
            CURLOPT_FAILONERROR    => false,
            CURLOPT_POST           => true,
            CURLOPT_POSTFIELDS     => http_build_query($data),
            CURLOPT_IPRESOLVE      => CURL_IPRESOLVE_V4
        ]);

        $response = json_decode(curl_exec($curl));
        $error = json_decode(curl_error($curl));
        curl_close($curl);
        return $response;
    }

    public function invoice($reference) {
        $apiKey = $this->apiKey;
        $payload = ['reference'	=> $reference];
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_FRESH_CONNECT  => true,
            CURLOPT_URL            => 'https://tripay.co.id/'.$this->endpoint.'/transaction/detail?'.http_build_query($payload),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER         => false,
            CURLOPT_HTTPHEADER     => ['Authorization: Bearer '.$apiKey],
            CURLOPT_FAILONERROR    => false,
            CURLOPT_IPRESOLVE      => CURL_IPRESOLVE_V4
        ]);
        $response = json_decode(curl_exec($curl));
        $error = json_decode(curl_error($curl));
        curl_close($curl);
        if ($response->success == true) {
            return $response;
        } else {
            $err = $response->message;
            echo "<script>
            alert('". $err ."');
            window.history.go(-1);
            </script>";
            exit();
        }
    }

    public function icon($payment_code) {
        $apiKey = $this->apiKey;
        $payload = ['code' => $payment_code];
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_FRESH_CONNECT  => true,
            CURLOPT_URL            => 'https://tripay.co.id/'.$this->endpoint.'/merchant/payment-channel?'.http_build_query($payload),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER         => false,
            CURLOPT_HTTPHEADER     => ['Authorization: Bearer '.$apiKey],
            CURLOPT_FAILONERROR    => false,
            CURLOPT_IPRESOLVE      => CURL_IPRESOLVE_V4
        ));

        $response = json_decode(curl_exec($curl));
        $error = json_decode(curl_error($curl));
        curl_close($curl);

        if ($response->success == true) {
            return $response->data[0]->icon_url;
        } else {
            $err = $response->message;
            echo "<script>
            alert('". $err ."');
            window.history.go(-1);
            </script>";
            exit();
        }
    }

}
?>