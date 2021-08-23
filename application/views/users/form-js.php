<script>
    const edit = $("#edit").val();
    $(document).ready(function(){  
        if(!edit){
            $('#tipePengguna').select2();
        }
        else{
            $('#tipePengguna').select2({
                disabled:true
            });
        }
        
        $("#tipePengguna").change(function(){
            const val = $(this).val();
            $.ajax({
                type: "GET",
                url: "<?= base_url("generate/new-users-id"); ?>/" + val,
                dataType: "html",
                beforeSend : function(){
                    swal.fire({
                        title : "Mohon tunggu...",
                        text : "Sedang memproses id pengguna",
                        showConfirmButton : false,
                        allowOutsideClick : false,
                        onBeforeOpen: () => {
                            Swal.showLoading()
                        }
                    })
                },
                success: function (response) {
                    swal.close();
                    $("#idPengguna").removeAttr("readonly");
                    $("#idPengguna").val(response);
                    $("#idPengguna").attr("readonly", "readonly");
                },
                error : function(){
                    swal.fire({
                        title : "Oops!",
                        text : "Terjadi kesalahan dalam menyimpan data",
                        type : "error"
                    });
                }
            });
        });

        $("#penggunaForm").submit(function (e) { 
            e.preventDefault();
            var form_data = new FormData(this);

            if(edit){
                form_data.append("tipe", $("#tipe").val());
            }

            $.ajax({
                type: "POST",
                url: "<?php echo base_url("pengguna/form");  ?>",
                data: form_data,
                dataType: "JSON",
                processData:false,
                contentType:false,
                beforeSend : function(){
                    swal.fire({
                        title : "Mohon tunggu...",
                        text : "Sedang memproses data anda",
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
                            if(result.dismiss === Swal.DismissReason.timer){
                                document.location.href = "<?= base_url("pengguna"); ?>";
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
        });
    });
</script>