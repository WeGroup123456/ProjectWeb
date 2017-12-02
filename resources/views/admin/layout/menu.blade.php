<!-- BEGIN SIDEBAR -->
                <div class="page-sidebar-wrapper">
                    <!-- BEGIN SIDEBAR -->
                    <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
                    <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
                    <div class="page-sidebar navbar-collapse collapse">
                        <!-- BEGIN SIDEBAR MENU -->
                        <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
                        <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
                        <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
                        <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
                        <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
                        <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
                        <ul class="page-sidebar-menu  page-header-fixed " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">
                            <!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
                            <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
                            <li class="sidebar-toggler-wrapper hide">
                                <div class="sidebar-toggler">
                                    <span></span>
                                </div>
                            </li>
                            <!-- END SIDEBAR TOGGLER BUTTON -->
                            <!-- DOC: To remove the search box from the sidebar you just need to completely remove the below "sidebar-search-wrapper" LI element -->
                            <li class="sidebar-search-wrapper">
                                <!-- BEGIN RESPONSIVE QUICK SEARCH FORM -->
                                <!-- DOC: Apply "sidebar-search-bordered" class the below search form to have bordered search box -->
                                <!-- DOC: Apply "sidebar-search-bordered sidebar-search-solid" class the below search form to have bordered & solid search box -->
                                <form class="sidebar-search  " action="page_general_search_3.html" method="POST">
                                    <a href="javascript:;" class="remove">
                                        <i class="icon-close"></i>
                                    </a>
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Search...">
                                        <span class="input-group-btn">
                                            <a href="javascript:;" class="btn submit">
                                                <i class="icon-magnifier"></i>
                                            </a>
                                        </span>
                                    </div>
                                </form>
                                <!-- END RESPONSIVE QUICK SEARCH FORM -->
                            </li>
                            <li class="nav-item start active open">
                                <a href="admin/trangchu" class="nav-link">
                                    <i class="icon-home"></i>
                                    <span class="title">Dashboard</span>
                                </a>
                            </li>
                            <li class="heading">
                                <h3 class="uppercase">Menu</h3>
                            </li>
                            <li class="nav-item  ">
                                <a href="admin/brand/danhsach"  class="nav-link nav-toggle"><i class="glyphicon glyphicon-tower"></i> <span class="title">Brand</span><span class="fa arrow"></span></a>
                                <ul class="sub-menu">
                                    <li class="nav-item  ">
                                        <a href="admin/brand/danhsach" class="nav-link ">Danh sách</a>
                                    </li>
                                    <li class="nav-item  ">
                                        <a href="admin/brand/them" class="nav-link ">Thêm</a>
                                    </li>
                                </ul>
                                <!-- /.nav-second-level -->
                            </li>
                            <li class="nav-item  ">
                                <a href="admin/loaigiay/danhsach"  class="nav-link nav-toggle"><i class="glyphicon glyphicon-stats"></i> <span class="title">Loại giày</span><span class="fa arrow"></span></a>
                                <ul class="sub-menu">
                                    <li class="nav-item  ">
                                        <a href="admin/loaigiay/danhsach" class="nav-link ">Danh sách</a>
                                    </li>
                                    <li class="nav-item  ">
                                        <a href="admin/loaigiay/them" class="nav-link ">Phân loại</a>
                                    </li>
                                    <li class="nav-item  ">
                                        <a href="admin/loaigiay/themmoi" class="nav-link ">Thêm mới</a>
                                    </li>
                                </ul>
                                <!-- /.nav-second-level -->
                            </li>
                            <li class="nav-item  ">
                                <a href="admin/giay/danhsach"  class="nav-link nav-toggle"><i class="glyphicon glyphicon-star"></i> <span class="title">Giày</span><span class="fa arrow"></span></a>
                                <ul class="sub-menu">
                                    <li class="nav-item  ">
                                        <a href="admin/giay/danhsach" class="nav-link ">Danh sách</a>
                                    </li>
                                    <li class="nav-item  ">
                                        <a href="admin/giay/them" class="nav-link ">Thêm giày</a>
                                    </li>
                                </ul>
                                <!-- /.nav-second-level -->
                            </li>
                            <li class="nav-item  ">
                                <a href="admin/slide/danhsach"  class="nav-link nav-toggle"><i class="glyphicon glyphicon-picture"></i> <span class="title">Slide</span><span class="fa arrow"></span></a>
                                <ul class="sub-menu">
                                    <li class="nav-item  ">
                                        <a href="admin/slide/danhsach" class="nav-link ">Danh sách</a>
                                    </li>
                                    <li class="nav-item  ">
                                        <a href="admin/slide/them" class="nav-link ">Thêm</a>
                                    </li>
                                </ul>
                                <!-- /.nav-second-level -->
                            </li>
                            <li class="nav-item  ">
                                <a href="admin/baohanh/danhsach"  class="nav-link nav-toggle"><i class="glyphicon glyphicon-send"></i> <span class="title">Bảo hành</span><span class="fa arrow"></span></a>
                                <ul class="sub-menu">
                                    <li class="nav-item  ">
                                        <a href="admin/baohanh/danhsach" class="nav-link ">Danh sách</a>
                                    </li>
                                    <li class="nav-item  ">
                                        <a href="admin/baohanh/them" class="nav-link ">Thêm</a>
                                    </li>
                                </ul>
                                <!-- /.nav-second-level -->
                            </li>
                            <li class="nav-item  ">
                                <a href="admin/user/danhsach"  class="nav-link nav-toggle"><i class="glyphicon glyphicon-user"></i> <span class="title">Users</span><span class="fa arrow"></span></a>
                                <ul class="sub-menu">
                                    <li class="nav-item  ">
                                        <a href="admin/user/danhsach" class="nav-link ">Danh sách</a>
                                    </li>
                                    <li class="nav-item  ">
                                        <a href="admin/user/them" class="nav-link ">Thêm</a>
                                    </li>
                                </ul>
                                <!-- /.nav-second-level -->
                        </ul>
                        <!-- END SIDEBAR MENU -->
                        <!-- END SIDEBAR MENU -->
                    </div>
                    <!-- END SIDEBAR -->
                </div>
                <!-- END SIDEBAR -->