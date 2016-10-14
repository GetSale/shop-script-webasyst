$(document).ready(function () {
    (function (w, c) {
        w[c] = w[c] || [];
        w[c].push(function (getSale) {
            getSale.event('item-view');
            console.log('item-view');
        });
    })(window, 'getSaleCallbacks');
});