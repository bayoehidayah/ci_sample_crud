<script>
    $(document).ready(function() {
        $('#tableUserPass').DataTable({
            "processing": true,
            "serverSide": true,
            "ordering": true, 
            "order": [[ 0, 'asc' ]],
            "ajax":
            {
                "url": "<?php echo base_url('pegawai/user-password/get-user') ?>",
                "type": "POST"
            },
            "deferRender": true,
            "aLengthMenu": [[10, 50, 100],[ 10, 50, 100]],
            "columns": [
                { "data": "kdepeg" }, 
                { "data": "email" }, 
                { "data": "tipe" },
                { "render": function ( data, type, row ) {
                        // var html  = '<a class="btn btn-sm btn-clean btn-icon btn-icon-md" href="<?= base_url("pegawai/user-password/"); ?>'+row.kdepeg+'" title="Edit User Password"><i class="la la-edit"></i></a>';
                        var html = "";
                        if(row.tipe != "Super") {
                            html = '<a href="javascript:void(0);" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Delete User Password" onclick="delUser(\''+row.kdepeg+'\')"><i class="la la-trash"></i></a>';
                        }
                        return html;
                    }
                },
            ],
        });
    });

    function delUser(id){
        swal.fire({
            title : "Perhatian!",
            html : "Data akun tidak dapat dikembalikan",
            type : "info",
            showCancelButton : true,
            showLoaderOnConfirm : true,
            preConfirm : () => {
                return fetch("<?= base_url("pegawai/user-password/del-user-password/"); ?>" + id)
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
                    swal.showValidationMessage("Terjadi kesalahan dalam menghapus akun");
                })
            },
            allowOutsideClick : () => !swal.isLoading()
        }).then((result) => {
            if(result.value){
                swal.fire({
                    title : "Success!",
                    text : "Akun telah berhasil dihapus",
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
