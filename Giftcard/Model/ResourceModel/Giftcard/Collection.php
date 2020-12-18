<?php

namespace Vaimo\Giftcard\Model\ResourceModel\Giftcard;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected function _construct()
    {
        $this->_init('Vaimo\Giftcard\Model\Giftcard', 'Vaimo\Giftcard\Model\ResourceModel\Giftcard');
    }
}