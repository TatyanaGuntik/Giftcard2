<?php

namespace Vaimo\Giftcard\Observer;

use Magento\Framework\Event\Observer as EventObserver;
use Magento\Framework\Event\ObserverInterface;

use Vaimo\Giftcard\Model\GiftcardFactory;
use Vaimo\Giftcard\Helper\GenerateGiftCode;

//use Vaimo\AdditionalCheckmoData\Model\ResourceModel\Giftcard\CollectionFactory;

class SaveAdditionalCheckmoDataObserver implements ObserverInterface
{
    protected $_inputParamsResolver;
    protected $_quoteRepository;
    protected $logger;
    protected $_state;

    protected $giftcard;
    protected $generateGiftCode;
    protected $collection;

    public function __construct(
        \Magento\Webapi\Controller\Rest\InputParamsResolver $inputParamsResolver,
        \Magento\Quote\Model\QuoteRepository $quoteRepository,
        \Psr\Log\LoggerInterface $logger,
        \Magento\Framework\App\State $state,

        GiftcardFactory $giftcard,
        GenerateGiftCode $generateGiftCode
//        CollectionFactory $profileCollection
    )
    {
        $this->_inputParamsResolver = $inputParamsResolver;
        $this->_quoteRepository = $quoteRepository;
        $this->logger = $logger;
        $this->_state = $state;

        $this->giftcard = $giftcard;
        $this->generateGiftCode = $generateGiftCode;
//        $this->collection = $profileCollection;
    }

    public function execute(EventObserver $observer) {

//        $somedata = $this->collection->create();
//        $df = $somedata->getData();

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
                        $giftcard = $this->giftcard->create();
                        $giftcard->setData($data);
                        $giftcard->save();
                    }

//                    $paymentData = $inputParam->getData('additional_data');
//                    $paymentOrder = $observer->getEvent()->getPayment();
//                    $order = $paymentOrder->getOrder();
//                    $quote = $this->_quoteRepository->get($order->getQuoteId());
//                    $paymentQuote = $quote->getPayment();
//                    $method = $paymentQuote->getMethodInstance()->getCode();

//                if ($method == Checkmo::PAYMENT_METHOD_CHECKMO_CODE) {

//                    if(isset($paymentData['receiver_mail'])){
//                        $paymentQuote->setData('receiver_mail', $paymentData['receiver_mail']);
//                        $paymentOrder->setData('receiver_mail', $paymentData['receiver_mail']);
//                    }

//                }

                }
            }
        }
    }
}