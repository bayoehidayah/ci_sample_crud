                        <!-- begin:: Content -->
                        <div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
							<div class="kt-portlet kt-portlet--mobile">
								<div class="kt-portlet__head kt-portlet__head--lg">
									<div class="kt-portlet__head-label">
										<span class="kt-portlet__head-icon">
											<i class="kt-font-brand flaticon2-crisp-icons"></i>
										</span>
										<h3 class="kt-portlet__head-title">
											Data Transaksi Penunjang
										</h3>
									</div>
									<?php if($level != "Validator" && $level != "Verifikator") { ?>
									<div class="kt-portlet__head-toolbar">
										<div class="kt-portlet__head-wrapper">
											<div class="kt-portlet__head-actions">
												<a href="<?= base_url("aplikasi-unit-kerja/transaksi-penunjang/transaksi-baru"); ?>" class="btn btn-brand btn-elevate btn-icon-sm">
													<i class="la la-plus"></i>
													Transaksi Penunjang Baru
												</a>
											</div>
										</div>
									</div>
									<?php } ?>
								</div>
								<div class="kt-portlet__body">
									<!--begin: Datatable -->
									<table class="table table-striped- table-bordered table-hover table-checkable" id="tablePenunjang">
										<thead>
											<tr>
												<th>Periode</th>
												<th>Kode Pegawai</th>
												<th>Kode Peran</th>
												<th>Status Validasi</th>
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