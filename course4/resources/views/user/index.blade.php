<div class="col-md-12">
    <h3 style="text-align: center">{{$panel_title  }}</h3>

    <table id="example" class="table table-striped table-bordered display" style="width:100%">
        <thead>
        <tr>
            <th>ادی</th>
            <th>نام</th>
            <th>فامیلی</th>
            <th>نام کاربری</th>
            <th>نقش کاربری</th>
            <th>عملیات</th>

        </tr>
        </thead>
        <tfoot>
        <tr>
            <th>ادی</th>
            <th>نام</th>
            <th>فامیلی</th>
            <th>نام کاربری</th>
            <th>نقش کاربری</th>
            <th>عملیات</th>

        </tr>
        </tfoot>
        <tbody>
        @foreach($users as $user)
            <tr>
                <td>{{$user->user_id}}</td>
                <td>{{$user->name}}</td>
                <td>{{$user->last_name}}</td>
                <td>{{$user->username}}</td>
                @if($user->user_level==1)
                    <td>مدیر</td>
                @else
                    <td>کاربر عادی</td>

                @endif
                    <td><a href="javascript:ajaxLoad('{{route('user.editUserPublicInfoUpdate',$user->user_id)}}')" class="btn btn-success btn-xs">ویرایش اطلاعات عمومی کاربر</a>
                    <a href="javascript:ajaxLoad('{{route('user.editUserSecurityInfoUpdate',$user->user_id)}}')" class="btn btn-success btn-xs">ویرایش اطلاعات امنییتی کاربر</a>
                        <a href="javascript:if(confirm('Are you sure you want to delete this?')) ajaxDelete('{{route('user.delete',$user->user_id)}}','{{csrf_token()}}')"
                           class="btn btn-danger btn-xs">حذف</a>
                    </td>
            </tr>

        @endforeach

        </tbody>
    </table>
    <script>

        $(document).ready(function () {

            $('#example').dataTable();
        })
    </script>

</div>




