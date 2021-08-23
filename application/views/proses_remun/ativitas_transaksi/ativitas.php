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
                                            <div class="col-md-12 col-sm-12 col-lg-12">
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
                                            <div class="col-md-6 col-sm-12 col-lg-6">
												<div class="form-group">
													<label>Transaksi</label>
													<select class="form-control m-select2" id="transaksiForm" name="transaksi" required>
														<option value="" selected disabled>Pilih Transaksi</option>
														<option value="Tupoksi">Tupoksi</option>
														<option value="Mengajar">Mengajar</option>
														<option value="Mengajar Lainnya">Mengajar Lainnya</option>
														<option value="Penelitian">Penelitian</option>
														<option value="Pengabdian">Pengabdian</option>
														<option value="Penghargaan">Penghargaan</option>
														<option value="Penunjang">Penunjang</option>
													</select>
												</div>
											</div>
                                        </div>
                                    </div>
                                </div>
                            </form>

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
                                <div class="kt-portlet__body">
                                    <!--begin: Datatable -->
									<table class="table table-striped- table-bordered table-hover table-checkable" id="tableTupoksi">
										<thead>
											<tr>
												<th>No</th>
												<th>Bulan</th>
                                                <th>Peran</th>
												<th>Capaian</th>
                                                <th>Dokumen</th>
												<th>Poin</th>
											</tr>
										</thead>
										<tbody id="bodyTableTupoksi">

										</tbody>
                                        <tfoot>
                                            <tr>
                                                <th colspan="5">Total Poin</th>
                                                <th id="tupoksiTotalPoin"></th>
                                            </tr>
                                            <tr>
                                                <th colspan="5">Total Harga</th>
                                                <th id="tupoksiTotalHarga"></th>
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
                                <div class="kt-portlet__body">
                                    <!--begin: Datatable -->
									<table class="table table-striped- table-bordered table-hover table-checkable" id="tableMengajar">
										<thead>
											<tr>
												<th>No</th>
												<th>Peran</th>
												<th>Matkul</th>
												<th>Dokumen</th>
												<th>Jlh. Mahasiswa</th>
                                                <th>Poin</th>
											</tr>
										</thead>
										<tbody id="bodyTableMengajar">

										</tbody>
                                        <tfoot>
                                            <tr>
                                                <th colspan="5">Total Poin</th>
                                                <th id="mengajarTotalPoin"></th>
                                            </tr>
                                            <tr>
                                                <th colspan="5">Total Harga</th>
                                                <th id="mengajarTotalHarga"></th>
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
                                <div class="kt-portlet__body">
                                    <!--begin: Datatable -->
									<table class="table table-striped- table-bordered table-hover table-checkable" id="tableMengajarLainnya">
										<thead>
											<tr>
												<th>No</th>
												<th>Peran</th>
												<th>Dokumen</th>
												<th>Jlh. Mahasiswa</th>
                                                <th>Poin</th>
											</tr>
										</thead>
										<tbody id="bodyTableMengajarLainnya">

										</tbody>
                                        <tfoot>
                                            <tr>
                                                <th colspan="4">Total Poin</th>
                                                <th id="mengajarLainnyaTotalPoin"></th>
                                            </tr>
                                            <tr>
                                                <th colspan="4">Total Harga</th>
                                                <th id="mengajarLainnyaTotalHarga"></th>
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
                                <div class="kt-portlet__body">
                                    <!--begin: Datatable -->
									<table class="table table-striped- table-bordered table-hover table-checkable" id="tablePenelitian">
										<thead>
											<tr>
												<th>No</th>
												<th>Peran</th>
												<th>Dokumen</th>
                                                <th>Poin</th>
											</tr>
										</thead>
										<tbody id="bodyTablePenelitian">

										</tbody>
                                        <tfoot>
                                            <tr>
                                                <th colspan="3">Total Poin</th>
                                                <th id="penelitianTotalPoin"></th>
                                            </tr>
                                            <tr>
                                                <th colspan="3">Total Harga</th>
                                                <th id="penelitianTotalHarga"></th>
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
                                <div class="kt-portlet__body">
                                    <!--begin: Datatable -->
									<table class="table table-striped- table-bordered table-hover table-checkable" id="tablePengabdian">
										<thead>
											<tr>
												<th>No</th>
												<th>Peran</th>
												<th>Dokumen</th>
                                                <th>Poin</th>
											</tr>
										</thead>
										<tbody id="bodyTablePengabdian">

										</tbody>
                                        <tfoot>
                                            <tr>
                                                <th colspan="3">Total Poin</th>
                                                <th id="pengabdianTotalPoin"></th>
                                            </tr>
                                            <tr>
                                                <th colspan="3">Total Harga</th>
                                                <th id="pengabdianTotalHarga"></th>
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
                                <div class="kt-portlet__body">
                                    <!--begin: Datatable -->
									<table class="table table-striped- table-bordered table-hover table-checkable" id="tablePenghargaan">
										<thead>
											<tr>
												<th>No</th>
												<th>Peran</th>
												<th>Dokumen</th>
                                                <th>Poin</th>
											</tr>
										</thead>
										<tbody id="bodyTablePenghargaan">

										</tbody>
                                        <tfoot>
                                            <tr>
                                                <th colspan="3">Total Poin</th>
                                                <th id="penghargaanTotalPoin"></th>
                                            </tr>
                                            <tr>
                                                <th colspan="3">Total Harga</th>
                                                <th id="penghargaanTotalHarga"></th>
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
                                <div class="kt-portlet__body">
                                    <!--begin: Datatable -->
									<table class="table table-striped- table-bordered table-hover table-checkable" id="tablePenunjang">
										<thead>
											<tr>
												<th>No</th>
												<th>Peran</th>
												<th>Dokumen</th>
                                                <th>Poin</th>
											</tr>
										</thead>
										<tbody id="bodyTablePenunjang">

										</tbody>
                                        <tfoot>
                                            <tr>
                                                <th colspan="3">Total Poin</th>
                                                <th id="penunjangTotalPoin"></th>
                                            </tr>
                                            <tr>
                                                <th colspan="3">Total Harga</th>
                                                <th id="penunjangTotalHarga"></th>
                                            </tr>
                                        </tfoot>
									</table>
									<!--end: Datatable -->
                                </div>
                            </div>
                        </div>
