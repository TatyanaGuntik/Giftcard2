<?php

namespace Vaimo\Giftcard\Model;

class Giftcard extends \Magento\Framework\Model\AbstractModel
{
    public function _construct()
    {
        $this->_init('Vaimo\Giftcard\Model\ResourceModel\Giftcard');
    }
}