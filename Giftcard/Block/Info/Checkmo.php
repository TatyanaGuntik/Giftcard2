<?php

namespace Vaimo\Giftcard\Block\Info;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Vaimo\Giftcard\Model\GiftcardRepository;

class Checkmo extends Template
{
    protected $giftCard;
    protected $request;

    public function __construct(
        Context $context,
        GiftcardRepository $giftCard,
        \Magento\Framework\App\RequestInterface $request,
        array $data = [])
    {
        $this->giftCard = $giftCard;
        $this->request = $request;
        parent::__construct($context, $data);
    }

    public function getGiftData()
    {
        $order_id = $this->request->getParam('order_id');
        $giftCardField = $this->giftCard->getByOrderId($order_id);
        $giftCardData = $giftCardField[0]->getData();
        $mail = $giftCardData['receiver_mail'];
        $code = $giftCardData['giftcard_code'];

        $data = [];
        array_push($data, $mail);
        array_push($data, $code);
        return $data;
    }
}
