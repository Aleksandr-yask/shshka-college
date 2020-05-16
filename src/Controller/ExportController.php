<?php

namespace App\Controller;

use App\Repository\OrdersRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ExportController extends AbstractController
{
    /**
     * @Route("/export", name="export")
     */
    public function index(OrdersRepository $repository)
    {

        $export = [];
        $export[] = [
          'Дата создания заказа',
          'ID машины',
          'Номер машины',
          'Название категории машины',
          'Залог',
          'Название машины',
          'Цена',

          'ID клиента',
          'ФИО',
          'Социальное положение',
            'Адрес',
            'Номер телефона'
        ];
        $orders = $repository->findAll();
        foreach ($orders as $order) {
            $export[] = [
              $order->getOrderDatetime()->format('d-m-Y H:i:s'),
              $order->getCars()->getId(),
              $order->getCars()->getAutoNumber(),
              $order->getCars()->getCategories()->getName(),
              $order->getCars()->getChattel(),
              $order->getCars()->getName(),
              $order->getCars()->getPrice(),
                $order->getClients()->getId(),
                $order->getClients()->getFio(),
                $order->getClients()->getStatus(),
                $order->getClients()->getAdress(),
                $order->getClients()->getPhone()
            ];
        }

        $fp = fopen('orders.csv', 'w');
        fputs($fp, chr(0xEF) . chr(0xBB) . chr(0xBF)); // BOM

        foreach ($export as $fields) {
            fputcsv($fp, $fields, ';');
        }

        fclose($fp);

        return $this->redirect('/orders.csv');
    }
}
