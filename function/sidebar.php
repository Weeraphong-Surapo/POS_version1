
        <!--**********************************
            Sidebar start
        ***********************************-->
        <div class="dlabnav">
            <div class="dlabnav-scroll">
				<ul class="metismenu" id="menu">
					<li class="dropdown header-profile">
						<a class="nav-link" href="javascript:void(0);" role="button" data-bs-toggle="dropdown">
							<img src="assets/upload/<?= $img;?>" width="20" alt=""/>
							<div class="header-info ms-3">
								<span class="font-w600 ">สวัสดี,<b><?= $name;?></b></span>
							</div>
						</a>
						<div class="dropdown-menu dropdown-menu-end">
							<a href="profile.php" class="dropdown-item ai-icon">
								<svg id="icon-user1" xmlns="http://www.w3.org/2000/svg" class="text-primary" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
								<span class="ms-2">โปรไฟล์ </span>
							</a>
							<a href="#" onclick="logout()" class="dropdown-item ai-icon">
								<svg id="icon-logout" xmlns="http://www.w3.org/2000/svg" class="text-danger" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
								<span class="ms-2">ออกจากระบบ </span>
							</a>
						</div>
					</li>
                    <li><a href="index.php" aria-expanded="false">
							<i class="flaticon-025-dashboard"></i>
							<span class="nav-text">หน้าหลัก</span>
						</a>
                    </li>
                    <li><a href="saleProduct.php" aria-expanded="false">
							<i class="flaticon-041-graph"></i>
							<span class="nav-text">ขายสินค้าแบบรูป</span>
						</a>
                    </li>
                    <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
						<i class="flaticon-050-info"></i>
							<span class="nav-text">จัดการสินค้า</span>
						</a>
                        <ul aria-expanded="false">
							<li><a href="product.php">จัดการสินค้า</a></li>
                            <li><a href="category.php">จัดการหมวดหมู่</a></li>
                        </ul>
                    </li>
                    <li><a href="listProduct.php" aria-expanded="false">
                            <i class="flaticon-041-graph"></i>
                            <span class="nav-text">รายการขายสินค้า</span>
                        </a>
                    </li>
                    <li><a href="setingShop.php" aria-expanded="false">
							<i class="flaticon-041-graph"></i>
							<span class="nav-text">จัดการข้อมูลร้าน</span>
						</a>
                    </li>
                </ul>
			</div>
        </div>
        <!--**********************************
            Sidebar end
        ***********************************-->

        		<!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <!-- row -->
			<div class="container-fluid">