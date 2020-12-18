<?php

namespace Vaimo\Giftcard\Block;

use Magento\Framework\View\Element\Template\Context;

class TestBlock extends \Magento\Framework\View\Element\Template
{
    protected $collection;

    public function __construct(
        Context $context,
        \Vaimo\AdditionalCheckmoData\Model\ResourceModel\Giftcard\CollectionFactory $profileCollection,
        array $data = []
    )
    {
        $this->collection = $profileCollection;
        parent::__construct($context, $data);
    }

    public function getValue()
    {
//        $somedata = $this->collection->create();
//        $df = $somedata->getData();
        return "111";
    }
}