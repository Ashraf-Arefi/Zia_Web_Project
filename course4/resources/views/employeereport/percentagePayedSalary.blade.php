
<div class="col-md-12">

    <h3 style="text-align: center">
        {{isset($panel_title) ?$panel_title :''}}
    </h3>

    <table id="example" class="table table-striped table-bordered display" style="width:100%">
        <thead>
        <tr>
            <th >شماره</th>
            <th>نام</th>
            <th >معاش</th>
            <th >مقدار پرداخت شده</th>
            <th >مقدار قرضه</th>
            <th >تاریخ پرداخت</th>
            <th >ماه ازسال</th>
            <th >عملیات</th>

        </tr>
        </thead>
        <tfoot>
        <tr>
            <th >شماره</th>
            <th>نام</th>
            <th >معاش</th>
            <th >مقدار پرداخت شده</th>
            <th >مقدار قرضه</th>
            <th >تاریخ پرداخت</th>
            <th >ماه ازسال</th>
            <th >عملیات</th>

        </tr>
        </tfoot>
        <tbody>

        @foreach($pPayed as $key=>$pp)

            <tr>
                <td>{{++$key}}</td>
                <td>{{$pp->first_name}} {{$pp->last_name}}</td>
                <td>{{$pp->payment_amount + $pp->payment_borrow}}</td>
                <td>{{$pp->payment_amount}}</td>
                <td>{{$pp->payment_borrow}}</td>
                <td>{{$pp->payment_date}}</td>
                <td>{{$pp->payment_month}}</td>
                <td colspan="2">
                    <a href="javascript:ajaxLoad('{{route('employeereport.percentageSalaryUpdate',$pp->psp_id)}}')"><i class="glyphicon glyphicon-edit btn btn-primary btn-sm"></i></a>
                    <a href="javascript:if(confirm('Are you want to delete this record?'))ajaxDelete('{{route('employeereport.percentageSalaryDelete',$pp->psp_id)}}','{{csrf_token()}}')"><i class=" glyphicon glyphicon-trash btn btn-danger btn-sm" ></i></a>
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






