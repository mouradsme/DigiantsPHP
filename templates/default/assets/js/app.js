$(document).ready(function() {
    window.noticeSkipped.forEach((item) => {
        console.log(item)
    })

    $(this).on('click', '.notice', function(e) {
        let id = $(this).data('id')
        $(this).fadeOut(660)
    })
});