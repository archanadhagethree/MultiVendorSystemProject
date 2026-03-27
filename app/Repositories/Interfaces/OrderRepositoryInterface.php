<?php

namespace App\Repositories\Interfaces;

interface OrderRepositoryInterface
{
    public function create(array $data);
    public function addItem($orderId, array $data);
    public function updateTotal($orderId, $total);
    public function createPayment(array $data);
}