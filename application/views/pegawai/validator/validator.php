                        <!-- begin:: Content -->
                        <div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
							<div class="kt-portlet kt-portlet--mobile">
								<div class="kt-portlet__head kt-portlet__head--lg">
									<div class="kt-portlet__head-label">
										<span class="kt-portlet__head-icon">
											<i class="kt-font-brand flaticon2-crisp-icons"></i>
										</span>
										<h3 class="kt-portlet__head-title">
											Data Validator
										</h3>
									</div>
									<div class="kt-portlet__head-toolbar">
										<div class="kt-portlet__head-wrapper">
											<div class="kt-portlet__head-actions">
												<a href="<?= base_url("pegawai/validator/validator-baru"); ?>" class="btn btn-brand btn-elevate btn-icon-sm">
													<i class="la la-plus"></i>
													Validator Baru
												</a>
											</div>
										</div>
									</div>
								</div>
								<div class="kt-portlet__body">
									<!--begin: Datatable -->
									<table class="table table-striped- table-bordered table-hover table-checkable" id="tableValidator">
										<thead>
											<tr>
												<!-- <th>No</th> -->
												<th>Kode Pegawai</th>
												<th>Nama</th>
												<th>Unit Kerja</th>
												<th>Satuan Kerja</th>
												<th>Actions</th>
											</tr>
										</thead>
										<tbody>
                                            <?php
                                                foreach($validator_user as $row){
                                                    ?>
                                                        <tr>
                                                            <td><?= $row->kdepeg ?></td>
                                                            <td><?= $row->nmapanjang ?></td>
                                                            <td><?= $row->kdeukerja. " <br/> ".$row->nmaukerja ?></td>
                                                            <td><?= $row->kdesatker. " <br/> ".$row->nmasatker ?></td>
                                                            <td>
                                                                <a href="javascript:void(0);" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Delete Akun Validator" onclick="delValidator('<?= $row->kdepeg ?>');"><i class="la la-trash"></i></a>
                                                            </td>
                                                        </tr>
                                                    <?php
                                                }
                                            ?>
										</tbody>
									</table>

									<!--end: Datatable -->
								</div>
							</div>
                        </div>