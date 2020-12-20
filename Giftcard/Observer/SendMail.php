<?php

namespace Vaimo\Giftcard\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Vaimo\Giftcard\Helper\Email;

use Vaimo\Giftcard\Model\GiftcardRepository;

class SendMail implements ObserverInterface
{
    protected $email;
    protected $repository;

    public function __construct(
        Email $email,
        GiftcardRepository $repository
    )
    {
        $this->email = $email;
        $this->repository = $repository;
    }

    public function execute(Observer $observer)
    {
        $order = $observer->getEvent()->getOrder();
        $data = $order->getAllItems();

        foreach ($data as $item) {
            $productType = $item->getProductType();

            if ($productType == 'giftcard_product_type') {

                $orderId = $order->getId();
                $giftCardField = $this->repository->getByOrderId($orderId);
                $giftCardData = $giftCardField[0]->getData();
                $mail = $giftCardData['receiver_mail'];
                $code = $giftCardData['giftcard_code'];
                $price = $item->getPrice();

                $this->email->sendEmail($mail, $code, $price);

//                if ($order->getState() == 'complete') {
//                }
            }
        }
    }
}