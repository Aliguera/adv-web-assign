$(document).ready(function() {
    $(".btn-danger").on("click", function(event) {
        var deleteId = event.target.id.split("-", 2);
        
        var txt;
        if (confirm("Are you sure you want to delete this need?")) {
            console.log(deleteId[1]);
        } else {
            
        }
        });
});