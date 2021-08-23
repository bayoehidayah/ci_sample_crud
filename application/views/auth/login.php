        <!-- begin:: Page -->
        <div class="kt-grid kt-grid--ver kt-grid--root">
			<div class="kt-grid kt-grid--hor kt-grid--root  kt-login kt-login--v1" id="kt_login">
				<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--desktop kt-grid--ver-desktop kt-grid--hor-tablet-and-mobile">

					<!--begin::Aside-->
					<div class="kt-grid__item kt-grid__item--order-tablet-and-mobile-2 kt-grid kt-grid--hor kt-login__aside" style="background-image: url(<?= base_url("assets/media//bg/bg-4.jpg"); ?>);">
						<div class="kt-grid__item">
							<a href="#" class="kt-login__logo">
								<!-- <img src="<?= base_url("assets/media/logos/logo remun.png"); ?>"> -->
							</a>
						</div>
						<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver">
							<div class="kt-grid__item kt-grid__item--middle">
								<h3 class="kt-login__title">Koperasi Darul Adib</h3>
								<!-- <h4 class="kt-login__subtitle">Sistem Informasi Remunerasi Uiversitas Negeri Medan</h4>
								<h4 class="kt-login__subtitle">Perbaikan di dalam aplikasi</h4>
								<ol class="kt-login__subtitle">
									<li>Remun & Blu Unimed Added</li>
									<li>Validator Added</li>
									<li>Sistem Validasi Transaksi</li>
									<li>Penyesuaian Sistem untuk Validator</li>
									<li>Perbaikan routing untuk pegawai remun unimed</li>
									<li>Verifikator & Fitur Verifikasi</li>
								</ol> -->
							</div>
						</div>
						<div class="kt-grid__item">
							<div class="kt-login__info">
								<div class="kt-login__copyright">
									&copy <?= date("Y"); ?> - DARUL ADIB | VERSION 1.0
								</div>
								<div class="kt-login__menu">
									<a href="https://www.daruladib.com/" class="kt-link">DARUL ADIB</a>
								</div>
							</div>
						</div>
					</div>

					<!--begin::Aside-->

					<!--begin::Content-->
					<div class="kt-grid__item kt-grid__item--fluid  kt-grid__item--order-tablet-and-mobile-1  kt-login__wrapper">

						<!--begin::Head-->
						<!-- <div class="kt-login__head">
							<span class="kt-login__signup-label">Don't have an account yet?</span>&nbsp;&nbsp;
							<a href="#" class="kt-link kt-login__signup-link">Sign Up!</a>
						</div> -->

						<!--end::Head-->

						<!--begin::Body-->
						<div class="kt-login__body">

							<!--begin::Signin-->
							<div class="kt-login__form">
								<div class="kt-login__title">
										<img src="<?= base_url("assets/media/logos/logo remun.png"); ?>">
								</div>

								<!--begin::Form-->
								<form action="#" enctype="multipart/form-data" method="post" id="formLogin">
									<div class="form-group">
										<input class="form-control" type="email" placeholder="Email" name="email" autocomplete="off" required>
									</div>
									<div class="form-group">
										<input class="form-control" type="password" placeholder="Password" name="password" required>
									</div>

									<!--begin::Action-->
									<div class="kt-login__actions">
										<!-- <a href="#" class="kt-link kt-login__link-forgot">
											Forgot Password ?
										</a> -->
										<button id="kt_login_signin_submit" class="btn btn-primary btn-elevate kt-login__btn-primary" type="submit">Sign In</button>
									</div>

									<!--end::Action-->
								</form>

								<!--end::Form-->

							</div>

							<!--end::Signin-->
						</div>

						<!--end::Body-->
					</div>

					<!--end::Content-->
				</div>
			</div>
		</div>

		<!-- end:: Page -->
