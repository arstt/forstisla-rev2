$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    $(document).on('submit', '.deleted', function(e){
        e.preventDefault()
        var form = $(this);
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
          }).then((result) => {
            if (result.isConfirmed) {
              $.ajax({
                  url: $(form).attr("action"),
                  method: "DELETE",
                  success: function(res){
                    Swal.fire({
                      title: 'Deleted!',
                      text: `The data has been deleted.`,
                      icon: 'success',
                      showConfirmButton: false,
                      timer: 1500
                    }).then((result) => {
                        window.location.href = "";
                    })
                  },
                  error: (res) => {
                    console.log(res.responseJSON)
                    Swal.fire("Oops", "Something Wrong!", "error");
                  }
              })
            }
          })
    })
})