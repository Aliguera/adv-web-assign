$(document).ready(function() {
    //delete need function
    $(".btn-danger").on("click", function(event) {
        var deleteId = event.target.id.split("-", 2);
        
        var txt;
        if (confirm("Are you sure you want to delete this need?")) {
            
            $.ajax({
              type: "POST",
              url: "organization-needs.php?need_id=" + deleteId[1],
              success: function() {
                console.log("organization-needs.php?need_id=" + deleteId[1]);
                $("#"+event.target.id).parent().parent().fadeOut(700);
              }
            });
        } else {
            
        }
        });
});