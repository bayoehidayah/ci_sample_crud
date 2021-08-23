                        <!-- begin:: Content -->
                        <div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
							<div class="kt-portlet kt-portlet--mobile">
								<div class="kt-portlet__head kt-portlet__head--lg">
									<div class="kt-portlet__head-label">
										<span class="kt-portlet__head-icon">
											<i class="kt-font-brand flaticon2-avatar"></i>
										</span>
										<h3 class="kt-portlet__head-title">
											Pengguna
										</h3>
									</div>
									<div class="kt-portlet__head-toolbar">
										<div class="kt-portlet__head-wrapper">
											<div 1class="kt-portlet__head-actions">
												<a href="<?= base_url("pengguna/pengguna-baru"); ?>" class="btn btn-brand btn-elevate btn-icon-sm">
													<i class="la la-plus"></i>
													Pengguna Baru
												</a>
											</div>
										</div>
									</div>
								</div>
								<div class="kt-portlet__body">

									<!--begin: Datatable -->
									<table class="table table-striped table-bordered table-hover table-checkable" id="tablePengguna">
										<thead>
											<tr>
                                                <th>ID</th>
												<th>Nama</th>
                                                <th>Jenis Pengguna</th>
												<th>Email</th>
												<th>Terdaftar Pada</th>
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