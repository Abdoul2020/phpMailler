(function($) {

    "use strict";

    document.getElementById("buttonmail").addEventListener("click", message_content);

    $(document).ready(function() {
        $('.alert-danger').hide();
        $('.alert-success').hide();
        $('.alert-warning').hide();
    });



    function message_content() {
        //document.getElementById("buttonmail")
        $('.alert-success').hide();
        $('.alert-danger').hide();
        $('.alert-warning').show();
        setTimeout(
            function() {
                console.log(localStorage.getItem('mailsended'));
                if (localStorage.getItem('mailsended') !== null) {
                    if (localStorage.getItem('mailsended') == 'false') {
                        $('.alert-danger').show();
                        $('.alert-success').hide();
                        $('.alert-warning').hide();
                    } else if (localStorage.getItem('mailsended') == 'true') {
                        $('.alert-success').show();
                        $('.alert-danger').hide();
                        $('.alert-warning').hide();
                    } else {
                        $('.alert-danger').hide();
                        $('.alert-success').hide();
                        $('.alert-warning').hide();
                    }
                } else {
                    $('.alert-danger').hide();
                    $('.alert-success').hide();
                    $('.alert-warning').hide();
                }
            }, 3500);
    }




})(jQuery);