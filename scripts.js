// https://www.w3schools.com/jquery/jquery_css.asp
$(document).on('click', 'button#admin-button', function() {
    $("table#admin").toggle();
});
//https://stackoverflow.com/questions/38007345/how-to-show-ajax-response-as-modal-popup
$(document).on('click', 'div.timeslot a', function() {
    // https://www.w3schools.com/jquery/jquery_dom_get.asp
    var $data = $(this).attr('timeslot-id');
    var url = "http://138.197.129.252/timeslotToCreditsApi.php?timeslotId=" + $data;
    $.ajax({
        type: 'GET',
        url: url,
        success: function(output) {
            alert(output);
            // https://stackoverflow.com/questions/8628413/jquery-find-the-element-with-a-particular-custom-attribute
            $("div[timeslot-id=" + $data + "]").append(output);
        },
        error: function(output) {
            alert("fail");
        }
    });
});

  $( function() {
    $( "#datepicker" ).datepicker();
  } );