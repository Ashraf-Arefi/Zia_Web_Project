
<div class="col-md-12">
   @include('manage.notification')
    <h3 style="text-align: center">{{isset($panel_title) ?$panel_title :''}}</h3>
    <table id="example" class="table table-striped table-bordered display" style="width:100%">
        <thead>
        <tr>
            <th>ادیِ</th>
            <th>نام شاگرد</th>
            <th>نام کتاب</th>
            <th>تعداد</th>
            <th> قیمت کتاب</th>
            <th> مقدار پرداخت</th>
            <th> مقدار تخفیف</th>
            <th>باقی مانده</th>
            <th>تاریخ</th>
            <th>عملیات</th>
        </tr>
        </thead>
        <tfoot>
        <tr>
            <th>ادیِ</th>
            <th>نام شاگرد</th>
            <th>نام کتاب</th>
            <th>تعداد</th>
            <th> قیمت کتاب</th>
            <th> مقدار پرداخت</th>
            <th> مقدار تخفیف</th>
            <th>باقی مانده</th>
            <th>تاریخ</th>
            <th>عملیات</th>
        </tr>
        </tfoot>
        <tbody>
        @foreach($book_list as $b)
            <tr>
                <td>{{$b->st_bk_id}}</td>
                <td>{{$b->first_name}} {{$b->last_name}}</td>
                <td>{{$b->book_name}}</td>
                <td>{{$b->quantity}}</td>
                <td>{{$b->payment+$b->borrow+$b->discount}}</td>
                <td>{{$b->payment}}</td>
                <td>{{$b->discount}}</td>
                <td>{{$b->borrow}}</td>
                <td>{{$b->date}}</td>

                <td>
                    <a href="javascript:ajaxLoad('{{route('management.barrowBookUpdate',$b->st_bk_id)}}')" class="glyphicon glyphicon-edit btn btn-primary btn-xs" id="edit_book"></a>
                    <a href="javascript:if(confirm('Do you want delete this record?'))ajaxDelete('{{route('management.barrowBookDelete',$b->st_bk_id)}}','{{csrf_token()}}')" class="glyphicon glyphicon-trash btn btn-danger btn-xs" id="delete_card"></a>
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






