$(document).ready(function() {
    $("#Search").keypress(function(e) {
        if (e.which == 10 || e.which == 13) {
            let v = $(this).val()
            Action('search', { q: v }, function(response) {
                let e = JSON.parse(response)
                console.log(e)
                $('#LiveSearchResults').html(e.message)
            });

        }
    });
})