$(document).ready(
    function() {
        //About us and need list tabs (shows and hides)
        $(".needs-list").hide();
        
        $(".needs-list-button").click(function() {
            $(".about-us").hide();
            $(".needs-list").removeClass("d-none");
            $(".needs-list").show();
        });
        
        $(".about-us-button").click(function() {
            $(".needs-list").hide();
            $(".about-us").show();
        });
        
        //i can help button clicked function
        $(".need-button").on("click", function (event) {
            $.ajax({
              type: "POST",
              url: "organization-details.php?need_id=" + event.target.id,
              success: function() {
                  $("#" + event.target.id).addClass("disabled");
                  $("#" + event.target.id).parent().parent().prev().fadeIn(800);
                  $("#" + event.target.id).parent().parent().prev().removeClass("d-none");
                  
                  setTimeout(function() {
                      $("#" + event.target.id).parent().parent().prev().fadeOut(800);
                  }, 10000);
                  console.log(event.target.id);
              }
            });
        });
    });
    
