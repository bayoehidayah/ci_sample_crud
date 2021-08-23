<?php
	$uri_1 = $this->uri->segment(1);
	$uri_2 = $this->uri->segment(2);
	$uri_3 = $this->uri->segment(3);
?>
<!-- begin:: Header Mobile -->
<div id="kt_header_mobile" class="kt-header-mobile  kt-header-mobile--fixed ">
	<div class="kt-header-mobile__logo">
		<a href="<?= base_url(); ?>">
			<h3>BAYU</h3>
		</a>
	</div>
	<div class="kt-header-mobile__toolbar">
		<button class="kt-header-mobile__toggler kt-header-mobile__toggler--left"
			id="kt_aside_mobile_toggler"><span></span></button>
		<button class="kt-header-mobile__topbar-toggler" id="kt_header_mobile_topbar_toggler"><i
				class="flaticon-more"></i></button>
	</div>
</div>

<!-- end:: Header Mobile -->
<div class="kt-grid kt-grid--hor kt-grid--root">
	<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">

		<!-- begin:: Aside -->
		<button class="kt-aside-close " id="kt_aside_close_btn"><i class="la la-close"></i></button>
		<div class="kt-aside  kt-aside--fixed  kt-grid__item kt-grid kt-grid--desktop kt-grid--hor-desktop"
			id="kt_aside">

			<!-- begin:: Aside -->
			<div class="kt-aside__brand kt-grid__item " id="kt_aside_brand">
				<div class="kt-aside__brand-logo">
					<a href="<?= base_url(); ?>">
						<h3>BAYU</h3>
					</a>
				</div>
			</div>

			<!-- end:: Aside -->

			<!-- begin:: Aside Menu -->
			<div class="kt-aside-menu-wrapper kt-grid__item kt-grid_	_item--fluid" id="kt_aside_menu_wrapper">
				<div id="kt_aside_menu" class="kt-aside-menu " data-ktmenu-vertical="1" data-ktmenu-scroll="1"
					data-ktmenu-dropdown-timeout="500">
					<ul class="kt-menu__nav ">
						<li class="kt-menu__item  <?php if($uri_1 == "" || $uri_1 == "dashboard") { echo "kt-menu__item--active"; } ?>"
							aria-haspopup="true">
							<a href="<?= base_url("dashboard"); ?>" class="kt-menu__link "><span
									class="kt-menu__link-icon"><svg xmlns="http://www.w3.org/2000/svg"
										xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
										viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
										<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
											<polygon id="Bound" points="0 0 24 0 24 24 0 24" />
											<path
												d="M12.9336061,16.072447 L19.36,10.9564761 L19.5181585,10.8312381 C20.1676248,10.3169571 20.2772143,9.3735535 19.7629333,8.72408713 C19.6917232,8.63415859 19.6104327,8.55269514 19.5206557,8.48129411 L12.9336854,3.24257445 C12.3871201,2.80788259 11.6128799,2.80788259 11.0663146,3.24257445 L4.47482784,8.48488609 C3.82645598,9.00054628 3.71887192,9.94418071 4.23453211,10.5925526 C4.30500305,10.6811601 4.38527899,10.7615046 4.47382636,10.8320511 L4.63,10.9564761 L11.0659024,16.0730648 C11.6126744,16.5077525 12.3871218,16.5074963 12.9336061,16.072447 Z"
												id="Shape" fill="#000000" fill-rule="nonzero" />
											<path
												d="M11.0563554,18.6706981 L5.33593024,14.122919 C4.94553994,13.8125559 4.37746707,13.8774308 4.06710397,14.2678211 C4.06471678,14.2708238 4.06234874,14.2738418 4.06,14.2768747 L4.06,14.2768747 C3.75257288,14.6738539 3.82516916,15.244888 4.22214834,15.5523151 C4.22358765,15.5534297 4.2250303,15.55454 4.22647627,15.555646 L11.0872776,20.8031356 C11.6250734,21.2144692 12.371757,21.2145375 12.909628,20.8033023 L19.7677785,15.559828 C20.1693192,15.2528257 20.2459576,14.6784381 19.9389553,14.2768974 C19.9376429,14.2751809 19.9363245,14.2734691 19.935,14.2717619 L19.935,14.2717619 C19.6266937,13.8743807 19.0546209,13.8021712 18.6572397,14.1104775 C18.654352,14.112718 18.6514778,14.1149757 18.6486172,14.1172508 L12.9235044,18.6705218 C12.377022,19.1051477 11.6029199,19.1052208 11.0563554,18.6706981 Z"
												id="Path" fill="#000000" opacity="0.3" />
										</g>
									</svg>
								</span>
								<span class="kt-menu__link-text">Dashboard</span>
							</a>
						</li>
						<li class="kt-menu__section ">
							<h4 class="kt-menu__section-text">General Menu</h4>
							<i class="kt-menu__section-icon flaticon-more-v2"></i>
						</li>

						<!-- Barang -->
						<li class="kt-menu__item <?php if($uri_1 == "barang"){echo 'kt-menu__item--open kt-menu__item--here';}?>"
							aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
							<a href="<?= base_url("barang"); ?>" class="kt-menu__link"> 
								<span class="kt-menu__link-icon">
									<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
										<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
											<rect id="bound" x="0" y="0" width="24" height="24"/>
											<path d="M4.5,21 L21.5,21 C22.3284271,21 23,20.3284271 23,19.5 L23,8.5 C23,7.67157288 22.3284271,7 21.5,7 L11,7 L8.43933983,4.43933983 C8.15803526,4.15803526 7.77650439,4 7.37867966,4 L4.5,4 C3.67157288,4 3,4.67157288 3,5.5 L3,19.5 C3,20.3284271 3.67157288,21 4.5,21 Z" id="Combined-Shape" fill="#000000" opacity="0.3"/>
											<path d="M2.5,19 L19.5,19 C20.3284271,19 21,18.3284271 21,17.5 L21,6.5 C21,5.67157288 20.3284271,5 19.5,5 L9,5 L6.43933983,2.43933983 C6.15803526,2.15803526 5.77650439,2 5.37867966,2 L2.5,2 C1.67157288,2 1,2.67157288 1,3.5 L1,17.5 C1,18.3284271 1.67157288,19 2.5,19 Z" id="Combined-Shape-Copy" fill="#000000"/>
										</g>
									</svg>
								</span>
								<span class="kt-menu__link-text">Barang</span>
							</a>
						</li>

						<!-- Faktur -->
						<li class="kt-menu__item <?php if($uri_1 == "faktur"){echo 'kt-menu__item--open kt-menu__item--here';}?>" aria-haspopup="true">
							<a href="<?= base_url("faktur"); ?>" class="kt-menu__link ">
							<span class="kt-menu__link-icon">
								<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
									<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
										<rect id="bound" x="0" y="0" width="24" height="24"/>
										<path d="M4.5,3 L19.5,3 C20.3284271,3 21,3.67157288 21,4.5 L21,19.5 C21,20.3284271 20.3284271,21 19.5,21 L4.5,21 C3.67157288,21 3,20.3284271 3,19.5 L3,4.5 C3,3.67157288 3.67157288,3 4.5,3 Z M8,5 C7.44771525,5 7,5.44771525 7,6 C7,6.55228475 7.44771525,7 8,7 L16,7 C16.5522847,7 17,6.55228475 17,6 C17,5.44771525 16.5522847,5 16,5 L8,5 Z" id="Combined-Shape" fill="#000000"/>
									</g>
								</svg>
							</span>
							<span class="kt-menu__link-text"> Faktur</span></a>
						</li>
					</ul>
				</div>
			</div>

			<!-- end:: Aside Menu -->
		</div>
