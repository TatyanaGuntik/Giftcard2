<?php


namespace Vaimo\Giftcard\Model;

use Vaimo\Giftcard\Model\ResourceModel\Giftcard\CollectionFactory;
use Vaimo\Giftcard\Model\GiftcardFactory;
use Magento\Cms\Api\Data\PageInterface;

class GiftcardRepository
{
    protected $collection;

    protected $giftcardFactory;

    public function __construct(CollectionFactory $collection, GiftcardFactory $giftcardFactory)
    {
        $this->collection = $collection;
        $this->giftcardFactory = $giftcardFactory;
    }

    public function getData()
    {
        $data = $this->collection->create();
        $item = $data->getItems();
        return $item;
    }

    public function getByOrderId($id)
    {
        $data = $this->collection->create();
        $item = $data->getItemsByColumnValue('order_id', $id);
        return $item;
    }

    public function save($data)
    {
        $giftcard = $this->giftcardFactory->create();
        $giftcard->setData($data);
        $giftcard->save();
    }
}