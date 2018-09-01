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
        
        $(".need-button").on("click", function (event) {
            $.ajax({
              type: "POST",
              url: "organization-details.php?need_id=" + event.target.id,
              success: function() {
                  console.log("success!");
              }
            });
        });
        
        $(".interested-button").on("click", function (event) {
            $.ajax({
              type: "POST",
              url: "organization-details.php?organization_id=" + event.target.id,
              success: function() {
                  $(".interested-button").append("disabled");
                  $(".interested-button").parent().append("aee");
              }
            });
        });
    });
    
