                        <!-- begin:: Content -->
                        <form action="<?= $url; ?>" method="post" class="kt-form kt-form--label-right" id="fakturForm">
                        	<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
                        		<div class="kt-portlet kt-portlet--mobile">
                        			<div class="kt-portlet__head kt-portlet__head--lg">
                        				<div class="kt-portlet__head-label">
                        					<span class="kt-portlet__head-icon">
                        						<i class="kt-font-brand     flaticon2-file"></i>
                        					</span>
                        					<h3 class="kt-portlet__head-title">
                        						<?= $title; ?>
                        					</h3>
                        				</div>
                        			</div>
                        			<div class="kt-portlet__body">
                        				<div class="form-group row">
                        					<label for="nama" class="col-2 col-form-label">Nama Pelanggan</label>
                        					<div class="col-10">
                        						<input class="form-control" type="text" name="nama" id="nama">
                        					</div>
                        				</div>
                        				<div class="form-group row">
                        					<label for="nama" class="col-2 col-form-label">Total Barang</label>
                        					<div class="col-10">
                        						<input type="text" class="form-control" placeholder="Total Barang"
                        							readonly id="totalBarang">
                        					</div>
                        				</div>
                        				<div class="form-group row">
                        					<label for="nama" class="col-2 col-form-label">Total Harga</label>
                        					<div class="col-10">
                        						<div class="input-group">
                        							<div class="input-group-prepend">
                        								<span class="input-group-text">Rp</span>
                        							</div>
                        							<input type="text" class="form-control" placeholder="Total Harga"
                        								readonly id="totalHarga">
                        						</div>
                        					</div>
                        				</div>
                        			</div>
                        		</div>

                        		<div class="kt-portlet kt-portlet--mobile">
                        			<div class="kt-portlet__head kt-portlet__head--lg">
                        				<div class="kt-portlet__head-label">
                        					<span class="kt-portlet__head-icon">
                        						<i class="kt-font-brand     flaticon2-list-1"></i>
                        					</span>
                        					<h3 class="kt-portlet__head-title">
                        						Daftar Barang
                        					</h3>
                        				</div>
										<div class="kt-portlet__head-toolbar">
											<div class="kt-portlet__head-wrapper">
												<div class="kt-portlet__head-actions">
													<a href="javascript:void(0);" class="btn btn-brand btn-elevate btn-icon-sm" id="btnAdd" data-toggle="modal" data-target="#modalBarang">
														<i class="la la-plus"></i>
														Barang
													</a>
												</div>
											</div>
										</div>
                        			</div>
                        			<div class="kt-portlet__body">
                        				<!--begin: Datatable -->
                        				<table class="table table-striped table-bordered table-hover table-checkable"
                        					id="tableItems">
                        					<thead>
                        						<tr>
                        							<th>#</th>
                        							<th>Barang</th>
                        							<th>Total</th>
                        							<th>Harga</th>
                        							<th>Dibuat Pada</th>
                        							<th>Actions</th>
                        						</tr>
                        					</thead>
                        					<tbody>

                        					</tbody>
                        				</table>
                        			</div>
                        		</div>
                        	</div>
                        </form>
						<form action="#" method="post" id="addItem">
						<div class="modal fade" id="modalBarang" tabindex="-1" role="dialog"
                        		aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        		<div class="modal-dialog modal-dialog-centered" role="document">
                        			<div class="modal-content">
                        				<div class="modal-header">
                        					<h5 class="modal-title" id="modalBarangTitle">Barang</h5>
                        					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        					</button>
                        				</div>
                        				<div class="modal-body">
                        					<div class="form-group">
                                                <label>Barang *</label>
												<select class="form-control m-select2" id="barangForm" name="barang" required>
													<option value="" selected disabled>Pilih Barang</option>
													<?php
														foreach($barang as $row){
															echo '<option value="'.$row->id.'" selected>'.$row->nama.'</option>';
														}
													?>
												</select>
                                            </div>
                        					<div class="form-group">
                                                <label>Harga *</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend"><span class="input-group-text">Rp</span></div>
                                                    <input type="number" class="form-control" placeholder="Harga" name="harga" id="harga" required>
                                                </div>
                                            </div>

                        					<div class="form-group">
                                                <label>Stok *</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend"><span class="input-group-text">Rp</span></div>
                                                    <input type="number" class="form-control" placeholder="Stok" name="stok" id="stok" required>
                                                </div>
                                            </div>
                        				</div>
                        				<div class="modal-footer">
                        					<button type="button" class="btn btn-secondary"
                        						data-dismiss="modal">Close</button>
                        					<button type="submi" class="btn btn-primary">Save changes</button>
                        				</div>
                        			</div>
                        		</div>
                        	</div>
						</form>