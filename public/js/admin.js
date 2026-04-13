function changeStatus(status,id) {
  swal.fire({
    title: "Change Status?",
    text: "Are you sure to change status?",
    icon: "question",
    showCancelButton: !0,
    confirmButtonText: "Yes, do it!",
    cancelButtonText: "No, cancel!",
    reverseButtons: !0
  }).then(function (e) {
    if (e.value === true) {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
          type: 'POST',
          url: "/admin/change_status/" + id,
          data: {status:status, id:id},
          dataType: 'JSON',
          success: function (results) {
              if (results.success === true) {
                  swal.fire("Done!", results.message, "success");
                  // refresh page after 2 seconds
                  setTimeout(function(){
                      location.reload();
                  },2000);
              } else {
                  swal.fire("Error!", results.message, "error");
              }
          }
      });
    } else {
        e.dismiss;
    }

  });
}

$(".btn-delete").click(function(e){
    e.preventDefault();
    var form = $(this).parents("form");

    Swal.fire({
      title: "Are you sure you want to delete?",
      text: "",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Yes, delete it!"
    }).then((result) => {
      if (result.isConfirmed) {
        form.submit();
      }
    });
});