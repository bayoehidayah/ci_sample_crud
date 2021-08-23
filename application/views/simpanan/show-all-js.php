<script>
    var table;
    $(document).ready(function(){
        $("#users").select2();

        table = $('#tableSimpanan').DataTable({
            "processing": true,
            "serverSide": true,
            "ordering": true, 
            "order": [[ 0, 'asc' ]],
            "ajax":
            {
                "url": "<?php echo base_url('simpanan/datas') ?>",
                "type": "POST"
            },
            "deferRender": true,
            "aLengthMenu": [[10, 50, 100],[ 10, 50, 100]],
            "columns": [
                { "data" : "id"}, 
                { "data" : "id_user"},
                { "data" : "jenis"},
                { "render" : function( data, type, row) {
                        return "Rp "+formatCurrency(row.nilai, 0);
                    }
                },
                { "data" : "created_at" },
                { "render": function ( data, type, row ) {
                        var html = "";
                        html += '<button type="button" class="btn btn-sm btn-clean btn-icon btn-icon-md" onclick="editData(\''+row.id+'\');" title="Edit Simpanan"><i class="la la-edit"></i></button>';

                        html += '<a href="javascript:void(0);" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Delete Simpanan" onclick="delData(\''+row.id+'\')"><i class="la la-trash"></i></a>';
                        return html;
                    }
                },
            ],
        });

        $("#btnAdd").click(function(){
            $("#editData").val("false");
            $("#simpananForm")[0].reset();
            $("#users").val("").trigger("change");
        })

        $("#simpananForm").submit(function(e){
            e.preventDefault();
            var form_data = new FormData(this);

            $.ajax({
                type: "POST",
                url: "<?php echo base_url("simpanan/save");  ?>",
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
                            $("#simpananForm")[0].reset();
                            $("#modalSimpanan").modal("toggle");
                            
                            if(result.dismiss === Swal.DismissReason.timer){
                                table.ajax.reload(null, false)
                            }
                        });
                        console.log(response);
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
        });
    })

    function editData(id){
        const users = $("#users");

        $.ajax({
            type: "GET",
            url: "<?= base_url("simpanan"); ?>/"+id,
            dataType: "JSON",
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
                    const data = response.data;
                    $("#editData").val("true");
                    $("#idData").val(data.id);

                    $("#nilai").val(data.nilai);
                    $("#jenis").val(data.jenis);

                    users.val(data.id_user);
                    users.trigger("change");

                    $("#modalSimpanan").modal("toggle");
                }
                else{
                    swal.fire({
                        title : "Oops!",
                        html : response.msg,
                        type : "error"
                    });
                }

                console.log(response);
            },
            error : function(){
                barang.select();
                users.select();
                swal.fire({
                    title : "Oops!",
                    text : "Terjadi kesalahan",
                    type : "error"
                });
            }
        });
    }

    function delData(id){
        swal.fire({
            title : "Perhatian!",
            html : "Data tidak dapat dikembalikan. <br/> <b>Apakah anda yakin?</b>",
            type : "warning",
            showCancelButton : true,
            showLoaderOnConfirm : true,
            preConfirm : () => {
                return fetch("<?= base_url("simpanan/delete/"); ?>" + id)
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
                    swal.showValidationMessage("Terjadi kesalahan dalam menghapus data");
                })
            },
            allowOutsideClick : () => !swal.isLoading()
        }).then((result) => {
            if(result.value){
                swal.fire({
                    title : "Success!",
                    text : "Data telah berhasil dihapus",
                    type : "success",
                    timer : 2000,
                    onBeforeOpen: () => {
                        Swal.showLoading()
                    }
                }).then((result) => {
                    if(result.dismiss === Swal.DismissReason.timer){
                        table.ajax.reload(null, false)
                    }
                });
            }
        }) 
    }
</script>
