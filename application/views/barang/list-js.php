<script>
    var table;
    $(document).ready(function(){
        $("#btnAdd").click(function(){
            $("#barangForm")[0].reset();
            $("#editData").val("0");
            $("#kodeBarang").removeAttr("readonly");
        });

        table = $('#tableBarang').DataTable({
            'responsive' : true,
            "processing": true,
            "serverSide": true,
            "ordering": true, 
            "order": [[ 0, 'asc' ]],
            "ajax":
            {
                "url": "<?= base_url('barang/datas') ?>",
                "type": "POST"
            },
            "deferRender": true,
            "aLengthMenu": [[10, 50, 100],[ 10, 50, 100]],
            "columns": [
                { "data": "id" }, 
                { "data": "nama" }, 
                { "data": "harga" },
                { "data": "created_at" },
                { "render": function ( data, type, row ) {
                        var html  = '<a class="btn btn-sm btn-clean btn-icon btn-icon-md" href="javascript:void(0);" title="Edit Barang" onclick="editBarang(\''+row.id+'\')"><i class="la la-edit"></i></a>';
                        html += '<a href="javascript:void(0);" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Delete Barang" onclick="delBarang(\''+row.id+'\')"><i class="la la-trash"></i></a>';
                        return html;
                    }
                },
            ],
        });

        $("#barangForm").submit(function(e){
            e.preventDefault();
            var form_data = new FormData(this);

            $.ajax({
                type: "POST",
                url: "<?php echo base_url("barang/form");  ?>",
                data: form_data,
                dataType: "JSON",
                processData:false,
                contentType:false,
                beforeSend : function(){
                    swal.fire({
                        title : "Mohon tunggu...",
                        text : "Sedang memproses data",
                        showConfirmButton : false,
                        allowOutsideClick : false,
                        onBeforeOpen: () => {
                            Swal.showLoading()
                        }
                    })
                },
                success: function (response) {
                    if(response.result){
                        swal.fire({
                            title : "Success!",
                            text : response.msg,
                            type : "success",
                            timer : 2000,
                            onBeforeOpen: () => {
                                Swal.showLoading()
                            }
                        }).then((result) => {
                            $("#barangForm")[0].reset();
                            $("#modalBarang").modal("toggle");
                            
                            if(result.dismiss === Swal.DismissReason.timer){
                                table.ajax.reload(null, false)
                            }
                        });
                    }
                    else{
                        swal.fire({
                            title : "Oops!",
                            html : response.msg,
                            type : "error"
                        });
                    }
                },
                error : function(errorText){
                    console.log(errorText);
                    swal.fire({
                        title : "Oops!",
                        text : "Terjadi kesalahan dalam menyimpan data",
                        type : "error"
                    });
                }
            });
        })
    });

    function editBarang(id){
        $.ajax({
            type: "GET",
            url: "<?php echo base_url("barang");  ?>/"+id,
            dataType: "JSON",
            processData:false,
            contentType:false,
            beforeSend : function(){
                swal.fire({
                    title : "Mohon tunggu...",
                    text : "Sedang memproses data",
                    showConfirmButton : false,
                    allowOutsideClick : false,
                    onBeforeOpen: () => {
                        Swal.showLoading()
                    }
                })
            },
            success: function (response) {
                swal.close();
                if(response.result){
                    $("#barangForm")[0].reset();
                    $("#modalBarang").modal("toggle");

                    $("#editData").val(1);
                    $("#kodeBarang").val(response.data.id);

                    $("#namaBarang").val(response.data.nama);
                    $("#harga").val(response.data.harga);
                    
                }
                else{
                    swal.fire({
                        title : "Oops!",
                        html : response.msg,
                        type : "error"
                    });
                }
            },
            error : function(errorText){
                console.log(errorText);
                swal.fire({
                    title : "Oops!",
                    text : "Terjadi kesalahan dalam mengambil data",
                    type : "error"
                });
            }
        });
    }

    function delBarang(id){
        swal.fire({
            title : "Perhatian!",
            html : "Data barang tidak dapat dikembalikan",
            type : "info",
            showCancelButton : true,
            showLoaderOnConfirm : true,
            preConfirm : () => {
                return fetch("<?= base_url("barang/delete/"); ?>" + id)
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
                    swal.showValidationMessage("Terjadi kesalahan dalam menghapus barang");
                })
            },
            allowOutsideClick : () => !swal.isLoading()
        }).then((result) => {
            if(result.value){
                swal.fire({
                    title : "Success!",
                    text : "Barang telah berhasil dihapus",
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
        }) 
    }
</script>
