jQuery(document).ready( function($) {

    // Javascript to enable link to tab
    var hash = document.location.hash;
    if (hash) {
        console.log(hash);
        $('.nav-item a[href='+hash+']').tab('show');
    }

    // Change hash for page-reload
    $('a[data-toggle="tab"]').on('show.bs.tab', function (e) {
        window.location.hash = e.target.hash;

    });

    $(".donate-cta").click(function(e) {
        e.preventDefault();
        $('.donate-cta').removeClass('active');
        $(this).addClass('active');
        var amount = $(this).data('amount');
        if(amount == 'other') {
            $('.other-amount').slideDown();
        } else {
            $('.other-amount').slideUp();
            var total = amount;
            var totalcents = total * 100;
            $('.total-amount').html(total).data('amount',totalcents);
        }
        $("body").css("cursor", "default");
    });

    $('#other-amount').on('input', function() {
        var total = $(this).val();
        var totalcents = total * 100;
        $('.total-amount').html(total).data('amount',totalcents); // get the current value of the input field.
    });

    $('.sponsor-select').change( function() {
        // This does the ajax request
        var amount = $('#student-select').data('amount');
        var total = $('#student-select').val() * $('#month-select').val() * amount;
        var totalcents = total * 100;

        $('.total-amount').html(total).data('amount',totalcents);
    });

    $('.donate-submit').click( function(e) {

        e.preventDefault();
        var amount = $('.total-amount').data('amount');
        var title = $(this).data('title');
        handler.open({
            name: 'Music Crossroads Donation',
            description: 'Music Crossroads donation - ' + title,
            currency: 'eur',
            amount: amount,
            //billingAddress: true,
            //shippingAddress: true
        });
    });
});

var handler = StripeCheckout.configure({
    key: 'pk_live_nIYc4oFjTZSczmVPdFKXzEG3',
    image: '/wp-content/themes/musiccrossroads/media/mc-logo.png',
    locale: 'auto',
    token: function(token) {
        // You can access the token ID with `token.id`.
        // Get the token ID to your server-side code for use.
    }
});

// Close Checkout on page navigation:
window.addEventListener('popstate', function() {
    handler.close();
});