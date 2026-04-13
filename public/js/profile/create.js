
  $("#country_id").on("click change", function(){
      $('#state_id').empty();
      let id = $(this).val();
      $.ajax({
        url : "/states",
        data:{'id':id},
        success: function(result){
          $('#state_id').empty();
          $('#state_id').append('<option value="">Select Option</select>');
          $.each(result.states,function(index, data){
            $('#state_id').append($('<option>',{
                value:data.id
              }).text(data.name)
            );
          })
        }
      });
  });

  $("#state_id").on("change", function(){
     $('#city_id').empty();
      let id = $(this).val();
      $.ajax({
        url : "/cities",
        data:{'id':id},
        success: function(result){
          $('#city_id').empty();
          $('#city_id').append('<option value="">Select Option</select>');
          $.each(result.cities,function(index, data){
            $('#city_id').append($('<option>',{
                value:data.id
              }).text(data.name)
            );
          })
        }
      });
  });

  var i = 0;
  $("#add_mosal").on("click",function(){
    ++i;
    var html = '<div class="mosal_details row mosal_'+i+'" data-attr="mosal_'+i+'">';

    html += '<div class="col-md-5">';
    html += '<label class="form-label">Person Name</label>';
    html += '<input type="text" class="form-control" name="mosal['+i+'][person_name]" />';
    html += '<span class="help-block"><span></span></span>';
    html += '</div>';

    html += '<div class="col-md-5">';
    html += '<label class="form-label">Contact Number</label>';
    html += '<input type="text" class="form-control" name="mosal['+i+'][contact_number]" />';
    html += '<span class="help-block"><span></span></span>';
    html += '</div>';

    html += '<div class="col-md-2 mt-4">';
    html += '<button type="button" data-attr="mosal_'+i+'" class="btn btn-danger remove_mosal">';
    html += '<i class="nav-icon bi bi-file-minus"></i></button>';
    html += '</div>';

    html += '</div>';

    $("#mosal_details").append(html);
  });

  $(document).on('click','.remove_mosal',function () {
      var mosal_attr = $(this).data('attr');
      $("."+mosal_attr).remove();
  });


  $('#profile_form').submit(function(e){
    e.preventDefault();

  $('#profile_form .is-invalid').removeClass('is-invalid');

  // Clear all error messages
  $('#profile_form .help-block strong').text('');

    var url = $(this).attr("action");
    let formData = new FormData(this);

    $.ajax({
          type:'POST',
          url: url,
          data: formData,
          contentType: false,
          processData: false,
          success: (response) => {
              window.location.href = '/admin/profile';                      
          },
          error: function(response){
              $.each(response.responseJSON.errors, function (key, value) {

                let errorText = value[0];
                let input;

                if (key.startsWith('gallery_photo')) {

                    input = $('#profile_form').find('[name="gallery_photo[]"]');

                    input.addClass('is-invalid');
                    input.closest('[class*="col-md"]')
                         .find('.help-block span')
                         .text(errorText);

                    return;
                }

                let parts = key.split('.');
                let inputName = parts[0];

                for (let i = 1; i < parts.length; i++) {
                    inputName += `[${parts[i]}]`;
                }

                input = $('#profile_form').find('[name="' + inputName + '"]');

                if (!input.length) {
                    console.warn("Not found:", inputName);
                }

                if (input.length) {
                    input.addClass('is-invalid');

                    input.closest('[class*="col-md"]')
                         .find('.help-block span')
                         .text(errorText);
                }

            });
          }
     });
  })

  function calculateAge(dateString) {
      var currentDate = new Date();
      var selectedDate = new Date(dateString);

      if (isNaN(selectedDate)) return; // invalid date safety

      var age = currentDate.getFullYear() - selectedDate.getFullYear();
      var m = currentDate.getMonth() - selectedDate.getMonth();

      if (m < 0 || (m === 0 && currentDate.getDate() < selectedDate.getDate())) {
          age--;
      }

      $('#age').val(age);
  }

$('#birth_date').datepicker({
    format: 'yyyy-mm-dd',
    autoclose: true,
    todayHighlight: true,
    endDate: "today",
}).on('changeDate', function(e) {
     calculateAge(e.format('yyyy-mm-dd'));
});

$('#birth_date').on('input change', function () {
  calculateAge($(this).val());
});

$(document).on('change','#show_contact_publicly',function(){
  if($(this).is(':checked')){
     $('#show_contact_publicly').val(1);
  }else{
     $('#show_contact_publicly').val(0);
  }
});