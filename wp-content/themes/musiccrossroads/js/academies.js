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
        window.location.href = '/mc_academies/mozambique-academy/'
    });
    $('#malawi').on('click', function() {
        window.location.href = '/mmc_academies/malawi-academy/'
    });
    $('#zimbabwe').on('click', function() {
        window.location.href = '/mc_academies/zimbabwe-academy/'
    });



    $('#mozambique').hover(function() {
        $('#mozambique-academy-copy').show();
        $('#academies-header').hide();
    }, function () {
        $('#mozambique-academy-copy').hide();
        $('#academies-header').show();
    });
    $('#malawi').hover(function() {
        $('#malawi-academy-copy').show();
        $('#academies-header').hide();
    }, function () {
        $('#malawi-academy-copy').hide();
        $('#academies-header').show();
    });
    $('#zimbabwe').hover(function() {
        $('#zimbabwe-academy-copy').show();
        $('#academies-header').hide();
    }, function () {
        $('#zimbabwe-academy-copy').hide();
        $('#academies-header').show();
    });
});
