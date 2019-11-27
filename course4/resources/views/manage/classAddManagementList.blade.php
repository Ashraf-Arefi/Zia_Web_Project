
<div class="col-md-12">
    <h3 style="text-align: center">{{isset($panel_title) ?$panel_title :''}}</h3>
    <table id="example" class="table table-striped table-bordered display" style="width:100%">
        <thead>
        <tr>
            <th>ادیِ</th>
            <th>نمبر قبض</th>
            <th>نام شاگرد</th>
            <th>کلاس</th>
            <th>فیس کلاس</th>
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
            <th>نمبر قبض</th>
            <th>نام شاگرد</th>
            <th>کلاس</th>
            <th>فیس کلاس</th>
            <th> مقدار پرداخت</th>
            <th> مقدار تخفیف</th>
            <th>باقی مانده</th>
            <th>تاریخ</th>
            <th>عملیات</th>
        </tr>
        </tfoot>
        <tbody>
        @foreach($st_class as $st)
            <tr>
                <td>{{$st->st_cl_id}}</td>
                <td>{{$st->bill_number}}</td>
                <td>{{$st->first_name}}</td>
                <td>{{$st->class_name}}</td>
                <td>{{$st->c_payment+$st->c_borrow}}</td>
                <td>{{$st->c_payment}}</td>
                <td>{{$st->c_discount}}</td>
                <td>{{$st->c_borrow}}</td>
                <td>{{$st->c_date}}</td>



                <td>
                    <a href="javascript:ajaxLoad('{{route('management.classUpdate',$st->st_cl_id)}}')" class="glyphicon glyphicon-edit btn btn-primary btn-xs" id="edit_book"></a>
                    <a href="javascript:if(confirm('Do you want delete this record?'))ajaxDelete('{{route('management.classDelete',$st->st_cl_id)}}','{{csrf_token()}}')" class="glyphicon glyphicon-trash btn btn-danger btn-xs" id="delete_card"></a>
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






