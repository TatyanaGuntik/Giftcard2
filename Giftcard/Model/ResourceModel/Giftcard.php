<?php

namespace Vaimo\Giftcard\Model\ResourceModel;

class Giftcard extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    public function _construct()
    {
        $this->_init('giftcard_data', 'id');
    }
}