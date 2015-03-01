<?php namespace Payment\Payment;
 
use Document;

interface PaymentInterface {
    public function charge(array $data);
}