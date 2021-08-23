<script>
    $(document).ready(function(){
        $("#tableValidator").dataTable();
    });

    function delValidator(id){
        swal.fire({
            title : "Perhatian!",
            html : "Data akun tidak dapat dikembalikan",
            type : "info",
            showCancelButton : true,
            showLoaderOnConfirm : true,
            preConfirm : () => {
                return fetch("<?= base_url("pegawai/validator/del-validator/"); ?>" + id)
                .then(response => {
                    if(!response.ok){
                        throw new Error(response.statusText);
                    }
                    return response.json()
                })
                .then(data => {
                    if(!data.result){
                        swal.showValidationMessage(data.msg);
                    }
                })
                .catch(error => {
                    swal.showValidationMessage("Terjadi kesalahan dalam menghapus akun validator");
                })
            },
            allowOutsideClick : () => !swal.isLoading()
        }).then((result) => {
            if(result.value){
                swal.fire({
                    title : "Success!",
                    text : "Akun validator telah berhasil dihapus",
                    type : "success",
                    timer : 2000,
                    onBeforeOpen: () => {
                        Swal.showLoading()
                    }
                }).then((result) => {
                    if(result.dismiss === Swal.DismissReason.timer){
                        location.reload();
                    }
                });
            }
        });
    } 
</script>