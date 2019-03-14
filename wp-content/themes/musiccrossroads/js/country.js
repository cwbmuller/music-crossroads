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


    $('.team-square').on('click', function() {
        $('#team-modal').modal('show');
        $('#team-modal .member-image').attr('src',$(this).data('image'));
        $('#team-modal .member-description').html($(this).data('content'));
        $('#team-modal .member-name').html($(this).data('name'));
        $('#team-modal .member-country').html($(this).data('cat'));
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
});
