jQuery(document).ready( function($) {

    $('.news-select').change( function() {
        // This does the ajax request
        var country = $('#country-select').val();
        var category = $('#category-select').val();
        //console.log(month);
        $('#news-container').fadeOut();
        $('.loading-results-news').show();
        $.ajax({
            url: pango_ajax_object.ajaxurl,
            data: {
                'action':'mc_news_ajax',
                country: country,
                category: category

            },
            success:function(items) {
                // This outputs the result of the ajax request
                //var jsonObj = eval(items);
                console.log(items);
                $('.loading-results-news').hide();
                $('#news-container').empty().append( items).fadeIn();
            },
            error: function(errorThrown){
                console.log(errorThrown);
            }
        });
    });
});
