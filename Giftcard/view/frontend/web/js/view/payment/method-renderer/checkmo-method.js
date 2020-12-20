/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

/* @api */
define([
    'jquery',
    'Magento_Checkout/js/view/payment/default',
], function ($, Component) {
    'use strict';

    var quoteItemData = window.checkoutConfig.quoteItemData;

    return Component.extend({

        defaults: {
            template: 'Vaimo_Giftcard/payment/checkmo'
            // template: 'Magento_OfflinePayments/payment/checkmo'
        },

        quoteItemData: quoteItemData,


        /**
         * Returns send check to info.
         *
         * @return {*}
         */
        getMailingAddress: function () {
            return window.checkoutConfig.payment.checkmo.mailingAddress;
        },

        /**
         * Returns payable to info.
         *
         * @return {*}
         */
        getPayableTo: function () {

            $('#payment_form_checkmo').css("display", "none");

            var allProducts = this.quoteItemData;

            $.each( allProducts, function( key, value ) {

                var productType = value.product.type_id;

                if(productType == 'giftcard_product_type') {
                    $('#payment_form_checkmo').css("display", "block");
                }
            });

            return window.checkoutConfig.payment.checkmo.payableTo;
        },


        getData: function() {

            return {
                'method': this.item.method,
                'additional_data': {
                    'receiver_mail': $('#checkmo_bankowner').val()
                }
            };
        },
    });
});
