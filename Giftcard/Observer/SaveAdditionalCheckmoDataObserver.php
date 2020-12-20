<?php

namespace Vaimo\Giftcard\Observer;

use Magento\Framework\Event\Observer as EventObserver;
use Magento\Framework\Event\ObserverInterface;

use Vaimo\Giftcard\Helper\GenerateGiftCode;
use Vaimo\Giftcard\Model\GiftcardRepository;

class SaveAdditionalCheckmoDataObserver implements ObserverInterface
{
    protected $_inputParamsResolver;
    protected $_quoteRepository;
    protected $logger;
    protected $_state;
    protected $generateGiftCode;
    protected $giftRepository;

    public function __construct(
        \Magento\Webapi\Controller\Rest\InputParamsResolver $inputParamsResolver,
        \Magento\Quote\Model\QuoteRepository $quoteRepository,
        \Psr\Log\LoggerInterface $logger,
        \Magento\Framework\App\State $state,
        GenerateGiftCode $generateGiftCode,
        GiftcardRepository $giftRepository
    )
    {
        $this->_inputParamsResolver = $inputParamsResolver;
        $this->_quoteRepository = $quoteRepository;
        $this->logger = $logger;
        $this->_state = $state;
        $this->generateGiftCode = $generateGiftCode;
        $this->giftRepository = $giftRepository;
    }

    public function execute(EventObserver $observer) {

        $inputParams = $this->_inputParamsResolver->resolve();

        if($this->_state->getAreaCode() != \Magento\Framework\App\Area::AREA_ADMINHTML){

            foreach ($inputParams as $inputParam) {
                if ($inputParam instanceof \Magento\Quote\Model\Quote\Payment) {

//                    save order id, receiver_mail and gift code to custom table
                    $receiver_mail = $inputParam->getData('additional_data');
                    $mail  = $receiver_mail['receiver_mail'];

                    if ($mail != "") {
                        $paymentOrder = $observer->getEvent()->getPayment();
                        $order = $paymentOrder->getOrder();
                        $order_id = $order->getId();

                        $price = null;
                        $items = $order->getAllItems();

                        foreach ($items as $item) {
                            $productType = $item->getProductType();
                            if ($productType == 'giftcard_product_type') {
                                $price = $item->getPrice();
                            }
                        }

                        $code = $this->generateGiftCode->generateGiftCode($price);
                        $data = ['order_id'=> $order_id, 'receiver_mail' => $mail, 'giftcard_code' => $code];

                        $this->giftRepository->save($data);
                    }
                }
            }
        }
    }
}