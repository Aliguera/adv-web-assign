$(document).ready(
    function() {
        $(".needs-list").hide();
        
        $(".needs-list-button").click(function() {
            $(".about-us").hide();
            $(".needs-list").show();
        });
        
        $(".about-us-button").click(function() {
            $(".needs-list").hide();
            $(".about-us").show();
        });
    });