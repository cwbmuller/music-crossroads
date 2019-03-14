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


    $('#mozambique').on('click', function() {
        window.location.href = '/mc_countries/mozambique/'
    });
    $('#malawi').on('click', function() {
        window.location.href = '/mc_countries/malawi/'
    });
    $('#zimbabwe').on('click', function() {
        window.location.href = '/mc_countries/zimbabwe/'
    });



    $('#mozambique').hover(function() {
        $('#mozambique-copy').show();
    }, function () {
        $('#mozambique-copy').hide();
    });
    $('#malawi').hover(function() {
        $('#malawi-copy').show();
    }, function () {
        $('#malawi-copy').hide();
    });
    $('#zimbabwe').hover(function() {
        $('#zimbabwe-copy').show();
    }, function () {
        $('#zimbabwe-copy').hide();
    });
});
