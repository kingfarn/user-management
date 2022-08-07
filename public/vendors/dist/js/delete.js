const Toast = Swal.mixin({
    toast: true,
    position: "top-end",
    showConfirmButton: false,
    timer: 2500,
});

$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
});
function deleteData(url, id) {
    var base_url = window.location.origin + "/";

    swal({
        title: "Are you sure?",
        text: "Do You Want To Delete This Item ?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete) {
            $.ajax({
                url: base_url + url + id,
                type: "POST",
                data: { _method: "DELETE" },
                success: function (data) {
                    Toast.fire({
                        type: "success",
                        title: "Item has been deleted!",
                        icon:"success",
                    }).then((result) => {
                        location.reload();
                    });
                },
                error: function () {
                    Toast.fire({
                        type:"error",
                        text: "could not be deleted!",
                        icon: "error",
                    });
                },
            });
        } else {
            Toast.fire({
                type:"info",
                text: "Cancled!",
                icon:"info",
            });
        }
    });
}
