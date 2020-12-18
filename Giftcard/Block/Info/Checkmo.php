<?php

namespace Vaimo\Giftcard\Block\Info;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Vaimo\Giftcard\Model\GiftcardFactory;

class Checkmo extends Template
{

    protected $giftCard;

    public function __construct(
        Context $context,
        GiftcardFactory $giftCard,
        array $data = [])
    {
        $this->giftCard = $giftCard;
        parent::__construct($context, $data);
    }


    public function getReceiverMail()
    {

//        $objectManager =   \Magento\Framework\App\ObjectManager::getInstance();
//        $connection = $objectManager->get('\Vaimo\Giftcard\Model\GiftcardFactory')->getConnection('\Vaimo\Giftcard\Model\GiftcardFactory::DEFAULT_CONNECTION');
//        $result = $connection->fetchAll("SELECT * FROM receiver_mail");
//        return $this->giftCard->create()->getCollection();
//        return $result;
    }
}



//use Magento\Framework\View\Element\Template\Context;
//
//class Checkmo extends \Magento\Payment\Block\Info
//{
//
//    protected $collection;
//
//    public function __construct(
//        Context $context,
//        array $data = []
//    )
//    {
//        $this->collection = $context;
//        parent::__construct($context, $data);
//    }
//
//    public function getReceiverMail() {
//
//
//        $id = $this->collection->getRequest()->getParam('order_id');
//
//        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
//        $order = $objectManager->create('Magento\Sales\Api\Data\OrderInterface')->load($id);
//
//        $data = $order->getPayment()->getData('receiver_mail');
//        return $data;
//
//    }


//    protected $paymentCollection;
//
//    /**
//     * @var string
//     */
//    protected $_payableTo;
//
//    /**
//     * @var string
//     */
//    protected $_mailingAddress;
//
//    /**
//     * @var string
//     */
//    protected $_template = 'Vaimo_Giftcard::info/checkmo.phtml';
//
//
//    /**
//     * Enter description here...
//     *
//     * @return string
//     */
//
//    public function getPayableTo()
//    {
//        if ($this->_payableTo === null) {
//            $this->_convertAdditionalData();
//        }
//        return $this->_payableTo;
//    }
//
//    /**
//     * Enter description here...
//     *
//     * @return string
//     */
//    public function getMailingAddress()
//    {
//        if ($this->_mailingAddress === null) {
//            $this->_convertAdditionalData();
//        }
//        return $this->_mailingAddress;
//    }
//
//    /**
//     * @deprecated 100.1.1
//     * @return $this
//     */
//    protected function _convertAdditionalData()
//    {
//        $this->_payableTo = $this->getInfo()->getAdditionalInformation('payable_to');
//        $this->_mailingAddress = $this->getInfo()->getAdditionalInformation('mailing_address');
//        return $this;
//    }
//
//    /**
//     * @return string
//     */
//    public function toPdf()
//    {
//        $this->setTemplate('Magento_OfflinePayments::info/pdf/checkmo.phtml');
//        return $this->toHtml();
//    }
//}
