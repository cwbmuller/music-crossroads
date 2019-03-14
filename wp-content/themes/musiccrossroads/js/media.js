jQuery(document).ready( function($) {
    $('#images-select').change( function() {
        // This does the ajax request
        var post_id = $('#images-select').val();
        //console.log(month);
        $('#images-container').fadeOut();
        $('.loading-results-images').show();
        $.ajax({
            url: pango_ajax_object.ajaxurl,
            data: {
                'action':'mc_media_images_ajax',
                post_id: post_id
            },
            success:function(items) {
                // This outputs the result of the ajax request
                //var jsonObj = eval(items);
                console.log(items);
                $('.loading-results-images').hide();
                $('#images-container').empty().append( items).fadeIn();
            },
            error: function(errorThrown){
                console.log(errorThrown);
            }
        });
    });

    $('#videos-select').change( function() {
        // This does the ajax request
        var post_id = $('#videos-select').val();
        //console.log(month);
        $('#videos-container').fadeOut();
        $('.loading-results-videos').show();
        $.ajax({
            url: pango_ajax_object.ajaxurl,
            data: {
                'action':'mc_media_videos_ajax',
                post_id: post_id
            },
            success:function(items) {
                // This outputs the result of the ajax request
                //var jsonObj = eval(items);
                console.log(items);
                $('.loading-results-videos').hide();
                $('#videos-container').empty().append( items).fadeIn();
            },
            error: function(errorThrown){
                console.log(errorThrown);
            }
        });
    });

    $('#music-select').change( function() {
        // This does the ajax request
        var post_id = $('#music-select').val();
        //console.log(month);
        $('#music-container').fadeOut();
        $('.loading-results-music').show();
        $.ajax({
            url: pango_ajax_object.ajaxurl,
            data: {
                'action':'mc_media_music_ajax',
                post_id: post_id
            },
            success:function(items) {
                // This outputs the result of the ajax request
                //var jsonObj = eval(items);
                console.log(items);
                $('.loading-results-music').hide();
                $('#music-container').empty().append( items).fadeIn();
            },
            error: function(errorThrown){
                console.log(errorThrown);
            }
        });
    });

    $('.artist-select').change( function() {
        // This does the ajax request
        var country = $('#country-select').val();
        var genre = $('#genre-select').val();
        //console.log(month);
        $('#artist-container').fadeOut();
        $('.loading-results-artist').show();
        $.ajax({
            url: pango_ajax_object.ajaxurl,
            data: {
                'action':'mc_media_artist_ajax',
                country: country,
                genre: genre

            },
            success:function(items) {
                // This outputs the result of the ajax request
                //var jsonObj = eval(items);
                console.log(items);
                $('.loading-results-artist').hide();
                $('#artist-container').empty().append( items).fadeIn();
            },
            error: function(errorThrown){
                console.log(errorThrown);
            }
        });
    });
});
