<?php namespace Core\Controllers;

use Core\Models\PaymentModel;
use Core\Conf\Kyaaaa\Tripay;

class PaymentCtrl {
    public function __construct() {
        $this->PaymentModel = new PaymentModel();
        $this->request = request();
        $this->tripay = new Tripay();
    }

    public function index() {
        $username = $this->DonateModel->get_username();
        $data['title'] = 'Dukung @' . $username;
        $data['username'] = $username;
        return view('donate/index', $data);
    }

    public function do_donate() {
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Headers: *");
        $name = $this->request->post('name');
        $email = $this->request->post('email');
        $amount = $this->request->post('amount');
        $msgs = $this->request->post('msgs');
        $private = $this->request->post('private');

        $payload = [
            'isDonation' => true,
            'name' => $name,
            'email' => $email,
            'amount' => $amount,
        ];

        $order = $this->tripay->request_payment($payload);

        if ($order->success == true) {
            $data = [
                'reference' => $order->data->reference,
                'merchant_ref' => $order->data->merchant_ref,
                'customer_name' => $name,
                'customer_email' => $email,
                'customer_phone' => $order->data->customer_phone,
                'payment_name' => $order->data->payment_name,
                'amount' => $order->data->amount,
                'amount_received' => $order->data->amount_received,
                'checkout_url' => $order->data->checkout_url,
                'invoice_url' => url() . '/inv/' . $order->data->reference,
                'msgs' => $msgs,
                'status' => 'UNPAID',
                'private' => $private
            ];
            $insert_donate = $this->PaymentModel->save_donation($data);
            if ($insert_donate) {
                echo json_encode([
                    'success' => true,
                    'invoice' => url() . 'inv/' . $order->data->reference,
                    'msg' => ''
                ]);
            } else {
                echo json_encode([
                        'success' => false,
                        'invoice' => '',
                        'msg' => 'Gagal membuat transaksi, silahkan coba lagi...']
                );
            }
        } else {
            echo json_encode([
                    'success' => false,
                    'invoice' => '',
                    'msg' => $order->message
                ]
            );
        }
    }

    public function invoice($id)  {
        $data['response'] = $this->tripay->invoice($id);
        $payment_code = $data['response']->data->payment_method;
        $data['icon'] = $this->tripay->icon($payment_code);
        return view('invoice/index', $data);
    }

}