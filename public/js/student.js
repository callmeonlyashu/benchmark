// Main Class for handling all JS.
var Student = (function(window, $) {

    /*
     * Init Function
     */
    function init() {

        console.log('Javascript Initiated');
    }

    
    /*
     * AJAX handler to submit Form
     */
    function postFormData(event, objDomElement) {

        event.preventDefault();
        event.stopPropagation();

        $html = $(objDomElement).find('button[type="submit"]').html();
        $(objDomElement).find('button[type="submit"]').prop('disabled', true);
        $(objDomElement).find('button[type="submit"]').html('Please wait...');

        $.post(
            $(objDomElement).attr('data-action-url'),
            $(objDomElement).serialize(),
            function(response) {}, 'json').done(function(response) {
            $(objDomElement).find('button[type="submit"]').prop('disabled', false);
            $(objDomElement).find('button[type="submit"]').html($html);
            if ('error' == response.type) {
                toastr.error(response.message);
            } else {
                toastr.success(response.message);
                redirectLocation = $(objDomElement).attr('data-redirect-url');
                if (typeof response.username !== 'undefined' && typeof response.password !== 'undefined') {
                    redirectLocation = $(objDomElement).attr('data-redirect-url') + '/' + response.username + '/' + response.password
                }
                setTimeout(function() {
                    window.location.href = redirectLocation;
                }, 1000);

            }

        });
    };

   

    return {
        init: init,
        postFormData: postFormData,
    };

})(window, jQuery);

$(document).ready(Student.init);