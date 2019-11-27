
<div class="col-md-12">

    <h3 style="text-align: center">
        {{isset($panel_title) ?$panel_title :''}}
    </h3>

    <table id="example" class="table table-striped table-bordered display" style="width:100%">
        <thead>
        <tr>
            <th>ادیِ</th>
            <th>عنوان</th>

            <th>توضیحات</th>
            <th> مقدار </th>
            <th> واحدپولی</th>
            <th>  تاریخ پرداخت</th>
            <th>   گیرنده</th>
            <th>عملیات</th>

        </tr>
        </thead>
        <tfoot>
        <tr>
            <th>ادیِ</th>
            <th>عنوان</th>

            <th>توضیحات</th>
            <th> مقدار </th>
            <th> واحدپولی</th>
            <th>  تاریخ پرداخت</th>
            <th>   گیرنده</th>
            <th>عملیات</th>

        </tr>
        </tfoot>
        <tbody>
        @foreach($expenses as $expense)
            <tr>
                <td>{{$expense->expense_id}}</td>
                <td>{{$expense->title}}</td>
                <td>{{$expense->description}}</td>
                <td>{{$expense->amount}}</td>
                <td>{{$expense->currency}}</td>
                <td>{{$expense->pay_date}}</td>
                <td>{{$expense->first_name ." " . $expense->last_name }}</td>
                <td>
                    <a href="javascript:ajaxLoad('{{route('expense.update',$expense->expense_id)}}')" class="glyphicon glyphicon-edit btn btn-primary btn-xs" id="edit_expense" style="margin-left: 3%"></a>
                    <a href="javascript:if(confirm('واقعا میخواهید حذف کنید؟؟'))ajaxDelete('{{route('expense.delete',$expense->expense_id)}}','{{csrf_token()}}')" class="glyphicon glyphicon-trash btn btn-danger btn-xs" id="delete_expense"></a>
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

