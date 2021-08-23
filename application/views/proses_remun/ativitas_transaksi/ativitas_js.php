<script>

    $(document).ready(function(){

        $("#pegawaiForm, #periodeForm, #transaksiForm").select2();

        $("#searchAtivitas").submit(function (e) { 
            e.preventDefault();
            
            var form_data = $(this).serialize();
            $.ajax({
                type: "POST",
                url: "<?= base_url("proses-remun/ativitas/search-ativitas-per"); ?>",
                data: form_data,
                dataType: "JSON",
                beforeSend : function(){
                    $(".data-proces").hide();
                    swal.fire({
                        title : "Mohon tunggu...",
                        text : "Sedang mencari ativitas",
                        showConfirmButton : false,
                        allowOutsideClick : false,
                        onBeforeOpen: () => {
                            Swal.showLoading()
                        }
                    })
                },
                success: function (response) {
                    //Set For Aktivitas
                    var transaksi = response.transaksi;
                    var set = "";
                    
                    if(transaksi == "Tupoksi"){
                        var j = 1;
                        var total_poin = 0, total_harga = 0;
                        for(var i = 0; i < response.aktivitas.length; i++){
                            set += '<tr><td>'+j+'</td><td>'+response.aktivitas[i].bulan+'</td><td>'+response.aktivitas[i].nmaperan+'</td><td>'+formatCurrency(response.aktivitas[i].capaian)+'</td><td>'+response.aktivitas[i].nomskdokumen+' - '+response.aktivitas[i].judul+'</td><td>'+formatCurrency(response.aktivitas[i].poinaktivitas)+'</td></tr>';
                            j++;
                            total_poin += parseFloat(response.aktivitas[i].poinaktivitas);
                            total_harga += parseFloat(response.aktivitas[i].hargaaktivitas);
                        }

                        if ($.fn.DataTable.isDataTable("#tableTupoksi")) {
                          $('#tableTupoksi').DataTable().destroy();
                        }

                        $("#bodyTableTupoksi").html(set);
                        $("#tupoksiTotalPoin").text(formatCurrency(total_poin));
                        $("#tupoksiTotalHarga").text("Rp "+formatCurrency(total_harga));
                        $("#tableTupoksi").DataTable();
                        $(".data-proces-tupoksi").show();
                    }
                    else if(transaksi == "Mengajar"){
                        var j = 1;
                        var total_poin = 0, total_harga = 0;
                        for(var i = 0; i < response.aktivitas.length; i++){
                            set += '<tr><td>'+j+'</td><td>'+response.aktivitas[i].nmaperan+'</td><td>'+response.aktivitas[i].nmamtnkul+'</td><td>'+response.aktivitas[i].nomskdokumen+' - '+response.aktivitas[i].judul+'</td><td>'+formatCurrency(response.aktivitas[i].jlhmhs)+'</td><td>'+formatCurrency(response.aktivitas[i].poinaktivitas)+'</td></tr>';
                            j++;
                            total_poin += parseFloat(response.aktivitas[i].poinaktivitas);
                            total_harga += parseFloat(response.aktivitas[i].hargaaktivitas);
                        }

                        if ($.fn.DataTable.isDataTable("#tableMengajar")) {
                          $('#tableMengajar').DataTable().destroy();
                        }

                        $("#bodyTableMengajar").html(set);
                        $("#mengajarTotalPoin").text(formatCurrency(total_poin));
                        $("#mengajarTotalHarga").text("Rp "+formatCurrency(total_harga));
                        $("#tableMengajar").DataTable();
                        $(".data-proces-mengajar").show();
                    }
                    else if(transaksi == "Mengajar Lainnya"){
                        var j = 1;
                        var total_poin = 0, total_harga = 0;
                        for(var i = 0; i < response.aktivitas.length; i++){
                            set += '<tr><td>'+j+'</td><td>'+response.aktivitas[i].nmaperan+'</td><td>'+response.aktivitas[i].nomskdokumen+' - '+response.aktivitas[i].judul+'</td><td>'+formatCurrency(response.aktivitas[i].jlhmhs)+'</td><td>'+formatCurrency(response.aktivitas[i].poinaktivitas)+'</td></tr>';
                            j++;
                            total_poin += parseFloat(response.aktivitas[i].poinaktivitas);
                            total_harga += parseFloat(response.aktivitas[i].hargaaktivitas);
                        }

                        if ($.fn.DataTable.isDataTable("#tableMengajarLainnya")) {
                          $('#tableMengajarLainnya').DataTable().destroy();
                        }

                        $("#bodyTableMengajarLainnya").html(set);
                        $("#mengajarLainnyaTotalPoin").text(formatCurrency(total_poin));
                        $("#mengajarLainnyaTotalHarga").text("Rp "+formatCurrency(total_harga));
                        $("#tableMengajarLainnya").DataTable();
                        $(".data-proces-mengajar-lainnya").show();
                    }
                    else if(transaksi == "Penelitian"){
                        var j = 1;
                        var total_poin = 0, total_harga = 0;
                        for(var i = 0; i < response.aktivitas.length; i++){
                            set += '<tr><td>'+j+'</td><td>'+response.aktivitas[i].nmaperan+'</td><td>'+response.aktivitas[i].nomskdokumen+' - '+response.aktivitas[i].judul+'</td><td>'+formatCurrency(response.aktivitas[i].poinaktivitas)+'</td></tr>';
                            j++;
                            total_poin += parseFloat(response.aktivitas[i].poinaktivitas);
                            total_harga += parseFloat(response.aktivitas[i].hargaaktivitas);
                        }

                        if ($.fn.DataTable.isDataTable("#tablePenelitian")) {
                          $('#tablePenelitian').DataTable().destroy();
                        }

                        $("#bodyTablePenelitian").html(set);
                        $("#penelitianTotalPoin").text(formatCurrency(total_poin));
                        $("#penelitianTotalHarga").text("Rp "+formatCurrency(total_harga));
                        $("#tablePenelitian").DataTable();
                        $(".data-proces-penelitian").show();
                    }
                    else if(transaksi == "Pengabdian"){
                        var j = 1;
                        var total_poin = 0, total_harga = 0;
                        for(var i = 0; i < response.aktivitas.length; i++){
                            set += '<tr><td>'+j+'</td><td>'+response.aktivitas[i].nmaperan+'</td><td>'+response.aktivitas[i].nomskdokumen+' - '+response.aktivitas[i].judul+'</td><td>'+formatCurrency(response.aktivitas[i].poinaktivitas)+'</td></tr>';
                            j++;
                            total_poin += parseFloat(response.aktivitas[i].poinaktivitas);
                            total_harga += parseFloat(response.aktivitas[i].hargaaktivitas);
                        }

                        if ($.fn.DataTable.isDataTable("#tablePengabdian")) {
                          $('#tablePengabdian').DataTable().destroy();
                        }

                        $("#bodyTablePengabdian").html(set);
                        $("#pengabdianTotalPoin").text(formatCurrency(total_poin));
                        $("#pengabdianTotalHarga").text("Rp "+formatCurrency(total_harga));
                        $("#tablePengabdian").DataTable();
                        $(".data-proces-pengabdian").show();
                    }
                    else if(transaksi == "Penghargaan"){
                        var j = 1;
                        var total_poin = 0, total_harga = 0;
                        for(var i = 0; i < response.aktivitas.length; i++){
                            set += '<tr><td>'+j+'</td><td>'+response.aktivitas[i].nmaperan+'</td><td>'+response.aktivitas[i].nomskdokumen+' - '+response.aktivitas[i].judul+'</td><td>'+formatCurrency(response.aktivitas[i].poinaktivitas)+'</td></tr>';
                            j++;
                            total_poin += parseFloat(response.aktivitas[i].poinaktivitas);
                            total_harga += parseFloat(response.aktivitas[i].hargaaktivitas);
                        }

                        if ($.fn.DataTable.isDataTable("#tablePenghargaan")) {
                          $('#tablePenghargaan').DataTable().destroy();
                        }

                        $("#bodyTablePenghargaan").html(set);
                        $("#penghargaanTotalPoin").text(formatCurrency(total_poin));
                        $("#penghargaanTotalHarga").text("Rp "+formatCurrency(total_harga));
                        $("#tablePenghargaan").DataTable();
                        $(".data-proces-penghargaan").show();
                    }
                    else if(transaksi == "Penunjang"){
                        var j = 1;
                        var total_poin = 0, total_harga = 0;
                        for(var i = 0; i < response.aktivitas.length; i++){
                            set += '<tr><td>'+j+'</td><td>'+response.aktivitas[i].nmaperan+'</td><td>'+response.aktivitas[i].nomskdokumen+' - '+response.aktivitas[i].judul+'</td><td>'+formatCurrency(response.aktivitas[i].poinaktivitas)+'</td></tr>';
                            j++;
                            total_poin += parseFloat(response.aktivitas[i].poinaktivitas);
                            total_harga += parseFloat(response.aktivitas[i].hargaaktivitas);
                        }

                        if ($.fn.DataTable.isDataTable("#tablePenunjang")) {
                          $('#tablePenunjang').DataTable().destroy();
                        }

                        $("#bodyTablePenunjang").html(set);
                        $("#penunjangTotalPoin").text(formatCurrency(total_poin));
                        $("#penunjangTotalHarga").text("Rp "+formatCurrency(total_harga));
                        $("#tablePenunjang").DataTable();
                        $(".data-proces-penunjang").show();
                    }
                    swal.close()
                },
                error : function(textStatus){
                    console.log(textStatus);
                    swal.fire({
                        title : "Oops!",
                        html : "Terjadi kesalahan sistem.",
                        type : "error"
                    });
                }
            });
        });
    });
</script>