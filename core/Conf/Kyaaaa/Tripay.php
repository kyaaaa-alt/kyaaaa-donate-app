<?php namespace Core\Conf\Kyaaaa;

use Core\Conf\Kyaaaa\DB;

class Tripay {
    public function __construct() {
        $tripay_api_key = DB::query('settings')->select('*')->get();
        $this->merchantCode = $tripay_api_key[0]->merchant_code;
        $this->apiKey = $tripay_api_key[0]->merchant_api_key;
        $this->privateKey = $tripay_api_key[0]->merchant_private_key;
        $this->endpoint = $tripay_api_key[0]->endpoint;
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


    /** @ ContohPayload
    * @array $payload = [
    *           'name' => '',
    *           'email' => '',
    *           'phone' => '',
    *           'amount' => 'total price',
    *       ];
    **/
    // $payload = json_decode($payload);
    public function request_payment($payload) {

        $today = date('dmyHis');
        $apiKey       = $this->apiKey;
        $privateKey   = $this->privateKey;
        $merchantCode = $this->merchantCode;
        $phone = '0812' . rand(11111111,99999999);
        $merchantRef  = 'INVD/'. substr($payload['name'], -3) . '/' . $today;
        $items = [
            [
                'sku' => 'TF',
                'name'        => 'from ' . $payload['name'],
                'price'       => $payload['amount'],
                'quantity'    => 1,
            ]
        ];

        $data = [
            'method'         => 'QRISC',
            'merchant_ref'   => $merchantRef,
            'amount'         => $payload['amount'],
            'customer_name'  => $payload['name'],
            'customer_email' => $payload['email'],
            'customer_phone' => $phone,
            'order_items'    => $items,
            'return_url'   => url(),
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
        curl_close($curl);

        if ($response->success == true) {
            return $response;
        } else {
            $data2 = [
                'method'         => 'QRIS',
                'merchant_ref'   => $merchantRef,
                'amount'         => $payload['amount'],
                'customer_name'  => $payload['name'],
                'customer_email' => $payload['email'],
                'customer_phone' => $phone,
                'order_items'    => $items,
                'return_url'   => url(),
                'expired_time' => (time() + (24 * 60 * 60)),
                'signature'    => hash_hmac('sha256', $merchantCode.$merchantRef.$payload['amount'], $privateKey)
            ];

            $curl2 = curl_init();
            curl_setopt_array($curl2, [
                CURLOPT_FRESH_CONNECT  => true,
                CURLOPT_URL            => 'https://tripay.co.id/'.$this->endpoint.'/transaction/create',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_HEADER         => false,
                CURLOPT_HTTPHEADER     => ['Authorization: Bearer '.$apiKey],
                CURLOPT_FAILONERROR    => false,
                CURLOPT_POST           => true,
                CURLOPT_POSTFIELDS     => http_build_query($data2),
                CURLOPT_IPRESOLVE      => CURL_IPRESOLVE_V4
            ]);

            $response2 = json_decode(curl_exec($curl2));
            curl_close($curl2);

            if ($response2->success == true){
                return $response2;
            } else {
                $data3 = [
                    'method'         => 'QRIS2',
                    'merchant_ref'   => $merchantRef,
                    'amount'         => $payload['amount'],
                    'customer_name'  => $payload['name'],
                    'customer_email' => $payload['email'],
                    'customer_phone' => $phone,
                    'order_items'    => $items,
                    'return_url'   => url(),
                    'expired_time' => (time() + (24 * 60 * 60)),
                    'signature'    => hash_hmac('sha256', $merchantCode.$merchantRef.$payload['amount'], $privateKey)
                ];

                $curl3 = curl_init();
                curl_setopt_array($curl3, [
                    CURLOPT_FRESH_CONNECT  => true,
                    CURLOPT_URL            => 'https://tripay.co.id/'.$this->endpoint.'/transaction/create',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_HEADER         => false,
                    CURLOPT_HTTPHEADER     => ['Authorization: Bearer '.$apiKey],
                    CURLOPT_FAILONERROR    => false,
                    CURLOPT_POST           => true,
                    CURLOPT_POSTFIELDS     => http_build_query($data3),
                    CURLOPT_IPRESOLVE      => CURL_IPRESOLVE_V4
                ]);

                $response3 = json_decode(curl_exec($curl3));
                curl_close($curl3);

                return $response3;
            }
        }

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