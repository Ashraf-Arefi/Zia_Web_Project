<div class="main-menu">
    <header class="header">
        <a href="index-2.html" class="logo"><i class="ico mdi mdi-cube-outline"></i>Asia Academy</a>
        <button type="button" class="button-close fa fa-times js__menu_close"></button>
        <div class="user">
            <a href="#" class="avatar"><img  src="assets/images/asia.jpg" alt="" style="max-width: 140px; max-height: 156px; margin: -35px;margin-right: -6px; border: none "><span class="status online"></span></a>
            <h5 class="name"><a href="">{{ Auth::user()->name }}</a></h5>
            <h5 class="position">Admin</h5>
            <!-- /.name -->
            <div class="control-wrap js__drop_down">
                <i class="fa fa-caret-down js__drop_down_button"></i>
                <div class="control-list">
                    <div class="control-item">
                        <a href=""><i class="fa fa-user"></i> حساب کاربری</a>
                    </div>
                    <div class="control-item"><a href=""><i class="fa fa-gear"></i> تنظیمات</a></div>
                    <div class="control-item"><a href="{{ route('user.doLogout') }}"><i class="fa fa-sign-out"></i> خروج </a></div>
                </div>
                <!-- /.control-list -->
            </div>
            <!-- /.control-wrap -->
        </div>
        <!-- /.user -->
    </header>
    <!-- /.header -->
    <div class="content">

        <div class="navigation">

            <!-- /.title -->
            <ul class="menu js__accordion nav" id="sidebar">
                <li class="current nav_home">
                    <a class="waves-effect " href="javascript:ajaxLoad('{{route('home.list')}}')"><i class="menu-icon mdi mdi-view-dashboard"></i><span>صفحه اصلی</span></a>
                </li>
                {{--User Menu--}}
                <li class="active">
                    <a class="waves-effect parent-item js__control" href="#"><i class="menu-icon mdi mdi-account-box"></i><span >کاربران</span><span class="menu-arrow fa fa-angle-down"></span></a>
                    <ul class="sub-menu js__content nav" id="nav-sidebar">
                        {{--User Menu--}}
                        <li class="nav_user"><a href="javascript:ajaxLoad('{{route('user.list')}}')">لیست کاربران</a></li>
                        <li ><a href="javascript:ajaxLoad('{{route('user.create')}}')">ثبت کاربر جدید:</a></li>

                    </ul>
                    <!-- /.sub-menu js__content -->
                </li>

                {{--department Menu--}}
                <li class="active">
                    <a class="waves-effect parent-item js__control" href="#"><i class="menu-icon mdi mdi-account-box"></i><span>دپارتمنت ها</span><span class="menu-arrow fa fa-angle-down"></span></a>
                    <ul class="sub-menu js__content nav" id="nav-sidebar">
                        {{--department Menu--}}
                        <li class="nav_customer"><a href="javascript:ajaxLoad('{{route('department.list')}}')">لیست دپارتمنت</a></li>
                        <li ><a href="javascript:ajaxLoad('{{route('department.create')}}')">ثبت دپارتمنت جدید:</a></li>

                    </ul>
                    <!-- /.sub-menu js__content -->
                </li>

                {{--Books Menu--}}
                <li class="active">
                    <a class="waves-effect parent-item js__control" href="#"><i class="menu-icon mdi mdi-account-box"></i><span> کتاب ها</span><span class="menu-arrow fa fa-angle-down"></span></a>
                    <ul class="sub-menu js__content nav" id="nav-sidebar">
                        <li class="nav_customer"><a href="javascript:ajaxLoad('{{route('book.list')}}')">لیست کتاب</a></li>
                        <li ><a href="javascript:ajaxLoad('{{route('book.create')}}')">ثبت کتاب جدید:</a></li>
                        <li ><a href="javascript:ajaxLoad('{{route('library.create')}}')">ثبت کتاب به کتاب خانه:</a></li>
                        <li ><a href="javascript:ajaxLoad('{{route('library.list')}}')">لیست کتاب خانه:</a></li>

                        <li ><a href="javascript:ajaxLoad('{{route('barrowbook')}}')">مدیریت اقساط کتاب ها </a></li>

                        <li ><a href="javascript:ajaxLoad('{{route('bookManage')}}')">مدیریت کتاب ها و شاگردان </a></li>
                        <li ><a href="javascript:ajaxLoad('{{route('management.bookAddManagementList')}}')"> لیست مدیریت کتاب ها و شاگردان</a></li>
                    </ul>
                    <!-- /.sub-menu js__content -->
                </li>


                {{--Student Menu--}}
                <li class="active">
                    <a class="waves-effect parent-item js__control" href="#"><i class="menu-icon mdi mdi-account-box"></i><span> بخش شاگردان </span><span class="menu-arrow fa fa-angle-down"></span></a>
                    <ul class="sub-menu js__content nav" id="nav-sidebar">
                        <li class="nav_expense"><a href="javascript:ajaxLoad('{{route('student.list')}}')">لیست  شاگردان:</a></li>
                        <li ><a href="javascript:ajaxLoad('{{route('student.create')}}')">ثبت شاگرد جدید:</a></li>
                    </ul>
                    <!-- /.sub-menu js__content -->
                </li>



                {{--subject Menu--}}
                <li class="active">
                    <a class="waves-effect parent-item js__control" href="#"><i class="menu-icon mdi mdi-account-box">
                        </i><span>بخش مضامین </span><span class="menu-arrow fa fa-angle-down"></span></a>
                    <ul class="sub-menu js__content nav" id="nav-sidebar">
                        <li class="nav_customer"><a href="javascript:ajaxLoad('{{route('subject.list')}}')">لیست مضامین</a></li>
                        <li ><a href="javascript:ajaxLoad('{{route('subject.create')}}')">ثبت مضمون جدید:</a></li>

                    </ul>
                    <!-- /.sub-menu js__content -->
                </li>

                {{--Course Menu--}}
                <li class="active">
                    <a class="waves-effect parent-item js__control" href="#"><i class="menu-icon mdi mdi-account-box"></i><span> بخش کلاس ها</span><span class="menu-arrow fa fa-angle-down"></span></a>
                    <ul class="sub-menu js__content nav" id="nav-sidebar">
                        <li class="nav_expense"><a href="javascript:ajaxLoad('{{route('course.list')}}')">لیست  کلاس ها:</a></li>
                        <li ><a href="javascript:ajaxLoad('{{route('course.create')}}')">ثبت کلاس جدید:</a></li>
                        <li class="nav_user"><a href="javascript:ajaxLoad('{{route('barrowclass')}}')">مدیریت اقساط کلاس </a></li>
                        <li class="nav_user"><a href="javascript:ajaxLoad('{{route('classmanage')}}')">مدیریت کلاس و شاگردان</a></li>
                        <li class="nav_user"><a href="javascript:ajaxLoad('{{route('management.classList')}}')">لیست مدیریت کلاس و شاگردان</a></li>

                    </ul>
                    <!-- /.sub-menu js__content -->
                </li>




                {{--expense Menu--}}
                <li class="active">
                    <a class="waves-effect parent-item js__control" href="#"><i class="menu-icon mdi mdi-account-box"></i><span> بخش مصارف</span><span class="menu-arrow fa fa-angle-down"></span></a>
                    <ul class="sub-menu js__content nav" id="nav-sidebar">
                        {{--expense Menu--}}
                        <li class="nav_expense"><a href="javascript:ajaxLoad('{{route('expense.list')}}')">لیست  مصارف:</a></li>
                        <li ><a href="javascript:ajaxLoad('{{route('expense.create')}}')">ثبت  مصرف جدید:</a></li>
                        <li class="nav_reason_pay"><a href="javascript:ajaxLoad('{{route('reason_pay.list')}}')">لیست علت مصارف :</a></li>
                        <li ><a href="javascript:ajaxLoad('{{route('reason_pay.create')}}')">ثبت علت مصارف :</a></li>
                        <li ><a href="javascript:ajaxLoad('{{route('expense.report')}}')">گذارشات مصارف:</a></li>

                    </ul>
                    <!-- /.sub-menu js__content -->
                </li>


                <li class="active">
                    <a class="waves-effect parent-item js__control" href="#"><i class="menu-icon mdi mdi-account-box"></i><span>کارت هویت</span><span class="menu-arrow fa fa-angle-down"></span></a>
                    <ul class="sub-menu js__content nav" id="nav-sidebar">
                        {{--card Menu--}}
                        <li class="nav_customer"><a href="javascript:ajaxLoad('{{route('card.list')}}')">لیست کارت ها</a></li>
                        <li ><a href="javascript:ajaxLoad('{{route('card.create')}}')">ثبت کارت جدید:</a></li>
                        <li ><a href="javascript:ajaxLoad('{{route('card.studentCardCreate')}}')">تحویل کارت به شاگرد:</a></li>
                        <li ><a href="javascript:ajaxLoad('{{route('card.studentCardList')}}')">لیست کارت های تحویل شده:</a></li>

                    </ul>
                    <!-- /.sub-menu js__content -->
                </li>

                <li class="active">
                    <a class="waves-effect parent-item js__control" href="#"><i class="menu-icon mdi mdi-account-box"></i><span>اطاق ها </span><span class="menu-arrow fa fa-angle-down"></span></a>
                    <ul class="sub-menu js__content nav" id="nav-sidebar">
                        <li class="nav_customer"><a href="javascript:ajaxLoad('{{route('room.list')}}')">لیست اطاق ها</a></li>
                        <li ><a href="javascript:ajaxLoad('{{route('room.create')}}')">ثبت اطاق جدید:</a></li>

                    </ul>
                    <!-- /.sub-menu js__content -->
                </li>

            </ul>
            <!-- /.menu js__accordion -->
        </div>
        <!-- /.navigation -->
    </div>
    <!-- /.content -->
</div>
<!-- /.main-menu -->