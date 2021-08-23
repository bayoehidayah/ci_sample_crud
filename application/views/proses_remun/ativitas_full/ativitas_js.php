<script>

    $(document).ready(function(){

        $("#pegawaiForm, #periodeForm, #transaksiForm").select2();

        $("#searchAtivitas").submit(function (e) {
            e.preventDefault();

            var form_data = $(this).serialize();
            $.ajax({
                type: "POST",
                url: "<?= base_url("proses-remun/ativitas/search-ativitas-full"); ?>",
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
                    var profil = ""
                    $("#nipPeg").text(response.pegawai.nip);
                    $("#nidnPeg").text(response.pegawai.nidn);
                    $("#namaPeg").text(response.pegawai.nmapeg);
                    $("#golPnsPeg").text(response.pegawai.golpns);
                    $("#jab1Peg").text(response.pegawai.kdeklsjab+' -> '+response.pegawai.jabatan_1);
                    $("#jab2Peg").text(response.pegawai.kdeklsjabf+' -> '+response.pegawai.jabatan_2);
                    $("#satKerPeg").text(response.pegawai.kdesatker+' -> '+response.pegawai.satuan_kerja);
                    $(".data-proces-profil").show();

                    var all_poin = 0, all_harga = 0;
                    var penghargaan_poin = 0;

                    var j = 1;
                    var total_poin = 0, total_harga = 0;
                    var set = "";
                    //Set For Tupoksi
                    for(var i = 0; i < response.tupoksi.length; i++){
                        // set += '<tr><td>'+j+'</td><td>'+response.tupoksi[i].bulan+'</td><td>'+response.tupoksi[i].nmaperan+'</td><td>'+formatCurrency(response.tupoksi[i].capaian)+'</td><td>'+response.tupoksi[i].nomskdokumen+' - '+response.tupoksi[i].judul+'</td><td>'+formatCurrency(response.tupoksi[i].poinaktivitas)+'</td><td>Rp '+formatCurrency(response.tupoksi[i].hargaaktivitas)+'</td></tr>';
                        set += '<tr><td>'+j+'</td><td>'+response.tupoksi[i].bulan+'</td><td>'+response.tupoksi[i].nmaperan+'</td><td>'+formatCurrency(response.tupoksi[i].capaian)+'</td><td>'+response.tupoksi[i].nomskdokumen+' - '+response.tupoksi[i].judul+'</td><td>'+formatCurrency(response.tupoksi[i].poinaktivitas)+'</td></tr>';
                        j++;
                        total_poin += parseFloat(response.tupoksi[i].poinaktivitas);
                        // total_harga += parseFloat(response.tupoksi[i].hargaaktivitas);
                    }

                    if ($.fn.DataTable.isDataTable("#tableTupoksi")) {
                        $('#tableTupoksi').DataTable().destroy();
                    }

                    $("#bodyTableTupoksi").html(set);
                    $("#tupoksiTotalPoin").text(formatCurrency(total_poin));
                    // $("#tupoksiTotalHarga").text("Rp "+formatCurrency(total_harga));
                    $("#tableTupoksi").DataTable();
                    $(".data-proces-tupoksi").show();

                    all_poin += parseFloat(total_poin);
                    all_harga += parseFloat(total_harga);

                    //Set For Mengajar
                    j = 1;
                    total_poin = 0;
                    total_harga = 0;
                    set = "";
                    for(var i = 0; i < response.mengajar.length; i++){
                        // set += '<tr><td>'+j+'</td><td>'+response.mengajar[i].nmaperan+'</td><td>'+response.mengajar[i].nmamtnkul+'</td><td>'+response.mengajar[i].nomskdokumen+' - '+response.mengajar[i].judul+'</td><td>'+formatCurrency(response.mengajar[i].jlhmhs)+'</td><td>'+formatCurrency(response.mengajar[i].poinaktivitas)+'</td><td>Rp '+formatCurrency(response.mengajar[i].hargaaktivitas)+'</td></tr>';
                        set += '<tr><td>'+j+'</td><td>'+response.mengajar[i].nmaperan+'</td><td>'+response.mengajar[i].nmamtnkul+'</td><td>'+response.mengajar[i].nomskdokumen+' - '+response.mengajar[i].judul+'</td><td>'+formatCurrency(response.mengajar[i].jlhmhs)+'</td><td>'+formatCurrency(response.mengajar[i].poinaktivitas)+'</td></tr>';
                            j++;
                        total_poin += parseFloat(response.mengajar[i].poinaktivitas);
                        // total_harga += parseFloat(response.mengajar[i].hargaaktivitas);
                    }

                    if ($.fn.DataTable.isDataTable("#tableMengajar")) {
                        $('#tableMengajar').DataTable().destroy();
                    }

                    $("#bodyTableMengajar").html(set);
                    $("#mengajarTotalPoin").text(formatCurrency(total_poin));
                    // $("#mengajarTotalHarga").text("Rp "+formatCurrency(total_harga));
                    $("#tableMengajar").DataTable();
                    $(".data-proces-mengajar").show();

                    all_poin += parseFloat(total_poin);
                    all_harga += parseFloat(total_harga);

                    //Set For Mengajar Lainnya
                    j = 1;
                    total_poin = 0;
                    total_harga = 0;
                    set = "";
                    for(var i = 0; i < response.mengajar_lainnya.length; i++){
                        // set += '<tr><td>'+j+'</td><td>'+response.mengajar_lainnya[i].nmaperan+'</td><td>'+response.mengajar_lainnya[i].nomskdokumen+' - '+response.mengajar_lainnya[i].judul+'</td><td>'+formatCurrency(response.mengajar_lainnya[i].jlhmhs)+'</td><td>'+formatCurrency(response.mengajar_lainnya[i].poinaktivitas)+'</td><td>Rp '+formatCurrency(response.mengajar_lainnya[i].hargaaktivitas)+'</td></tr>';
                        set += '<tr><td>'+j+'</td><td>'+response.mengajar_lainnya[i].nmaperan+'</td><td>'+response.mengajar_lainnya[i].nomskdokumen+' - '+response.mengajar_lainnya[i].judul+'</td><td>'+formatCurrency(response.mengajar_lainnya[i].jlhmhs)+'</td><td>'+formatCurrency(response.mengajar_lainnya[i].poinaktivitas)+'</td></tr>';
                        j++;
                        total_poin += parseFloat(response.mengajar_lainnya[i].poinaktivitas);
                        // total_harga += parseFloat(response.mengajar_lainnya[i].hargaaktivitas);
                    }

                    if ($.fn.DataTable.isDataTable("#tableMengajarLainnya")) {
                        $('#tableMengajarLainnya').DataTable().destroy();
                    }

                    $("#bodyTableMengajarLainnya").html(set);
                    $("#mengajarLainnyaTotalPoin").text(formatCurrency(total_poin));
                    // $("#mengajarLainnyaTotalHarga").text("Rp "+formatCurrency(total_harga));
                    $("#tableMengajarLainnya").DataTable();
                    $(".data-proces-mengajar-lainnya").show();

                    all_poin += parseFloat(total_poin);
                    all_harga += parseFloat(total_harga);

                    //Set For Penelitian
                    j = 1;
                    total_poin = 0;
                    total_harga = 0;
                    set = "";
                    for(var i = 0; i < response.penelitian.length; i++){
                        // set += '<tr><td>'+j+'</td><td>'+response.penelitian[i].nmaperan+'</td><td>'+response.penelitian[i].nomskdokumen+' - '+response.penelitian[i].judul+'</td><td>'+formatCurrency(response.penelitian[i].poinaktivitas)+'</td><td>Rp '+formatCurrency(response.penelitian[i].hargaaktivitas)+'</td></tr>';
                        set += '<tr><td>'+j+'</td><td>'+response.penelitian[i].nmaperan+'</td><td>'+response.penelitian[i].nomskdokumen+' - '+response.penelitian[i].judul+'</td><td>'+formatCurrency(response.penelitian[i].poinaktivitas)+'</td></tr>';
                        j++;
                        total_poin += parseFloat(response.penelitian[i].poinaktivitas);
                        // total_harga += parseFloat(response.penelitian[i].hargaaktivitas);
                    }

                    if ($.fn.DataTable.isDataTable("#tablePenelitian")) {
                    $('#tablePenelitian').DataTable().destroy();
                    }

                    $("#bodyTablePenelitian").html(set);
                    $("#penelitianTotalPoin").text(formatCurrency(total_poin));
                    // $("#penelitianTotalHarga").text("Rp "+formatCurrency(total_harga));
                    $("#tablePenelitian").DataTable();
                    $(".data-proces-penelitian").show();

                    all_poin += parseFloat(total_poin);
                    all_harga += parseFloat(total_harga);

                    //Set For Pengabdian
                    j = 1;
                    total_poin = 0;
                    total_harga = 0;
                    set = "";
                    for(var i = 0; i < response.pengabdian.length; i++){
                        // set += '<tr><td>'+j+'</td><td>'+response.pengabdian[i].nmaperan+'</td><td>'+response.pengabdian[i].nomskdokumen+' - '+response.pengabdian[i].judul+'</td><td>'+formatCurrency(response.pengabdian[i].poinaktivitas)+'</td><td>Rp '+formatCurrency(response.pengabdian[i].hargaaktivitas)+'</td></tr>';
                        set += '<tr><td>'+j+'</td><td>'+response.pengabdian[i].nmaperan+'</td><td>'+response.pengabdian[i].nomskdokumen+' - '+response.pengabdian[i].judul+'</td><td>'+formatCurrency(response.pengabdian[i].poinaktivitas)+'</td></tr>';
                        j++;
                        total_poin += parseFloat(response.pengabdian[i].poinaktivitas);
                        // total_harga += parseFloat(response.pengabdian[i].hargaaktivitas);
                    }

                    if ($.fn.DataTable.isDataTable("#tablePengabdian")) {
                        $('#tablePengabdian').DataTable().destroy();
                    }

                    $("#bodyTablePengabdian").html(set);
                    $("#pengabdianTotalPoin").text(formatCurrency(total_poin));
                    $("#pengabdianTotalHarga").text("Rp "+formatCurrency(total_harga));
                    $("#tablePengabdian").DataTable();
                    $(".data-proces-pengabdian").show();

                    all_poin += parseFloat(total_poin);
                    all_harga += parseFloat(total_harga);

                    //Set For Penghargaan
                    j = 1;
                    total_poin = 0;
                    total_harga = 0;
                    set = "";
                    for(var i = 0; i < response.penghargaan.length; i++){
                        // set += '<tr><td>'+j+'</td><td>'+response.penghargaan[i].nmaperan+'</td><td>'+response.penghargaan[i].nomskdokumen+' - '+response.penghargaan[i].judul+'</td><td>'+formatCurrency(response.penghargaan[i].poinaktivitas)+'</td><td>Rp '+formatCurrency(response.penghargaan[i].hargaaktivitas)+'</td></tr>';
                        set += '<tr><td>'+j+'</td><td>'+response.penghargaan[i].nmaperan+'</td><td>'+response.penghargaan[i].nomskdokumen+' - '+response.penghargaan[i].judul+'</td><td>'+formatCurrency(response.penghargaan[i].poinaktivitas)+'</td></tr>';
                        j++;
                        total_poin += parseFloat(response.penghargaan[i].poinaktivitas);
                        // total_harga += parseFloat(response.penghargaan[i].hargaaktivitas);
                    }

                    if ($.fn.DataTable.isDataTable("#tablePenghargaan")) {
                        $('#tablePenghargaan').DataTable().destroy();
                    }

                    $("#bodyTablePenghargaan").html(set);
                    $("#penghargaanTotalPoin").text(formatCurrency(total_poin));
                    // $("#penghargaanTotalHarga").text("Rp "+formatCurrency(total_harga));
                    $("#tablePenghargaan").DataTable();
                    $(".data-proces-penghargaan").show();

                    penghargaan_poin += parseFloat(total_poin);
                    all_harga += parseFloat(total_harga);

                    //Set For Penunjang
                    // j = 1;
                    total_poin = 0;
                    total_harga = 0;
                    set = "";
                    for(var i = 0; i < response.penunjang.length; i++){
                        // set += '<tr><td>'+j+'</td><td>'+response.penunjang[i].nmaperan+'</td><td>'+response.penunjang[i].nomskdokumen+' - '+response.penunjang[i].judul+'</td><td>'+formatCurrency(response.penunjang[i].poinaktivitas)+'</td><td>Rp '+formatCurrency(response.penunjang[i].hargaaktivitas)+'</td></tr>';
                        set += '<tr><td>'+j+'</td><td>'+response.penunjang[i].nmaperan+'</td><td>'+response.penunjang[i].nomskdokumen+' - '+response.penunjang[i].judul+'</td><td>'+formatCurrency(response.penunjang[i].poinaktivitas)+'</td></tr>';
                        j++;
                        total_poin += parseFloat(response.penunjang[i].poinaktivitas);
                        // total_harga += parseFloat(response.penunjang[i].hargaaktivitas);
                    }

                    if ($.fn.DataTable.isDataTable("#tablePenunjang")) {
                        $('#tablePenunjang').DataTable().destroy();
                    }

                    $("#bodyTablePenunjang").html(set);
                    $("#penunjangTotalPoin").text(formatCurrency(total_poin));
                    // $("#penunjangTotalHarga").text("Rp "+formatCurrency(total_harga));
                    $("#tablePenunjang").DataTable();
                    $(".data-proces-penunjang").show();

                    all_poin += parseFloat(total_poin);
                    all_harga += parseFloat(total_harga);

                    $("#totalPoinAktivitas").text(formatCurrency(all_poin));
                    $("#totalPoinPenghargaan").text(formatCurrency(penghargaan_poin));
                    all_poin += parseFloat(penghargaan_poin);
                    $("#totalKeseluruhanPoin").text(formatCurrency(all_poin));
                    $(".data-proces-all-poin").show();

                    // $("#nkp").text("Rp " + formatCurrency(response.nkp));
                    // $("#gaji30p").text("Rp " + formatCurrency(response.gaji30p));
                    // $("#intensif25p").text("Rp " + formatCurrency(response.intensif25p));
                    // $("#intensif100p").text("Rp " + formatCurrency(response.intensif100p));
                    // $("#intensif150p").text("Rp " + formatCurrency(response.intensif150p));
                    // $("#intensif200p").text("Rp " + formatCurrency(response.intensif200p));
                    // $("#remun25psmt").text("Rp " + formatCurrency(response.remun25psmt));
                    // $("#remun100psmt").text("Rp " + formatCurrency(response.remun100psmt));
                    // $("#remun150psmt").text("Rp " + formatCurrency(response.remun150psmt));
                    // $("#remun200psmt").text("Rp " + formatCurrency(response.remun200psmt));
                    // $("#rem100p12bln").text("Rp " + formatCurrency(response.rem100p12bln));
                    // $("#rem100p_thn_gj13_thr").text("Rp " + formatCurrency(response.rem100p_thn_gj13_thr));
                    // $("#remmaxpthn").text("Rp " + formatCurrency(response.remmaxpthn));

                    let jnspeg = response.rekapitulasi.kdejnspeg;
                    if(jnspeg == "DT"){
                        $("#remunDtField, #remunDbField, #totalRemunField, #insentifDtField, #insentifDbField").show();
                        $("#remunPegField, #insentifPegField").hide();
                    }
                    else if(jnspeg == "DB"){
                        $("#remunDbField, #insentifDbField").show();
                        $("#remunDtField, #totalRemunField, #remunPegField, #insentifDtField, #insentifPegField").hide();
                    }
                    else if(jnspeg == "PJFT" || jnspeg == "PJFU" || jnspeg == "PST"){
                        $("#remunPegField, #insentifPegField").show();
                        $("#remunDtField, #totalRemunField,  #insentifDtField, #remunDbField, #insentifDbField").hide();
                    }

                    //Rekapitulasi
                    $("#remunDt").text("Rp "+formatCurrency(response.rekapitulasi.remun_dt, 0));
                    $("#remunDb").text("Rp "+formatCurrency(response.rekapitulasi.remun_db, 0));
                    $("#remunPeg").text("Rp "+formatCurrency(response.rekapitulasi.remun_peg, 0));
                    $("#totalRemun").text("Rp "+formatCurrency(response.rekapitulasi.total_remun, 0));
                    $("#nilaiMaksimal").text("Rp "+formatCurrency(response.rekapitulasi.nilai_maksimal, 0));

                    //Gaji Remun
                    $("#gajiRemun").text("Rp "+formatCurrency(response.rekapitulasi.gaji_remun, 0));
                    $(".nilai_gaji_remun").text("Rp "+formatCurrency(response.rekapitulasi.nilai, 0));

                    //Insentif 70%
                    $("#insentifDt").text("Rp "+formatCurrency(response.rekapitulasi.insentif_dt, 0));
                    $("#insentifDb").text("Rp "+formatCurrency(response.rekapitulasi.insentif_db, 0));
                    $("#insentifPeg").text("Rp "+formatCurrency(response.rekapitulasi.insentif_peg, 0));
                    $("#remunPenghargaan").text("Rp "+formatCurrency(response.rekapitulasi.remun_penghargaan, 0));
                    $("#remunDibayar").text("Rp "+formatCurrency(response.rekapitulasi.remun_dibayar, 0));

                    $(".data-proces-all-remun").show();
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
