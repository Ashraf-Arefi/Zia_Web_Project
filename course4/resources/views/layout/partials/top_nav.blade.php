<div class="fixed-navbar">
    <div class="pull-left">
        <button type="button" class="menu-mobile-button glyphicon glyphicon-menu-hamburger js__menu_mobile"></button>
        <h1 class="page-title">{{trans('labels.title')}}</h1>
        <!-- /.page-title -->
    </div>
    <!-- /.pull-left -->
    <div class="pull-right">
        <a href="javascript:ajaxLoad('{{route('changeLanguage.lang',pa)}}')" >پشتو</a>
        <a href="javascript:ajaxLoad('{{route('changeLanguage.lang',fa)}}')" >فارسی</a>
        {{--onClick="window.parent.location = 'http://localhost/course4/public/';--}}
    </div>
    <!-- /.pull-right -->
</div>
<!-- /.fixed-navbar -->
