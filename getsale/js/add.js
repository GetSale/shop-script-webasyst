$(document).ready(function () {
    (function (w, c) {
        w[c] = w[c] || [];
        w[c].push(function (getSale) {
            getSale.event('add-to-cart');
            console.log('add-to-cart');
        });
    })(window, 'getSaleCallbacks');
});