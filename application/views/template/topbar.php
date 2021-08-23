<!-- begin:: Header -->
<!-- end:: Aside -->
<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper" id="kt_wrapper">

<!-- begin:: Header -->
<div id="kt_header" class="kt-header  kt-header--fixed ">

    <!-- begin:: Header Menu -->
    <button class="kt-header-menu-wrapper-close" id="kt_header_menu_mobile_close_btn"><i class="la la-close"></i></button>
		<div class="kt-header-menu-wrapper" id="kt_header_menu_wrapper">
			<div id="kt_header_menu" class="kt-header-menu kt-header-menu-mobile  kt-header-menu--layout-default ">
				<ul class="kt-menu__nav ">
					<li class="kt-menu__item  kt-menu__item--submenu kt-menu__item--rel kt-menu__item--active" data-ktmenu-submenu-toggle="click" aria-haspopup="true">
						<a href="javascript:void(0);" class="kt-menu__link kt-menu__toggle">
							<span class="kt-menu__link-text">Superadmin</span>
						</a>
					</li>
				</ul>
			</div>
		</div>

    <!-- end:: Header Menu -->

    <!-- begin:: Header Topbar -->
    <div class="kt-header__topbar">
        <!--begin: Search -->

        <!--begin: Search -->
        <!-- <div class="kt-header__topbar-item kt-header__topbar-item--search dropdown" id="kt_quick_search_toggle">
            <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="10px,0px">
                <span class="kt-header__topbar-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <rect id="bound" x="0" y="0" width="24" height="24" />
                            <path d="M14.2928932,16.7071068 C13.9023689,16.3165825 13.9023689,15.6834175 14.2928932,15.2928932 C14.6834175,14.9023689 15.3165825,14.9023689 15.7071068,15.2928932 L19.7071068,19.2928932 C20.0976311,19.6834175 20.0976311,20.3165825 19.7071068,20.7071068 C19.3165825,21.0976311 18.6834175,21.0976311 18.2928932,20.7071068 L14.2928932,16.7071068 Z" id="Path-2" fill="#000000" fill-rule="nonzero" opacity="0.3" />
                            <path d="M11,16 C13.7614237,16 16,13.7614237 16,11 C16,8.23857625 13.7614237,6 11,6 C8.23857625,6 6,8.23857625 6,11 C6,13.7614237 8.23857625,16 11,16 Z M11,18 C7.13400675,18 4,14.8659932 4,11 C4,7.13400675 7.13400675,4 11,4 C14.8659932,4 18,7.13400675 18,11 C18,14.8659932 14.8659932,18 11,18 Z" id="Path" fill="#000000" fill-rule="nonzero" />
                        </g>
                    </svg> </span>
            </div>
            <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-lg">
                <div class="kt-quick-search kt-quick-search--inline" id="kt_quick_search_inline">
                    <form method="get" class="kt-quick-search__form">
                        <div class="input-group">
                            <div class="input-group-prepend"><span class="input-group-text"><i class="flaticon2-search-1"></i></span></div>
                            <input type="text" class="form-control kt-quick-search__input" placeholder="Search...">
                            <div class="input-group-append"><span class="input-group-text"><i class="la la-close kt-quick-search__close"></i></span></div>
                        </div>
                    </form>
                    <div class="kt-quick-search__wrapper kt-scroll" data-scroll="true" data-height="300" data-mobile-height="200">
                    </div>
                </div>
            </div>
        </div> -->

        <!--end: Search -->

        <!--begin: User Bar -->
        <div class="kt-header__topbar-item kt-header__topbar-item--user">
            <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="0px,0px">
                <div class="kt-header__topbar-user">
                    <span class="kt-header__topbar-welcome kt-hidden-mobile">Hi, Bayu</span>
                </div>
            </div>
        </div>

        <!--end: User Bar -->
    </div>

    <!-- end:: Header Topbar -->
</div>
                    <!-- end:: Header -->
                    <!-- <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor"> -->

                    <div class="kt-header__topbar-item dropdown">
						<!-- begin:: Subheader -->
						<div class="kt-subheader kt-grid__item" id="kt_subheader">
							<div class="kt-subheader__main">
                                <h3 class="kt-subheader__title"><?= $topbar_title; ?></h3>
								<span class="kt-subheader__separator kt-hidden"></span>
								<div class="kt-subheader__breadcrumbs">
									<a href="javascript:void(0);" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
                                    <?php
                                        // Use
                                        // $bread = [
                                        //     [ "aktif", "description", "link"],
                                        // ]

                                        for($i = 0; $i < sizeof($bread); $i++){
                                            $active = $bread[$i][0];
                                            $desc = $bread[$i][1];
                                            if($active){
                                                ?>
                                                    <span class="kt-subheader__breadcrumbs-separator"></span>
                                                    <span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active"><?= $desc; ?></span>
                                                <?php
                                            }
                                            else{
                                                $link = $bread[$i][2];
                                                ?>
                                                    <span class="kt-subheader__breadcrumbs-separator"></span>
                                                    <a href="<?= $link ?>" class="kt-subheader__breadcrumbs-link"><?= $desc; ?></a>
                                                <?php
                                            }
                                        }
                                    ?>
								</div>
							</div>
							<div class="kt-subheader__toolbar">
								<div class="kt-subheader__wrapper">
                                    <div class="btn kt-subheader__btn-daterange">
                                        <?php date_default_timezone_set("Asia/Jakarta"); ?>
										<span class="kt-subheader__btn-daterange-title">Hari Ini</span>&nbsp;
										<span class="kt-subheader__btn-daterange-date"><?= date("d F, Y"); ?> Jam <?= date('h:i A'); ?> </span>
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon kt-svg-icon--sm">
											<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
												<rect id="bound" x="0" y="0" width="24" height="24" />
												<path d="M4.875,20.75 C4.63541667,20.75 4.39583333,20.6541667 4.20416667,20.4625 L2.2875,18.5458333 C1.90416667,18.1625 1.90416667,17.5875 2.2875,17.2041667 C2.67083333,16.8208333 3.29375,16.8208333 3.62916667,17.2041667 L4.875,18.45 L8.0375,15.2875 C8.42083333,14.9041667 8.99583333,14.9041667 9.37916667,15.2875 C9.7625,15.6708333 9.7625,16.2458333 9.37916667,16.6291667 L5.54583333,20.4625 C5.35416667,20.6541667 5.11458333,20.75 4.875,20.75 Z" id="check" fill="#000000" fill-rule="nonzero" opacity="0.3" />
												<path d="M2,11.8650466 L2,6 C2,4.34314575 3.34314575,3 5,3 L19,3 C20.6568542,3 22,4.34314575 22,6 L22,15 C22,15.0032706 21.9999948,15.0065399 21.9999843,15.009808 L22.0249378,15 L22.0249378,19.5857864 C22.0249378,20.1380712 21.5772226,20.5857864 21.0249378,20.5857864 C20.7597213,20.5857864 20.5053674,20.4804296 20.317831,20.2928932 L18.0249378,18 L12.9835977,18 C12.7263047,14.0909841 9.47412135,11 5.5,11 C4.23590829,11 3.04485894,11.3127315 2,11.8650466 Z M6,7 C5.44771525,7 5,7.44771525 5,8 C5,8.55228475 5.44771525,9 6,9 L15,9 C15.5522847,9 16,8.55228475 16,8 C16,7.44771525 15.5522847,7 15,7 L6,7 Z" id="Combined-Shape" fill="#000000" />
											</g>
										</svg>
									</div>
                                </div>
							</div>
						</div>

						<!-- end:: Subheader -->
