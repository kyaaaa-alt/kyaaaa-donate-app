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
//        header("Access-Control-Allow-Origin: *");
//        header("Access-Control-Allow-Headers: *");
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

    public function callback() {
        $data = $this->tripay->callback();
        $get = $this->PaymentModel->get_merchant_ref($data->merchant_ref);
        if (empty($get)) {
            exit(json_encode([
                'success' => false,
                'message' => 'merchant_ref not found',
            ]));
        }
        $update = $this->PaymentModel->update_donation($data->merchant_ref ,$data->status);
        if ($update) {
            echo json_encode(['success' => true]);
            if ($data->status == 'PAID') {
                $email_body = '<html><head></head><body><h3>Halo, '.$get[0]->customer_name .'</h3><p>Terima kasih, ya untuk donasinya! Berikut detail pembayarannya: </p><table style="width:100%;border: 1px solid black;border-collapse: collapse;"> <tr> <th style="padding: 5px;text-align: left;border: 1px solid black;">Invoice link</th> <td style="padding: 5px;text-align: left;border: 1px solid black;"><a href="'.$get[0]->invoice_url .'">'.$get[0]->invoice_url .'</a></td></tr><tr> <th style="padding: 5px;text-align: left;border: 1px solid black;">Nama</th> <td style="padding: 5px;text-align: left;border: 1px solid black;">'.$get[0]->customer_name .'</td></tr><tr> <th style="padding: 5px;text-align: left;border: 1px solid black;">Metode Pembayaran</th> <td style="padding: 5px;text-align: left;border: 1px solid black;">'.$get[0]->payment_name .'</td></tr><tr> <th style="padding: 5px;text-align: left;border: 1px solid black;">Total</th> <td style="padding: 5px;text-align: left;border: 1px solid black;">'.$get[0]->amount .'</td></tr><tr> <th style="padding: 5px;text-align: left;border: 1px solid black;">Waktu Pembayaran</th> <td style="padding: 5px;text-align: left;border: 1px solid black;">'.date('d/m/Y H:i:s', $data->paid_at).'</td></tr></table><br/>Terima Kasih</body></html>';

                $email = \Core\Conf\Email::start();
                $email->setFrom('naufspace@gmail.com', 'Nauf Space');
                $email->setTo($get[0]->customer_email, $get[0]->customer_name);
                $email->setSubject('Pembayaran dengan '.$get[0]->payment_name.' Berhasil tanggal ' . date('d/m/Y H:i:s', $data->paid_at));
                $email->setBody($email_body);
                $email->send();
            }
        }
    }

}