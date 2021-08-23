<script>
    var arrows, table;
    $(document).ready(function(){
        if (KTUtil.isRTL()) {
            arrows = {
                leftArrow: '<i class="la la-angle-right"></i>',
                rightArrow: '<i class="la la-angle-left"></i>'
            }
        } else {
            arrows = {
                leftArrow: '<i class="la la-angle-left"></i>',
                rightArrow: '<i class="la la-angle-right"></i>'
            }
        }

        $('#tanggal').datepicker({
            format : "yyyy-mm-dd",
		    rtl: KTUtil.isRTL(),
			todayHighlight: true,
			orientation: "bottom left",
			templates: arrows
		});

        $("#barang, #users").select2();

        $("#jumlah").on("change", function(){
            var jumlah    = $(this).val();
            var hargaJual = $("#hargaJualData").val();
            changeTotalJual(hargaJual, jumlah);
        });

        $("#barang").change(function(){
            var id_barang = $(this).val();
            $.ajax({
                type: "GET",
                url: "<?= base_url("barang") ?>/"+id_barang,
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
                        const hargaJual = response.data.harga_jual;
                        $("#hargaJualData").val(hargaJual);
                        $("#hargaJual").val(hargaJual);
                        changeTotalJual(hargaJual, $("#jumlah").val());
                    }
                    else{
                        swal.fire({
                            title : "Oops!",
                            text : response.msg,
                            type : "error"
                        });
                    }
                },
                error : function(errorText){
                    swal.fire({
                        title : "Oops!",
                        text : "Terjadi kesalahan",
                        type : "error"
                    });
                }
            });
        })

        $("#users").change(function(){
            var val = $(this).val();
            console.log(val);
            if(val == "non-registered-user"){
                $("#namaUserSection").show();
                $("#nama_user").attr("required", "required");
            }
            else{
                $("#namaUserSection").hide();
                $("#nama_user").removeAttr("required");
            }
        });

        table = $('#table').DataTable({
            "processing": true,
            "serverSide": true,
            "ordering": true, 
            "order": [[ 0, 'asc' ]],
            "ajax":
            {
                "url": "<?php echo base_url('transaksi/datas') ?>",
                "type": "POST"
            },
            "deferRender": true,
            "aLengthMenu": [[10, 50, 100],[ 10, 50, 100]],
            "columns": [
                { "data" : "id"}, 
                { "render" : function( data, type, row) {
                        var html = row.id_barang+" | "+row.nama;
                        return html;
                    }
                },
                { "render" : function( data, type, row) {
                        return formatCurrency(row.jumlah, 0);
                    }
                },
                { "data" : "tanggal"},
                { "render" : function( data, type, row) {
                        var html = "Harga Jual : Rp "+formatCurrency(row.harga_jual, 0);
                        html += "<br/>Total Jual : Rp "+formatCurrency(row.total_jual, 0);
                        return html;
                    }
                },
                { "render" : function( data, type, row) {
                        return row.nama_user;
                    }
                },
                { "render": function ( data, type, row ) {
                        var html = "";
                        html += '<button type="button" class="btn btn-sm btn-clean btn-icon btn-icon-md" onclick="editData(\''+row.id+'\');" title="Edit Transaksi"><i class="la la-edit"></i></button>';

                        html += '<a href="javascript:void(0);" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Delete Transaksi" onclick="delData(\''+row.id+'\')"><i class="la la-trash"></i></a>';
                        return html;
                    }
                },
            ],
        });

        $("#btnAdd").click(function(){
            $("#editData").val("false");
            $("#transaksiForm")[0].reset();

            $("#btnRefresh").removeAttr("disabled");
            $("#barang").val("").trigger("change.select2");
            $("#users").val("non-registered-user").trigger("change");
        })

        $("#transaksiForm").submit(function(e){
            e.preventDefault();
            var form_data = new FormData(this);

            $.ajax({
                type: "POST",
                url: "<?php echo base_url("transaksi/save");  ?>",
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
                            $("#transaksiForm")[0].reset();
                            $("#modalTransaksi").modal("toggle");
                            
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

    function changeTotalJual(hargaJual, jumlah){
        var totalJual = parseInt(jumlah) * parseInt(hargaJual);
        console.log(totalJual);
        $("#totalJual").val(totalJual);
    }

    function editData(id){
        const barang = $("#barang"), 
            users = $("#users");

        $.ajax({
            type: "GET",
            url: "<?= base_url("transaksi"); ?>/"+id,
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
                    $("#noFaktur").val(data.id);
                    barang.val(data.id_barang);
                    barang.trigger("change");

                    $("#tanggal").val(data.tanggal);
                    $("#jumlah").val(data.jumlah);

                    if(data.id_user != null && data.id_user != ""){
                        users.val(data.id_user);
                        $("#namaUserSection").hide();
                        $("#nama_user").removeAttr("required");
                    }
                    else{
                        $("#namaUserSection").show();
                        users.val("non-registered-user");
                        $("#nama_user").attr("required", "required");
                        $("#nama_user").val(data.nama_user);
                    }

                    users.trigger("change");
                    
                    $("#hargaJualData").val(data.harga_jual);
                    $("#hargaJual").val(data.harga_jual);
                    $("#jumlah").val(data.jumlah);
                    $("#totalJual").val(data.total_jual);

                    $("#btnRefresh").attr("disabled", "disabled");
                    $("#modalTransaksi").modal("toggle");
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

    function refreshFakturCode(){
        $.ajax({
            type: "GET",
            url: "<?= base_url("transaksi/faktur/new-code"); ?>",
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
                    $("#noFaktur").val(response.data);
                }
                else{
                    swal.fire({
                        title : "Oops!",
                        html : response.msg,
                        type : "error"
                    });
                }
            },
            error : function(){
                swal.fire({
                    title : "Oops!",
                    text : "Terjadi kesalahan dalam menyimpan data",
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
                return fetch("<?= base_url("transaksi/delete/"); ?>" + id)
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
                    swal.showValidationMessage("Terjadi kesalahan dalam menghapus transaksi");
                })
            },
            allowOutsideClick : () => !swal.isLoading()
        }).then((result) => {
            if(result.value){
                swal.fire({
                    title : "Success!",
                    text : "Transaksi telah berhasil dihapus",
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