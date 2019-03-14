jQuery(document).ready( function($) {

    var tabChange = function () {
        var tabs = $('.nav-impact > li');
        var active = $('.nav-impact > li a.active');
        var next = active.parent().next('li').length ? active.parent().next('li').find('a') : tabs.filter(':first-child').find('a');
        // Use the Bootsrap tab show method

        next.tab('show');
        //next.parents('li').addClass('active');

    };
    // Tab Cycle function
    var tabCycle = setInterval(tabChange, 3000);

    // Tab click event handler
    $('.nav-impact a').on('click', function (e) {
        e.preventDefault();
        // Stop the cycle
        clearInterval(tabCycle);
        // Show the clicked tabs associated tab-pane
        $(this).tab('show');
        // Start the cycle again in a predefined amount of time
        setTimeout(function () {
            //tabCycle = setInterval(tabChange, 5000);
        }, 15000);
    });


    $("body").addClass('home-nav');
    var topofDiv = $("header").offset().top; //gets offset of header
    var height = $("header").outerHeight(); //gets height of header

    $(window).scroll(function(){
        if($(window).scrollTop() > (topofDiv + height)){
            $("body").removeClass('home-nav');
        }
        else{
            $("body").addClass('home-nav');
        }
    });
});
