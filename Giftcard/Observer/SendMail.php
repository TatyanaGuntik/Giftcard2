<?php

namespace Vaimo\Giftcard\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Vaimo\Giftcard\Helper\Email;

class SendMail implements ObserverInterface
{
    protected $email;

    public function __construct(
        Email $email
    )
    {
        $this->email = $email;
    }

    public function execute(Observer $observer)
    {
        $order = $observer->getEvent()->getOrder();
        $data = $order->getAllItems();

//        $dat = $this->data->getCollection();

        foreach ($data as $item) {
            $productType = $item->getProductType();

            if ($productType == 'giftcard_product_type') {
                $this->email->sendEmail();
//                $giftPrice = $item->getPrice();
//                $code = $this->generateGiftCode->generateGiftCode($giftPrice);
//
//                if ($order->getState() == 'complete') {
//
//                    $paymentData = $order->getPayment()->getData();
//                    $recieverMail = $paymentData['receiver_mail'];
//                    $this->email->sendEmail();
//                }
            }
        }
    }
}