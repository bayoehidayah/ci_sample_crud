                        <!-- begin:: Content -->
                        <div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
                            <form action="#" id="searchReports" enctype="multipart/form-data" method="post">
                                <div class="kt-portlet kt-portlet--mobile">
                                    <div class="kt-portlet__head kt-portlet__head--lg">
                                        <div class="kt-portlet__head-label">
                                            <span class="kt-portlet__head-icon">
                                                <i class="kt-font-brand flaticon2-search"></i>
                                            </span>
                                            <h3 class="kt-portlet__head-title">
                                                Cari Berdasarkan Tanggal
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
													<label>Tanggal</label>
													<input type="text" name="tanggal" class="form-control" id="tanggal" required placeholder="Pilih Tanggal">
												</div>
											</div>
                                        </div>
                                    </div>
                                </div>
                            </form>

                            <div class="kt-portlet kt-portlet--mobile" id="informationSection" style="display:none;">
                                <div class="kt-portlet__head kt-portlet__head--lg">
                                    <div class="kt-portlet__head-label">
                                        <span class="kt-portlet__head-icon">
                                            <i class="kt-font-brand flaticon2-file"></i>
                                        </span>
                                        <h3 class="kt-portlet__head-title">
                                            Informasi
                                        </h3>
                                    </div>
                                </div>
                                <div class="kt-portlet__body table-responsive">
                                    <table class="table table-striped table-bordered table-hover">
                                        <tbody>
                                            <tr>
                                                <td width="45%">Tanggal</td>
                                                <td width="5%">:</td>
                                                <td id="tanggalSection"></td>
                                            </tr>
                                            <tr>
                                                <td>Total Keseluruhan Modal</td>
                                                <td>:</td>
                                                <td id="totalModal"></td>
                                            </tr>
                                            <tr>
                                                <td>Total Keseluruhan Penjualan</td>
                                                <td>:</td>
                                                <td id="totalPenjualan"></td>
                                            </tr>
                                            <tr>
                                                <td>Total Keuntungan</td>
                                                <td>:</td>
                                                <td id="totalKeuntungan"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="row" id="reportResults"></div>
                        </div>