                        <!-- begin:: Content -->
                        <div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
                        	<div class="kt-portlet kt-portlet--mobile">
                        		<div class="kt-portlet__head kt-portlet__head--lg">
                        			<div class="kt-portlet__head-label">
                        				<span class="kt-portlet__head-icon">
                        					<i class="kt-font-brand     flaticon2-list-1"></i>
                        				</span>
                        				<h3 class="kt-portlet__head-title">
                        					Stok Barang
                        				</h3>
                        			</div>
                        			<div class="kt-portlet__head-toolbar">
                        				<div class="kt-portlet__head-wrapper">
                        					<div 1class="kt-portlet__head-actions">
                        						<a href="javascript:void(0);" class="btn btn-brand btn-elevate btn-icon-sm" id="btnAdd" data-toggle="modal" data-target="#modalBarang">
                        							<i class="la la-plus"></i>
                        							Stok Barang
                        						</a>
                        					</div>
                        				</div>
                        			</div>
                        		</div>
                        		<div class="kt-portlet__body">
                        			<!--begin: Datatable -->
                        			<table class="table table-striped table-bordered table-hover table-checkable"
                        				id="tableBarang">
                        				<thead>
                        					<tr>
                        						<th>ID</th>
                        						<th>Barang</th>
                        						<th>Stok Awal</th>
                        						<th>Pembelian</th>
                        						<th>Penjualan</th>
                        						<th>Sisa Stok</th>
                        						<th>Dibuat Pada</th>
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
						 <form enctype="multipart/form-data" method="post" id="barangForm" class="kt-form kt-form--label-right">
                            <input type="hidden" name="edit" id="editData" value="false">
                        	<div class="modal fade" id="modalBarang" role="dialog"
                        		aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        		<div class="modal-dialog modal-dialog-centered" role="document">
                        			<div class="modal-content">
                        				<div class="modal-header">
                        					<h5 class="modal-title" id="modalBarangTitle">Stok Baru</h5>
                        					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        					</button>
                        				</div>
                        				<div class="modal-body">
                        					<div class="form-group">
                                                <label>Barang *</label>
                                                <select name="barang" id="barang" class="form-control m-select2">
													<?php foreach($barang as $d){ ?>
														<option value="<?= $d->id; ?>"> <?= $d->nama; ?></option>
													<?php } ?>
												</select>
                                            </div>
                        					<div class="form-group">
                                                <label>Stok Awal *</label>
                                                <input type="number" name="stok_awal" id="stokAwal" class="form-control" value="0" required>
                                            </div>
                        					<div class="form-group">
                                                <label>Pembelian *</label>
                                                <input type="number" name="pembelian" id="pembelian" class="form-control" value="0" required>
                                            </div>
                        					<div class="form-group">
                                                <label>Penjualan *</label>
                                                <input type="number" name="penjualan" id="penjualan" class="form-control" value="0" required>
                                            </div>
                        					<div class="form-group">
                                                <label>Sisa Stok *</label>
                                                <input type="number" name="sisa_stok" id="sisaStok" class="form-control" value="0" required>
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