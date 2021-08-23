<script>
    var table;
    $(document).ready(function() {
        table = $('#tablePengguna').DataTable({
            'responsive' : true,
            "processing": true,
            "serverSide": true,
            "ordering": true, 
            "order": [[ 0, 'asc' ]],
            "ajax":
            {
                "url": "<?= base_url('pengguna/datas') ?>",
                "type": "POST"
            },
            "deferRender": true,
            "aLengthMenu": [[10, 50, 100],[ 10, 50, 100]],
            "columns": [
                { "data": "id" }, 
                { "data": "nama" }, 
                { "data": "tipe" },
                { "data": "email" },
                { "data": "created_at" },
                { "render": function ( data, type, row ) {
                        var html  = "";

                        if(row.id != "AD-0001"){
                            html += '<a class="btn btn-sm btn-clean btn-icon btn-icon-md" href="<?= base_url("pengguna"); ?>/'+row.id+'" title="Edit Pengguna"><i class="la la-edit"></i></a>';
                            html += '<a href="javascript:void(0);" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Delete Pengguna" onclick="delPengguna(\''+row.id+'\')"><i class="la la-trash"></i></a>';
                        }
                        return html;
                    }
                },
            ],
        });
    });

    function delPengguna(id){
        swal.fire({
            title : "Perhatian!",
            html : "Data pengguna tidak dapat dikembalikan",
            type : "info",
            showCancelButton : true,
            showLoaderOnConfirm : true,
            preConfirm : () => {
                return fetch("<?= base_url("pengguna/delete/"); ?>" + id)
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
                    console.log(error);
                    swal.showValidationMessage("Terjadi kesalahan dalam menghapus pengguna");
                })
            },
            allowOutsideClick : () => !swal.isLoading()
        }).then((result) => {
            if(result.value){
                swal.fire({
                    title : "Success!",
                    text : "Pengguna telah berhasil dihapus",
                    type : "success",
                    timer : 2000,
                    onBeforeOpen: () => {
                        Swal.showLoading()
                    }
                }).then((result) => {
                    if(result.dismiss === Swal.DismissReason.timer){
                        table.ajax.reload(null, false);
                    }
                });
            }
        });
    } 
</script>