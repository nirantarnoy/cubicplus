function showAlert(alert_type,msg){
    const Toast = Swal.mixin({
        toast: true,
        // position: 'top-center',
        showConfirmButton: true,

        timer: 3000
    });
    Toast.fire({
        type: alert_type,
        position: 'top-center',
        showConfirmButton: true,
        title: msg
    });
}