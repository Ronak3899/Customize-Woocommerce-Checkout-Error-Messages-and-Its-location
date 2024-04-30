jQuery(function ($) {
    'use strict';
    addInlineMessages();
    // Implementation
    // Listen to js event
    $(document.body).on('updated_checkout', function() {
        addInlineMessages();
    });
    function addInlineMessages() {
        var woocommerceErrorsEl = $('.woocommerce-error');
        var woocommerceInlineErrorsEl = $('li[data-error-for]', woocommerceErrorsEl);
        var inlineErrorMessagesEl = $('.js-custom-error-message');
        // as we use ajax submitting hide old validation messages
        if(inlineErrorMessagesEl.length) {
            inlineErrorMessagesEl.hide();
        }
        if(woocommerceInlineErrorsEl.length) {
            woocommerceInlineErrorsEl.each(function () {
                var errorEl = $(this);
                var errorText = $.trim(errorEl.text());
                var targetFieldId = errorEl.data('error-for');
                if(errorText && targetFieldId) {
                    var targetFieldEl = $('#' + targetFieldId);
                    var errorMessageField = $('.js-custom-error-message', targetFieldEl);
                    if(targetFieldEl.length && errorMessageField.length) {
                        targetFieldEl.removeClass('woocommerce-validated');
                        targetFieldEl.addClass('woocommerce-invalid');
                        errorMessageField.text(errorText);
                        errorMessageField.show();
                        errorEl.hide();
                    }
                }
            });
            if(woocommerceInlineErrorsEl.filter(':visible').length === 0) {
                woocommerceErrorsEl.hide();
                if(inlineErrorMessagesEl.filter(':visible').length > 0) {
                    scrollToElement(inlineErrorMessagesEl.filter(':visible').first());
                }
            } else {
                $('li:not([data-error-for])', woocommerceErrorsEl).hide();
                scrollToElement(woocommerceErrorsEl);
            }
        }
    }
    function scrollToElement(el) {
        if(el.length) {
            $([document.documentElement, document.body]).animate({
                scrollTop: el.offset().top - 100
            }, 2000);
        }
    }
    // event listeners
    $(document.body).on('checkout_error', function (event) {
        jQuery('html, body').stop();
        addInlineMessages();
    });
});
