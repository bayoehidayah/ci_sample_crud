<script>
    $(document).ready(function(){
        table = $('#tableFaktur').DataTable({
            'responsive' : true,
            "processing": true,
            "serverSide": true,
            "ordering": true, 
            "order": [[ 0, 'asc' ]],
            "ajax":
            {
                "url": "<?= base_url('faktur/datas') ?>",
                "type": "POST"
            },
            "deferRender": true,
            "aLengthMenu": [[10, 50, 100],[ 10, 50, 100]],
            "columns": [
				{ "render" : function ( data, type, row, meta ) {
						return meta.row + 1;
					} 
				},
                { "data": "nama_pelanggan" }, 
				{ "render" : function( data, type, row) {
                        return formatCurrency(row.total_items, 0);
                    }
                },
				{ "render" : function( data, type, row) {
                        return "Rp "+formatCurrency(row.total_harga, 0);
                    }
                },
                { "data": "created_at" },
                { "render": function ( data, type, row ) {
                        var html  = '<a class="btn btn-sm btn-clean btn-icon btn-icon-md" href="<?= base_url("faktur/show/") ?>'+row.id+'" title="Edit Faktur" onclick="editFaktur(\''+row.id+'\')"><i class="la la-edit"></i></a>';
                        html += '<a href="javascript:void(0);" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Delete Faktur" onclick="delFaktur(\''+row.id+'\')"><i class="la la-trash"></i></a>';
                        return html;
                    }
                },
            ],
        });

        $("#fakturForm").submit(function(e){
            e.preventDefault();
            var form_data = new FormData(this);

            $.ajax({
                type: "POST",
                url: "<?php echo base_url("faktur/form");  ?>",
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
                            // $("#fakturForm")[0].reset();
                            // $("#modalFaktur").modal("toggle");
                            
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

    function delFaktur(id){
        swal.fire({
            title : "Perhatian!",
            html : "Data faktur tidak dapat dikembalikan",
            type : "info",
            showCancelButton : true,
            showLoaderOnConfirm : true,
            preConfirm : () => {
                return fetch("<?= base_url("faktur/delete/"); ?>" + id)
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
                    swal.showValidationMessage("Terjadi kesalahan dalam menghapus faktur");
                })
            },
            allowOutsideClick : () => !swal.isLoading()
        }).then((result) => {
            if(result.value){
                swal.fire({
                    title : "Success!",
                    text : "Faktur telah berhasil dihapus",
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
