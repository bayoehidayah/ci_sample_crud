<script>
    $(document).ready(function(){
        $("#unitKerjaForm, #pegawaiForm, #satuanKerjaForm").select2();

        $("#unitKerjaForm").change(function(){
            let val = $(this).val();
            let option = '<option selected disabled value="">Pilih Satuan Kerja</option>';
            let pegOption = '<option selected disabled value="">Pilih Satuan Kerja Telebih Dahulu</option>';
            $("#pegawaiForm").html(pegOption);
            $("#pegawaiForm").select2("destroy").select2();
            $.ajax({
                type: "POST",
                url: "<?= base_url("pegawai/validator/get-satker"); ?>",
                data: {ukerja : val},
                dataType: "JSON",
                success: function (response) {
                    if(response.result){
                        var i;
                        for(i = 0; i < response.satker.length; i++){
                            option += '<option value="'+response.satker[i].kdesatker+'">'+response.satker[i].kdesatker+' - '+response.satker[i].nmasatker+'</option>';
                        }
                        $("#satuanKerjaForm").html(option);
                        $("#satuanKerjaForm").select2("destroy").select2();
                    }
                    else{
                        option = '<option selected disabled value="">Pilih Unit Kerja Telebih Dahulu</option>';
                        $("#satuanKerjaForm").html(option);
                        $("#satuanKerjaForm").select2("destroy").select2();
                        swal.fire({
                            title : "Oops!",
                            text : response.msg,
                            type : "error"
                        });
                    }
                },
                error : function(){
                    option = '<option selected disabled value="">Pilih Unit Kerja Telebih Dahulu</option>';
                    $("#satuanKerjaForm").html(option);
                    $("#satuanKerjaForm").select2("destroy").select2();
                    swal.fire({
                        title : "Oops!",
                        text : "Terjadi kesalahan dalam mengambil data satuan kerja",
                        type : "error"
                    });
                }
            });
        });

        $("#satuanKerjaForm").change(function(){
            let val = $(this).val();
            let option = '<option selected disabled value="">Pilih Pegawai</option>';
            $.ajax({
                type: "POST",
                url: "<?= base_url("pegawai/validator/get-pegawai"); ?>",
                data: {satker : val},
                dataType: "JSON",
                success: function (response) {
                    if(response.result){
                        var i;
                        for(i = 0; i < response.pegawai.length; i++){
                            option += '<option value="'+response.pegawai[i].kdepeg+'">'+response.pegawai[i].kdepeg+' - '+response.pegawai[i].nmapanjang+'</option>';
                        }
                        $("#pegawaiForm").html(option);
                        $("#pegawaiForm").select2("destroy").select2();
                    }
                    else{
                        option = '<option selected disabled value="">Pilih Satuan Kerja Telebih Dahulu</option>';
                        $("#pegawaiForm").html(option);
                        $("#pegawaiForm").select2("destroy").select2();
                        swal.fire({
                            title : "Oops!",
                            text : response.msg,
                            type : "error"
                        });
                    }
                },
                error : function(){
                    option = '<option selected disabled value="">Pilih Satuan Kerja Telebih Dahulu</option>';
                    $("#pegawaiForm").html(option);
                    $("#pegawaiForm").select2("destroy").select2();
                    swal.fire({
                        title : "Oops!",
                        text : "Terjadi kesalahan dalam mengambil data pegawai",
                        type : "error"
                    });
                }
            });
        });

        $("#validatorForm").submit(function (e) { 
            e.preventDefault();
            
            var form_data = $(this).serialize();
            $.ajax({
                type: "POST",
                url: "<?= base_url("pegawai/validator/new-validator") ?>",
                data: form_data,
                dataType: "JSON",
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
                                document.location.href = "<?= base_url("pegawai/validator"); ?>";
                            }
                        });
                    }
                    else{
                        swal.fire({
                            title : "Oops!",
                            text : response.msg,
                            type : "error"
                        });
                    }
                },
                error : function(){
                    swal.fire({
                        title : "Oops!",
                        html : "Tidak dapat memproses data adna",
                        type : "error"
                    });
                }
            });
        });
    });
</script>