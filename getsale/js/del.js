$(document).ready(function () {
    (function (w, c) {
        w[c] = w[c] || [];
        w[c].push(function (getSale) {
            getSale.event('del-from-cart');
            console.log('del-from-cart');
        });
    })(window, 'getSaleCallbacks');
});