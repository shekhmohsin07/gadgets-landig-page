/* Gadget Care storefront scripts */

/* ---------- Pixel event helper (works with whichever pixels are enabled) ---------- */
window.gcTrack = function (name, d) {
    d = d || {};
    var ids = d.ids || [];
    try {
        if (window.fbq) {
            fbq('track', name, {
                content_ids: ids, content_name: d.name, content_type: 'product',
                value: d.value, currency: 'BDT', num_items: d.qty
            });
        }
    } catch (e) {}
    try {
        if (window.ttq) {
            var tt = { Purchase: 'CompletePayment' };
            ttq.track(tt[name] || name, {
                content_id: ids[0], content_name: d.name, content_type: 'product',
                value: d.value, currency: 'BDT', quantity: d.qty
            });
        }
    } catch (e) {}
    try {
        if (window.gtag) {
            var gm = { ViewContent: 'view_item', InitiateCheckout: 'begin_checkout', Purchase: 'purchase' };
            var payload = {
                currency: 'BDT', value: d.value,
                items: [{ item_id: ids[0], item_name: d.name, price: d.price, quantity: d.qty }]
            };
            if (d.orderId) payload.transaction_id = d.orderId;
            gtag('event', gm[name] || name, payload);
        }
    } catch (e) {}
    try {
        // Google Tag Manager: push a plain event you can use as a trigger
        window.dataLayer = window.dataLayer || [];
        window.dataLayer.push({
            event: 'gc_' + name.toLowerCase(),
            ecommerce: { currency: 'BDT', value: d.value, transaction_id: d.orderId,
                items: [{ item_id: ids[0], item_name: d.name, price: d.price, quantity: d.qty }] }
        });
    } catch (e) {}
};

/* ---------- Landing page: order form ---------- */
document.addEventListener('DOMContentLoaded', function () {
    var form = document.getElementById('orderForm');

    document.querySelectorAll('.js-order-now').forEach(function (a) {
        a.addEventListener('click', function (e) {
            var t = document.getElementById('order-form');
            if (t) { e.preventDefault(); t.scrollIntoView({ behavior: 'smooth', block: 'start' }); }
        });
    });

    // Highlight selected choice
    function syncChoices() {
        document.querySelectorAll('.choice').forEach(function (c) {
            var r = c.querySelector('input[type=radio]');
            c.classList.toggle('active', !!(r && r.checked));
        });
    }

    if (!form || !window.GC_PRODUCT) { syncChoices(); return; }

    var qtyEl = document.getElementById('qty');
    var fmt = function (n) { return '৳' + Number(n).toLocaleString('en-US'); };

    function recalc() {
        var qty = Math.max(1, Math.min(10, parseInt(qtyEl.value, 10) || 1));
        qtyEl.value = qty;
        var zone = form.querySelector('input[name=delivery_zone]:checked');
        var fee = zone ? parseInt(zone.dataset.fee, 10) || 0 : 0;
        var price = GC_PRODUCT.price * qty;
        document.getElementById('sumPrice').textContent = fmt(price);
        document.getElementById('sumFee').textContent = fmt(fee);
        document.getElementById('sumTotal').textContent = fmt(price + fee);
        syncChoices();
    }

    document.getElementById('qtyMinus').addEventListener('click', function () { qtyEl.value = (parseInt(qtyEl.value, 10) || 1) - 1; recalc(); });
    document.getElementById('qtyPlus').addEventListener('click', function () { qtyEl.value = (parseInt(qtyEl.value, 10) || 1) + 1; recalc(); });
    form.querySelectorAll('input[name=delivery_zone]').forEach(function (r) { r.addEventListener('change', recalc); });
    recalc();

    // Pixel: InitiateCheckout the first time the visitor touches the form
    var started = false;
    form.addEventListener('focusin', function () {
        if (started) return;
        started = true;
        var qty = parseInt(qtyEl.value, 10) || 1;
        window.gcTrack('InitiateCheckout', {
            ids: [String(GC_PRODUCT.id)], name: GC_PRODUCT.name,
            value: GC_PRODUCT.price * qty, price: GC_PRODUCT.price, qty: qty
        });
    });

    // Client-side check + stop double submits
    form.addEventListener('submit', function (e) {
        var name = form.customer_name.value.trim();
        var phone = form.phone.value.trim().replace(/[\s-]/g, '');
        var addr = form.address.value.trim();
        var ok = true;

        // Bengali digits -> English digits
        phone = phone.replace(/[০-৯]/g, function (d) { return '০১২৩৪৫৬৭৮৯'.indexOf(d); });
        form.phone.value = phone;

        [['customer_name', name], ['address', addr]].forEach(function (p) {
            var el = form[p[0]];
            el.classList.toggle('is-invalid', !p[1]);
            if (!p[1]) ok = false;
        });
        var phoneOk = /^(?:\+?88)?01[3-9]\d{8}$/.test(phone);
        form.phone.classList.toggle('is-invalid', !phoneOk);
        if (!phoneOk) { ok = false; }

        if (!ok) {
            e.preventDefault();
            var first = form.querySelector('.is-invalid');
            if (first) { first.scrollIntoView({ behavior: 'smooth', block: 'center' }); first.focus(); }
            if (!phoneOk && phone) alert('সঠিক ১১ ডিজিটের মোবাইল নাম্বার দিন (যেমন 01XXXXXXXXX)');
            return;
        }
        var btn = document.getElementById('submitBtn');
        btn.disabled = true;
        btn.textContent = 'অর্ডার হচ্ছে...';
    });
});

/* ---------- Gallery thumbnails follow the carousel ---------- */
document.addEventListener('DOMContentLoaded', function () {
    var g = document.getElementById('gallery');
    if (!g) return;
    g.addEventListener('slid.bs.carousel', function (e) {
        document.querySelectorAll('.thumbs button').forEach(function (b, i) {
            b.classList.toggle('active', i === e.to);
        });
    });
});
