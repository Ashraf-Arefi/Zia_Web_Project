
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

        @foreach($salary as $key=>$salary)
            <tr>
                <td>{{++$key}}</td>
                <td>{{$salary->first_name}} {{$salary->last_name}}</td>
                <td>{{$salary->payment_amount + $salary->payment_borrow}}</td>
                <td>{{$salary->payment_amount}}</td>
                <td>{{$salary->payment_borrow}}</td>
                <td>{{$salary->payment_date}}</td>
                <td>{{$salary->payment_month}}</td>
                <td colspan="2">
                    <a href="javascript:ajaxLoad('{{route('employeereport.payment',$salary->payment_id)}}')"><span class=" btn btn-success btn-sm">پرداخت باقیات </span></a>
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






