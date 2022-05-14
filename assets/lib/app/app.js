// window.WebSocketURL = "wss://free3.piesocket.com/v3/1?api_key=dPXptgEOhiaB0hs8Z5uHE15afpBOz2w04hrJn09y";
HookAction = function(triggerElem, action, values, special = null, successCallback = null, failureCallback = null) {
    $(triggerElem).on('click', function(e) {
        e.preventDefault()
        let data = {}
        let error = false
        if (special != null) special()
        values.forEach((item) => {
            data[item] = $(`#${item}`).val()
            if (data[item].length == 0) error = true
        })
        if (!error) Action(action, data, special, successCallback, failureCallback);
        else alert("! [app.js:HookAction]")

    })
}
Action = function(action, data, successCallback = null, failureCallback = null) {
    data.action = action
    $.post('', data, function(response) {
        let r = JSON.parse(response)
        if (r.status == "success") {
            if (successCallback !== null)
                successCallback(response)
        } else {
            if (failureCallback !== null)
                failureCallback(response)

        }
    })
}
Values = function(className, dataId) {
    let values = []
    $(`.${className}`).each((i, element) => {
        let lang = $(element).data(dataId)
        values.push(lang)
    });
    return values;
}
readURL = function(input, elem) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
            $(elem).attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]); // convert to base64 string
    }
}