jQuery(document).ready( function($) {


    // Smooth scroller for anchor tags
    $('a[href*="#_"]:not([href="#"])').click(function() {
        if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
            var target = $(this.hash);
            target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
            if (target.length) {
                $('html, body').animate({
                    scrollTop: target.offset().top - 120
                }, 1000);
                return false;
            }
        }
    });



    $("#mc-pango-subscribe").click(function(e) {
        e.preventDefault();
        $("body").css("cursor", "wait");
        var email = jQuery("#email-address").val();
        var fname = jQuery("#first-name").val();
        var lname = jQuery("#last-name").val();
        var other_text = jQuery("#extra-info").val();
        // don't send if we have other text
        if(email !== '')
            jQuery.ajax({
                type: "POST",
                async: true,
                data: { email: email,
                    fname: fname,
                    lname: lname
                },
                url: "/wp-content/themes/musiccrossroads/mc-submit.php",
                dataType: "html",
                success: function (data)
                { jQuery("#mc_pango_signup").html(data); },
                error: function (err)
                { alert(err.responseText);}
            });
        $("body").css("cursor", "default");
    });
});


(function() {

    // This is the bare minimum JavaScript. You can opt to pass no arguments to setup.
    // e.g. just plyr.setup(); and leave it at that if you have no need for events
    //    var instances = plyr.setup({
    //        // Output to console
    //        debug: false
    //    });
    //var players = plyr.get();
    //console.log(instances);
    //instances[1].play();
    //
    //"use strict";

    var toggles = document.querySelectorAll(".c-hamburger");

    for (var i = toggles.length - 1; i >= 0; i--) {
        var toggle = toggles[i];
        toggleHandler(toggle);
    };

    function toggleHandler(toggle) {
        toggle.addEventListener( "click", function(e) {
            e.preventDefault();
            (this.classList.contains("is-active") === true) ? this.classList.remove("is-active") : this.classList.add("is-active");
        });
    }

})();

