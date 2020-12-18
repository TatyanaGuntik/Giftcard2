<?php

namespace Vaimo\Giftcard\Helper;

use Magento\Framework\App\Bootstrap;

class GenerateGiftCode extends \Magento\Framework\App\Helper\AbstractHelper
{
    public function generateGiftCode($giftPrice)
    {

        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
//        $state = $objectManager->get('\Magento\Framework\App\State');
//        $state->setAreaCode('frontend');
//        $state->setAreaCode('adminhtml');

        $coupon['name'] = 'GiftCardCoupon';
        $coupon['desc'] = 'Discount for GiftCardCoupon.';
        $coupon['start'] = date('Y-m-d');
        $coupon['end'] = '';
        $coupon['max_redemptions'] = 1;
        $coupon['discount_type'] = 'by_fixed';
        $coupon['discount_amount'] = $giftPrice; //discount giftPrice$
        $coupon['flag_is_free_shipping'] = 'no';
        $coupon['redemptions'] = 1;

        $couponGenerator = $objectManager->get('\Magento\SalesRule\Model\Coupon\Codegenerator'); // magento coupon code generator
        $couponHelper = $objectManager->get('\Magento\SalesRule\Helper\Coupon'); //coupon code helper to ger format
        $couponGenerator->setFormat($couponHelper::COUPON_FORMAT_ALPHANUMERIC); // set format or random code
        $couponGenerator->setLength(8); // length of coupon code upto 32
        $couponCode = $couponGenerator->generateCode(); //generate code
        $coupon['code'] = $couponCode;

        $shoppingCartPriceRule = $objectManager->create('\Magento\SalesRule\Model\Rule');
        $shoppingCartPriceRule->setName($coupon['name'])
            ->setDescription($coupon['desc'])
            ->setFromDate($coupon['start'])
            ->setToDate($coupon['end'])
            ->setUsesPerCustomer($coupon['max_redemptions'])
            ->setCustomerGroupIds(array('1', '2', '3',))
            ->setIsActive(1)
            ->setSimpleAction($coupon['discount_type'])
            ->setDiscountAmount($coupon['discount_amount'])
            ->setDiscountQty(1)
            ->setApplyToShipping($coupon['flag_is_free_shipping'])
            ->setTimesUsed($coupon['redemptions'])
            ->setWebsiteIds(array('1'))
            ->setCouponType(2)
            ->setCouponCode($coupon['code'])
            ->setUsesPerCoupon(NULL);
        $shoppingCartPriceRule->save();

        return $coupon['code'];
    }
}