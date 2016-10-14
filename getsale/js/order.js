$(document).ready(function () {
    (function (w, c) {
        w[c] = w[c] || [];
        w[c].push(function (getSale) {
            getSale.event('success-order');
            console.log('success-order');
        });
    })(window, 'getSaleCallbacks');
});