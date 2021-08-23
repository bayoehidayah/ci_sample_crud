                        <!-- begin:: Content -->
                        <div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
							<div class="kt-portlet kt-portlet--mobile">
								<div class="kt-portlet__head kt-portlet__head--lg">
									<div class="kt-portlet__head-label">
										<span class="kt-portlet__head-icon">
											<i class="kt-font-brand flaticon2-crisp-icons"></i>
										</span>
										<h3 class="kt-portlet__head-title">
											Data Transaksi
										</h3>
									</div>
									<div class="kt-portlet__head-toolbar">
										<div class="kt-portlet__head-wrapper">
											<div class="kt-portlet__head-actions">
												<a href="javascript:void(0);" class="btn btn-brand btn-elevate btn-icon-sm" id="btnAdd" data-toggle="modal" data-target="#modalTransaksi">
                        							<i class="la la-plus"></i>
                        							Transaksi Baru
                        						</a>
											</div>
										</div>
									</div>
								</div>
								<div class="kt-portlet__body">

									<!--begin: Datatable -->
									<table class="table table-striped- table-bordered table-hover table-checkable" id="table">
										<thead>
											<tr>
                                                <th>No. Faktur </th>
												<th>Item</th>
												<th>Jumlah</th>
												<th>Tanggal</th>
												<th>Harga</th>
												<th>Pengguna</th>
												<th>Actions</th>
											</tr>
										</thead>
										<tbody>
										</tbody>
									</table>

									<!--end: Datatable -->
								</div>
							</div>
                        </div>

						<!-- Modal -->
                        <form enctype="multipart/form-data" method="post" id="transaksiForm" class="kt-form kt-form--label-right">
                            <input type="hidden" name="edit" id="editData" value="false">
                        	<div class="modal fade" id="modalTransaksi" tabindex="-1" role="dialog"
                        		aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        		<div class="modal-dialog modal-dialog-centered" role="document">
                        			<div class="modal-content">
                        				<div class="modal-header">
                        					<h5 class="modal-title" id="modalTransaksiTitle">Transaksi Baru</h5>
                        					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        					</button>
                        				</div>
                        				<div class="modal-body">
                        					<div class="form-group">
                                                <label>No. Faktur *</label>
												<div class="input-group">
													<input type="text" name="id" id="noFaktur" class="form-control" maxlength="11" value="<?= $faktur_code; ?>" required>
													<div class="input-group-append">
														<button class="btn btn-default" id="btnRefresh" type="button" onclick="refreshFakturCode()" data-toggle="tooltip" data-title="Refresh Kode Faktur"><span class="fa fa-sync-alt"></span></button>
													</div>
												</div>
                                            </div>

                        					<div class="form-group">
                                                <label>Barang *</label>
                                                <select class="form-control m-select2" id="barang" name="id_barang">
													<option value="" selected disabled>Pilih Barang</option>
													<?php
														foreach($barang as $row){
															echo '<option value="'.$row->id.'">'.$row->id.' - '.$row->nama.'</option>';
														}
													?>
												</select>
                                            </div>

											<div class="form-group">
                                                <label>Harga Jual</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend"><span class="input-group-text">Rp</span></div>
													<input type="hidden" id="hargaJualData" value="">
                                                    <input type="number" class="form-control" placeholder="Silahkan Pilih Barang" name="harga_jual" id="hargaJual" readonly>
                                                </div>
                                            </div>
											
											<div class="form-group">
												<label>Tanggal *</label>
												<input type="text" class="form-control" placeholder="Pilih Tanggal" name="tanggal" id="tanggal" required>
											</div>

                        					<div class="form-group">
                                                <label>Jumlah *</label>
                                                <div class="input-group">
                                                    <input type="number" class="form-control" placeholder="Jumlah Pembelian" name="jumlah" id="jumlah" required>
                                                </div>
                                            </div>

											<div class="form-group">
                                                <label>Pembeli *</label>
                                                <select class="form-control m-select2" id="users" name="id_users">
													<option value="" selected disabled>Pilih Pembeli</option>
													<option value="non-registered-user">Non-Registered User</option>
													<?php
														foreach($users as $row){
															echo '<option value="'.$row->id.'">'.$row->id.' - '.$row->nama.'</option>';
														}
													?>
												</select>
                                            </div>

											<div class="form-group">
                                                <label>Total Jual</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend"><span class="input-group-text">Rp</span></div>
                                                    <input type="number" class="form-control" placeholder="Jumlah * Harga Jual" name="total_jual" id="totalJual" readonly>
                                                </div>
                                            </div>
											
											<div class="form-group" id="namaUserSection" style="display:none;">
                                                <label>Nama Pembeli *</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" placeholder="Nama Pembeli" name="nama_user" id="nama_user">
                                                </div>
                                            </div>
                        				</div>
                        				<div class="modal-footer">
                        					<button type="button" class="btn btn-secondary"
                        						data-dismiss="modal">Close</button>
                        					<button type="submi" class="btn btn-primary">Save</button>
                        				</div>
                        			</div>
                        		</div>
                        	</div>
                        </form>