                        <!-- begin:: Content -->
                        <div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
							<div class="kt-portlet kt-portlet--mobile">
								<div class="kt-portlet__head kt-portlet__head--lg">
									<div class="kt-portlet__head-label">
										<span class="kt-portlet__head-icon">
											<i class="kt-font-brand flaticon2-crisp-icons"></i>
										</span>
										<h3 class="kt-portlet__head-title">
											Data Dokumen Pendukung
										</h3>
									</div>
									<div class="kt-portlet__head-toolbar">
										<div class="kt-portlet__head-wrapper">
											<div class="kt-portlet__head-actions">
												<a href="<?= base_url("proses-remun/dokumen-pendukung/dokumen-baru"); ?>" class="btn btn-brand btn-elevate btn-icon-sm">
													<i class="la la-plus"></i>
													Dokumen Baru
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
                                                <th>No. </th>
												<th>Periode</th>
												<th>No. SK</th>
												<th>Tgl. SK Dokumen</th>
												<th>Actions</th>
											</tr>
										</thead>
										<tbody>
                                            <?php
                                                $i = 1;
                                                foreach($dokumen_pendukung as $row) {
                                                    ?>  
                                                        <tr>
                                                            <td><?= $i++; ?></td>
                                                            <td><?= $row->periode; ?></td>
                                                            <td><?= $row->nomskdokumen; ?></td>
                                                            <td><?= $this->changer->date($row->tglskdokumen, "d-m-Y"); ?></td>
                                                            <td>
																<a class="btn btn-sm btn-clean btn-icon btn-icon-md" href="<?= base_url("proses-remun/dokumen-pendukung/".$row->idi); ?>" title="Edit Dokumen">
																	<i class="la la-edit"></i>
																</a>
                                                                <a href="javascript:void(0);" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Delete Dokumen" onclick="delDokumen('<?= $row->idi; ?>')">
                                                                    <i class="la la-trash"></i>
                                                                </a>
                                                                <a href="<?= base_url("proses-remun/dokumen-pendukung/dokumen-download/".$row->idi); ?>" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Download Dokumen">
                                                                    <i class="la la-cloud-download"></i>
                                                                </a>
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