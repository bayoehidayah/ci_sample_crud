<script>
    function delDokumen(id){
        swal.fire({
            title : "Perhatian!",
            html : "ketika anda menghapus data ini, file dokumen yang bersangkutan juga akan terhapus. <br/> <b>Apakah anda yakin?</b>",
            type : "warning",
            showCancelButton : true,
            showLoaderOnConfirm : true,
            preConfirm : () => {
                return fetch("<?= base_url("proses-remun/dokumen-pendukung/delete-dokumen/"); ?>" + id)
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
                    swal.showValidationMessage("Terjadi kesalahan dalam menghapus dokumen");
                })
            },
            allowOutsideClick : () => !swal.isLoading()
        }).then((result) => {
            if(result.value){
                swal.fire({
                    title : "Success!",
                    text : "Dokumen telah berhasil dihapus",
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
        }) 
    }
</script>