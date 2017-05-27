$(document).ready(function(){
  var request;
  console.log('script initiated');

  $("#email-form").submit(function(event){
    if (request) {
      request.abort();
    }
    var $form = $(this);
    console.log('form submitted');

    var $inputs = $form.find("input, select, button, textarea");
    var serializedData = $form.serialize();
    $inputs.prop("disabled", true);

    request = $.ajax({
      url: 'http://sandbox.lovelldsouza.com/remoteemail.php',
      cache: false,
      crossDomain: true,
      type: 'get',
      dataType: 'jsonp',
      data: serializedData,
      success: function(data) {
        if (!data.success) {
          $('#response').removeClass().addClass('alert alert-danger')
          $('#response').fadeIn(1000).html(data.response);
        } else {
          $('#response').removeClass().addClass('alert alert-success')
          $('#response').fadeIn(1000).html(data.response);
        }
      },
      dataType: 'json'
    });
    request.always(function () {
      // Reenable the inputs.
      $inputs.prop("disabled", false);
    });
    event.preventDefault();
  });
});