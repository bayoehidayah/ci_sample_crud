                        <!-- begin:: Content -->
                        <div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
                        	<div class="kt-portlet kt-portlet--mobile">
                        		<div class="kt-portlet__head kt-portlet__head--lg">
                        			<div class="kt-portlet__head-label">
                        				<span class="kt-portlet__head-icon">
                        					<i class="kt-font-brand     flaticon2-list-1"></i>
                        				</span>
                        				<h3 class="kt-portlet__head-title">
                        					Simpanan
                        				</h3>
                        			</div>
                        			<div class="kt-portlet__head-toolbar">
                        				<div class="kt-portlet__head-wrapper">
                        					<div 1class="kt-portlet__head-actions">
                        						<a href="javascript:void(0);" class="btn btn-brand btn-elevate btn-icon-sm" id="btnAdd" data-toggle="modal" data-target="#modalSimpanan">
                        							<i class="la la-plus"></i>
                        							Simpanan Baru
                        						</a>
                        					</div>
                        				</div>
                        			</div>
                        		</div>
                        		<div class="kt-portlet__body">

                        			<!--begin: Datatable -->
                        			<table class="table table-striped- table-bordered table-hover table-checkable"
                        				id="tableSimpanan">
                        				<thead>
                        					<tr>
                        						<th>ID</th>
                        						<th>ID User</th>
                        						<th>Jenis</th>
                        						<th>Nilai</th>
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
                        <form enctype="multipart/form-data" method="post" id="simpananForm" class="kt-form kt-form--label-right">
							<input type="hidden" name="id" id="idData">
                            <input type="hidden" name="edit" id="editData" value="false">
                        	<div class="modal fade" id="modalSimpanan" tabindex="-1" role="dialog"
                        		aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        		<div class="modal-dialog modal-dialog-centered" role="document">
                        			<div class="modal-content">
                        				<div class="modal-header">
                        					<h5 class="modal-title" id="modalSimpananTitle">Simpanan Baru</h5>
                        					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        					</button>
                        				</div>
                        				<div class="modal-body">
											<div class="form-group">
                                                <label>Pengguna *</label>
                                                <select class="form-control m-select2" id="users" name="id_users">
													<option value="" selected disabled>Pilih Pengguna</option>
													<?php
														foreach($users as $row){
															echo '<option value="'.$row->id.'">'.$row->id.' - '.$row->nama.'</option>';
														}
													?>
												</select>
                                            </div>
                        					<div class="form-group">
												<label>Jenis *</label>
                                                <select class="form-control" id="jenis" name="jenis">
													<option value="" selected disabled>-- Pilih Jenis --</option>
													<?php
														foreach($jenis as $row){
															echo '<option value="'.$row.'">'.$row.'</option>';
														}
													?>
												</select>
                                            </div>
                        					<div class="form-group">
                                                <label>Nilai *</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend"><span class="input-group-text">Rp</span></div>
                                                    <input type="number" class="form-control" placeholder="Nilai" name="nilai" id="nilai" required>
                                                </div>
                                            </div>
                        				</div>
                        				<div class="modal-footer">
                        					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        					<button type="submi" class="btn btn-primary">Save changes</button>
                        				</div>
                        			</div>
                        		</div>
                        	</div>
                        </form>
