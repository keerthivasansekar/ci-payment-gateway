<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use Razorpay\Api\Api;

class CartController extends BaseController
{
    private $key_id, $key_secret, $session;

    public function __construct() {
        $this->key_id = env('rzp.key_id');
        $this->key_secret = env('rzp.key_secret');
        $this->session = session();
        $this->setCartSession();
    }

    public function index()
    {
        $data = [
            '_view_file' => 'cart/index',
            '_page_title' => 'Cart',
            'body' => [
                'cartItems' => $this->getCartSession(),
                'grand_total' => $this->getGrandTotal(),
            ]
        ];
        return view('layouts/main', $data);
    }

    public function checkout()
    {
        $name = $this->request->getVar('name');
        $email = $this->request->getVar('email');
        $mobile = $this->request->getVar('mobile');

        $api = new Api($this->key_id, $this->key_secret);

        $data = [
            'amount' => $this->getGrandTotal().'00',
            'currency' => 'INR',
        ];

        $response = $api->order->create($data);
        $order_id = $response['id'];
        $data = [
            '_view_file' => 'cart/checkout',
            '_page_title' => 'Checkout',
            'body' => [
                'key_id' => $this->key_id,
                'grand_total' => $this->getGrandTotal(),
                'order_id' => $order_id,
                'customer' => [
                    'name' => $name,
                    'email' => $email,
                    'mobile' => $mobile
                ]
            ]
        ];

        return view('layouts/main', $data);
    }

    public function success()
    {
        $data = [
            '_page_title' => 'Payment Successful',
            '_view_file' => 'cart/success',
            'body' => []
        ];
        return view('layouts/main', $data);
    }

    private function getCartSession()
    {
        return $this->session->get('cart');
    }

    private function setCartSession()
    {
        $data = [
            'cart' => [
                [
                    'product_name' => 'School Management System',
                    'product_qty' => 1,
                    'product_price' => 4999
                ],
                [
                    'product_name' => 'Customer Relationship Management System',
                    'product_qty' => 2,
                    'product_price' => 7499
                ],
            ]
        ];
        $this->session->set($data);
    }

    private function getGrandTotal(){
        $sum = 0.00;
        $cartItems = $this->getCartSession();
        foreach ($cartItems as $cartItem) {
            $sum += $cartItem['product_price'] * $cartItem['product_qty'];
        }
        return $sum;
    }


}
