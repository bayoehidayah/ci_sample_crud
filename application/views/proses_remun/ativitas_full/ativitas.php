                        <!-- begin:: Content -->
                        <div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
                            <form action="#" id="searchAtivitas" enctype="multipart/form-data" method="post">
                                <div class="kt-portlet kt-portlet--mobile">
                                    <div class="kt-portlet__head kt-portlet__head--lg">
                                        <div class="kt-portlet__head-label">
                                            <span class="kt-portlet__head-icon">
                                                <i class="kt-font-brand flaticon2-search"></i>
                                            </span>
                                            <h3 class="kt-portlet__head-title">
                                                Cari Data Ativitas
                                            </h3>
                                        </div>
                                        <div class="kt-portlet__head-toolbar">
                                            <div class="kt-portlet__head-wrapper">
                                                <div class="kt-portlet__head-actions">
                                                    <button type="submit" class="btn btn-brand btn-elevate btn-icon-sm">
                                                        <i class="la la-search"></i>
                                                        Cari
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="kt-portlet__body">
                                        <div class="row">
                                            <div class="col-md-6 col-sm-12 col-lg-6">
												<div class="form-group">
													<label>Pegawai</label>
													<select class="form-control m-select2" id="pegawaiForm" name="pegawai" required>
														<option value="" selected disabled>Pilih Pegawai</option>
														<?php
															foreach($pegawai as $row){
																if($edit && $row->kdepeg == $penelitian['kdepeg']){
																	echo '<option value="'.$row->kdepeg.'" selected>'.$row->kdepeg.' - '.$row->nmapanjang.'</option>';
																}
																else{
                                                                    echo '<option value="'.$row->kdepeg.'">'.$row->kdepeg.' - '.$row->nmapanjang.'</option>';
																}
															}
														?>
													</select>
												</div>
											</div>
                                            <div class="col-md-6 col-sm-12 col-lg-6">
												<div class="form-group">
													<label>Periode</label>
													<select class="form-control m-select2" id="periodeForm" name="periode" required>
														<option value="" selected disabled>Pilih Periode</option>
														<?php
															foreach($periode as $row){
																if($edit && $row->periode == $penelitian['periode']){
																	echo '<option value="'.$row->periode.'" selected>'.$row->periode.'</option>';
																}
																else{
                                                                    echo '<option value="'.$row->periode.'">'.$row->periode.'</option>';
																}
															}
														?>
													</select>
												</div>
											</div>
                                        </div>
                                    </div>
                                </div>
                            </form>

                            <div class="kt-portlet kt-portlet--mobile data-proces data-proces-profil" style="display:none;">
                                <div class="kt-portlet__head kt-portlet__head--lg">
                                    <div class="kt-portlet__head-label">
                                        <span class="kt-portlet__head-icon">
                                            <i class="kt-font-brand flaticon2-user"></i>
                                        </span>
                                        <h3 class="kt-portlet__head-title">
                                            Profil Pegawai
                                        </h3>
                                    </div>
                                </div>
                                <div class="kt-portlet__body table-responsive">
									<table class="table table-bordered table-hover table-checkable">
										<tbody>
											<tr>
                                                <td style="width:50%;">NIP</td>
                                                <td id="nipPeg" style="width:50%;"></td>
                                            </tr>
                                            <tr>
                                                <td>NIDN</td>
                                                <td id="nidnPeg"></td>
                                            </tr>
                                            <tr>
                                                <td>Nama</td>
                                                <td id="namaPeg"></td>
                                            </tr>
                                            <tr>
                                                <td>Golongan PNS</td>
                                                <td id="golPnsPeg"></td>
                                            </tr>
                                            <tr>
                                                <td>Jabatan 1</td>
                                                <td id="jab1Peg"></td>
                                            </tr>
                                            <tr>
                                                <td>Jabatan 2</td>
                                                <td id="jab2Peg"></td>
                                            </tr>
                                            <tr>
                                                <td>Satuan Kerja</td>
                                                <td id="satKerPeg"></td>
                                            </tr>
										</tbody>
									</table>
                                </div>
                            </div>

                            <div class="kt-portlet kt-portlet--mobile data-proces data-proces-tupoksi" style="display:none;">
                                <div class="kt-portlet__head kt-portlet__head--lg">
                                    <div class="kt-portlet__head-label">
                                        <span class="kt-portlet__head-icon">
                                            <i class="kt-font-brand flaticon2-crisp-icons"></i>
                                        </span>
                                        <h3 class="kt-portlet__head-title">
                                            Data Transaksi Tupoksi
                                        </h3>
                                    </div>
                                </div>
                                <div class="kt-portlet__body table-responsive">
                                    <!--begin: Datatable -->
									<table class="table table-bordered table-hover table-checkable" id="tableTupoksi">
										<thead>
											<tr>
												<th>No</th>
												<th>Bulan</th>
                                                <th>Peran</th>
												<th>Capaian</th>
                                                <th>Dokumen</th>
												<th>Poin</th>
                                                <!-- <th>Harga</th> -->
											</tr>
										</thead>
										<tbody id="bodyTableTupoksi">

										</tbody>
                                        <tfoot>
                                            <tr>
                                                <th colspan="5">Total</th>
                                                <th id="tupoksiTotalPoin"></th>
                                                <!-- <th id="tupoksiTotalHarga"></th> -->
                                            </tr>
                                        </tfoot>
									</table>
									<!--end: Datatable -->
                                </div>
                            </div>

                            <div class="kt-portlet kt-portlet--mobile data-proces data-proces-mengajar" style="display:none;">
                                <div class="kt-portlet__head kt-portlet__head--lg">
                                    <div class="kt-portlet__head-label">
                                        <span class="kt-portlet__head-icon">
                                            <i class="kt-font-brand flaticon2-crisp-icons"></i>
                                        </span>
                                        <h3 class="kt-portlet__head-title">
                                            Data Transaksi Mengajar
                                        </h3>
                                    </div>
                                </div>
                                <div class="kt-portlet__body table-responsive">
                                    <!--begin: Datatable -->
									<table class="table table-bordered table-hover table-checkable" id="tableMengajar">
										<thead>
											<tr>
												<th>No</th>
												<th>Peran</th>
												<th>Matkul</th>
												<th>Dokumen</th>
												<th>Jlh. Mahasiswa</th>
                                                <th>Poin</th>
                                                <!-- <th>Harga</th> -->
											</tr>
										</thead>
										<tbody id="bodyTableMengajar">

										</tbody>
                                        <tfoot>
                                            <tr>
                                                <th colspan="5">Total</th>
                                                <th id="mengajarTotalPoin"></th>
                                                <!-- <th id="mengajarTotalHarga"></th> -->
                                            </tr>
                                        </tfoot>
									</table>
									<!--end: Datatable -->
                                </div>
                            </div>

                            <div class="kt-portlet kt-portlet--mobile data-proces data-proces-mengajar-lainnya" style="display:none;">
                                <div class="kt-portlet__head kt-portlet__head--lg">
                                    <div class="kt-portlet__head-label">
                                        <span class="kt-portlet__head-icon">
                                            <i class="kt-font-brand flaticon2-crisp-icons"></i>
                                        </span>
                                        <h3 class="kt-portlet__head-title">
                                            Data Transaksi Mengajar Lainnya
                                        </h3>
                                    </div>
                                </div>
                                <div class="kt-portlet__body table-responsive">
                                    <!--begin: Datatable -->
									<table class="table table-bordered table-hover table-checkable" id="tableMengajarLainnya">
										<thead>
											<tr>
												<th>No</th>
												<th>Peran</th>
												<th>Dokumen</th>
												<th>Jlh. Mahasiswa</th>
                                                <th>Poin</th>
                                                <!-- <th>Harga</th> -->
											</tr>
										</thead>
										<tbody id="bodyTableMengajarLainnya">

										</tbody>
                                        <tfoot>
                                            <tr>
                                                <th colspan="4">Total</th>
                                                <th id="mengajarLainnyaTotalPoin"></th>
                                                <!-- <th id="mengajarLainnyaTotalHarga"></th> -->
                                            </tr>
                                        </tfoot>
									</table>
									<!--end: Datatable -->
                                </div>
                            </div>

                            <div class="kt-portlet kt-portlet--mobile data-proces data-proces-penelitian" style="display:none;">
                                <div class="kt-portlet__head kt-portlet__head--lg">
                                    <div class="kt-portlet__head-label">
                                        <span class="kt-portlet__head-icon">
                                            <i class="kt-font-brand flaticon2-crisp-icons"></i>
                                        </span>
                                        <h3 class="kt-portlet__head-title">
                                            Data Transaksi Penelitian
                                        </h3>
                                    </div>
                                </div>
                                <div class="kt-portlet__body table-responsive">
                                    <!--begin: Datatable -->
									<table class="table table-bordered table-hover table-checkable" id="tablePenelitian">
										<thead>
											<tr>
												<th>No</th>
												<th>Peran</th>
												<th>Dokumen</th>
                                                <th>Poin</th>
                                                <!-- <th>Harga</th> -->
											</tr>
										</thead>
										<tbody id="bodyTablePenelitian">

										</tbody>
                                        <tfoot>
                                            <tr>
                                                <th colspan="3">Total</th>
                                                <th id="penelitianTotalPoin"></th>
                                                <!-- <th id="penelitianTotalHarga"></th> -->
                                            </tr>
                                        </tfoot>
									</table>
									<!--end: Datatable -->
                                </div>
                            </div>

                            <div class="kt-portlet kt-portlet--mobile data-proces data-proces-pengabdian" style="display:none;">
                                <div class="kt-portlet__head kt-portlet__head--lg">
                                    <div class="kt-portlet__head-label">
                                        <span class="kt-portlet__head-icon">
                                            <i class="kt-font-brand flaticon2-crisp-icons"></i>
                                        </span>
                                        <h3 class="kt-portlet__head-title">
                                            Data Transaksi Pengabdian
                                        </h3>
                                    </div>
                                </div>
                                <div class="kt-portlet__body table-responsive">
                                    <!--begin: Datatable -->
									<table class="table table-bordered table-hover table-checkable" id="tablePengabdian">
										<thead>
											<tr>
												<th>No</th>
												<th>Peran</th>
												<th>Dokumen</th>
                                                <th>Poin</th>
                                                <!-- <th>Harga</th> -->
											</tr>
										</thead>
										<tbody id="bodyTablePengabdian">

										</tbody>
                                        <tfoot>
                                            <tr>
                                                <th colspan="3">Total</th>
                                                <th id="pengabdianTotalPoin"></th>
                                                <!-- <th id="pengabdianTotalHarga"></th> -->
                                            </tr>
                                        </tfoot>
									</table>
									<!--end: Datatable -->
                                </div>
                            </div>

                            <div class="kt-portlet kt-portlet--mobile data-proces data-proces-penunjang" style="display:none;">
                                <div class="kt-portlet__head kt-portlet__head--lg">
                                    <div class="kt-portlet__head-label">
                                        <span class="kt-portlet__head-icon">
                                            <i class="kt-font-brand flaticon2-crisp-icons"></i>
                                        </span>
                                        <h3 class="kt-portlet__head-title">
                                            Data Transaksi Penunjang
                                        </h3>
                                    </div>
                                </div>
                                <div class="kt-portlet__body table-responsive">
                                    <!--begin: Datatable -->
									<table class="table table-bordered table-hover table-checkable" id="tablePenunjang">
										<thead>
											<tr>
												<th>No</th>
												<th>Peran</th>
												<th>Dokumen</th>
                                                <th>Poin</th>
                                                <!-- <th>Harga</th> -->
											</tr>
										</thead>
										<tbody id="bodyTablePenunjang">

										</tbody>
                                        <tfoot>
                                            <tr>
                                                <th colspan="3">Total</th>
                                                <th id="penunjangTotalPoin"></th>
                                                <!-- <th id="penunjangTotalHarga"></th> -->
                                            </tr>
                                        </tfoot>
									</table>
									<!--end: Datatable -->
                                </div>
                            </div>

                            <div class="kt-portlet kt-portlet--mobile data-proces data-proces-penghargaan" style="display:none;">
                                <div class="kt-portlet__head kt-portlet__head--lg">
                                    <div class="kt-portlet__head-label">
                                        <span class="kt-portlet__head-icon">
                                            <i class="kt-font-brand flaticon2-crisp-icons"></i>
                                        </span>
                                        <h3 class="kt-portlet__head-title">
                                            Data Transaksi Penghargaan
                                        </h3>
                                    </div>
                                </div>
                                <div class="kt-portlet__body table-responsive">
                                    <!--begin: Datatable -->
									<table class="table table-bordered table-hover table-checkable" id="tablePenghargaan">
										<thead>
											<tr>
												<th>No</th>
												<th>Peran</th>
												<th>Dokumen</th>
                                                <th>Poin</th>
                                                <!-- <th>Harga</th> -->
											</tr>
										</thead>
										<tbody id="bodyTablePenghargaan">

										</tbody>
                                        <tfoot>
                                            <tr>
                                                <th colspan="3">Total</th>
                                                <th id="penghargaanTotalPoin"></th>
                                                <!-- <th id="penghargaanTotalHarga"></th> -->
                                            </tr>
                                        </tfoot>
									</table>
									<!--end: Datatable -->
                                </div>
                            </div>

                            <div class="kt-portlet kt-portlet--mobile data-proces data-proces-all-poin" style="display:none;">
                                <div class="kt-portlet__body table-responsive">
                                    <!--begin: Datatable -->
									<table class="table table-bordered table-hover table-checkable">
										<tr>
                                            <td style="width:50%;">Total Poin Aktivitas</td>
                                            <td id="totalPoinAktivitas" style="width:50%;"></td>
                                        </tr>
                                        <tr>
                                            <td>Total Poin Penghargaan</td>
                                            <td id="totalPoinPenghargaan"></td>
                                        </tr>
                                        <tr>
                                            <td>Total Keseluruhan Poin</td>
                                            <td id="totalKeseluruhanPoin"></td>
                                        </tr>
									</table>
									<!--end: Datatable -->
                                </div>
                            </div>

                            <!-- <div class="kt-portlet kt-portlet--mobile data-proces data-proces-all-remun" style="display:none;">
                                <div class="kt-portlet__body table-responsive">
									<table class="table  table-bordered table-hover table-checkable">
										<tr>
                                            <td>NKP</td>
                                            <td id="nkp"></td>
                                        </tr>
										<tr>
                                            <td>Gaji 30%</td>
                                            <td id="gaji30p"></td>
                                        </tr>
                                        <tr>
                                            <td>Intensif 25%</td>
                                            <td id="intensif25p"></td>
                                        </tr>
                                        <tr>
                                            <td>Intensif 100%</td>
                                            <td id="intensif100p"></td>
                                        </tr>
                                        <tr>
                                            <td>Intensif 150%</td>
                                            <td id="intensif150p"></td>
                                        </tr>
                                        <tr>
                                            <td>Intensif 200%</td>
                                            <td id="intensif200p"></td>
                                        </tr>
                                        <tr>
                                            <td>Remun 25% Semester</td>
                                            <td id="remun25psmt"></td>
                                        </tr>
                                        <tr>
                                            <td>Remun 100% Semester</td>
                                            <td id="remun100psmt"></td>
                                        </tr>
                                        <tr>
                                            <td>Remun 150% Semester</td>
                                            <td id="remun150psmt"></td>
                                        </tr>
                                        <tr>
                                            <td>Remun 200% Semester</td>
                                            <td id="remun200psmt"></td>
                                        </tr>
                                        <tr>
                                            <td>Remun 100% 12 Bulan</td>
                                            <td id="rem100p12bln"></td>
                                        </tr>
                                        <tr>
                                            <td>Remun 100% Gaji 13 THR</td>
                                            <td id="rem100p_thn_gj13_thr"></td>
                                        </tr>
                                        <tr>
                                            <td>Remun Maximal Per Tahun</td>
                                            <td id="remmaxpthn"></td>
                                        </tr>
									</table>
                                </div>
                            </div> -->

                            <div class="kt-portlet kt-portlet--mobile data-proces data-proces-all-remun" style="display:none;">
                                <div class="kt-portlet__body table-responsive">
                                    <!--begin: Datatable -->
									<table class="table table-bordered table-hover table-checkable">
										<tr>
                                            <th colspan="2">Rekapitulasi</th>
                                        </tr>
										<tr id="remunDtField" style="display:none;">
                                            <td style="width:50%;">Remunerasi Sebagai DT/T</td>
                                            <td id="remunDt" style="width:50%;"></td>
                                        </tr>
                                        <tr id="remunDbField" style="display:none;">
                                            <td style="width:50%;">Remunerasi Sebagai DB</td>
                                            <td id="remunDb" style="width:50%;"></td>
                                        </tr>
                                        <tr id="remunPegField" style="display:none;">
                                            <td style="width:50%;">Remunerasi Sebagai Pegawai</td>
                                            <td id="remunPeg" style="width:50%;"></td>
                                        </tr>
                                        <tr id="totalRemunField" style="display:none;">
                                            <td style="width:50%;">Total Remunerasi</td>
                                            <td id="totalRemun" style="width:50%;"></td>
                                        </tr>
                                    </table>
                                    <table class="table table-bordered table-hover table-checkable">
                                        <tr>
                                            <th colspan="2">Gaji Remun (P1 - 30%)</th>
                                        </tr>
                                        <tr>
                                            <td style="width:50%;">P1 1</td>
                                            <td class="nilai_gaji_remun" style="width:50%;"></td>
                                        </tr>
                                        <tr>
                                            <td>P1 2</td>
                                            <td class="nilai_gaji_remun"></td>
                                        </tr>
                                        <tr>
                                            <td>P1 3</td>
                                            <td class="nilai_gaji_remun"></td>
                                        </tr>
                                        <tr>
                                            <td>P1 4</td>
                                            <td class="nilai_gaji_remun"></td>
                                        </tr>
                                        <tr>
                                            <td>P1 5</td>
                                            <td class="nilai_gaji_remun"></td>
                                        </tr>
                                        <tr>
                                            <td>P1 6</td>
                                            <td class="nilai_gaji_remun"></td>
                                        </tr>
                                        <tr>
                                            <td>Total</td>
                                            <td id="gajiRemun"></td>
                                        </tr>
									</table>
                                    <table class="table table-bordered table-hover table-checkable">
                                        <tr>
                                            <th colspan="2">Insetif Remun (P2-70%)</th>
                                        </tr>
                                        <tr id="insentifDtField" style="display:none;">
                                            <td style="width:50%;">Insentif (P2) sebagai DT/T</td>
                                            <td id="insentifDt" style="width:50%;"></td>
                                        </tr>
                                        <tr id="insentifDbField" style="display:none;">
                                            <td style="width:50%;">Insentif (P2) sebagai DB</td>
                                            <td id="insentifDb" style="width:50%;"></td>
                                        </tr>
                                        <tr id="insentifPegField" style="display:none;">
                                            <td style="width:50%;">Insentif (P2) sebagai Pegawai</td>
                                            <td id="insentifPeg" style="width:50%;"></td>
                                        </tr>
                                        <tr>
                                            <td>Remun Penghargaan</td>
                                            <td id="remunPenghargaan"></td>
                                        </tr>
                                        <tr>
                                            <td>Nilai Maksimal</td>
                                            <td id="nilaiMaksimal"></td>
                                        </tr>
                                        <tr>
                                            <td>Remunerasi Dibayarkan</td>
                                            <td id="remunDibayar"></td>
                                        </tr>
									</table>
									<!--end: Datatable -->
                                </div>
                            </div>
                        </div>
