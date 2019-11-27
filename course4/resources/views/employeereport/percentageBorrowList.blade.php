
<div class="col-md-12">

    <h3 style="text-align: center">
        {{isset($panel_title) ?$panel_title :''}}
    </h3>

    <table id="example" class="table table-striped table-bordered display" style="width:100%">
        <thead>
        <tr>
            <th >شماره</th>
            <th>نام</th>
            <th>از بابت کلاس</th>
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
            <th>از بابت کلاس</th>
            <th >معاش</th>
            <th >مقدار پرداخت شده</th>
            <th >مقدار قرضه</th>
            <th >تاریخ پرداخت</th>
            <th >ماه ازسال</th>
            <th >عملیات</th>

        </tr>
        </tfoot>
        <tbody>

        @foreach($pBorrow as $key=>$pb)
            <tr>
                <td>{{++$key}}</td>
                <td>{{$pb->first_name}} {{$pb->last_name}}</td>
                <td>{{$pb->class_name}} </td>
                <td>{{$pb->payment_amount + $pb->payment_borrow}}</td>
                <td>{{$pb->payment_amount}}</td>
                <td>{{$pb->payment_borrow}}</td>
                <td>{{$pb->payment_date}}</td>
                <td>{{$pb->payment_month}}</td>
                <td>
                    <button onclick="setvale({{ $pb->payment_borrow}} , {{$pb->payment_amount }} , {{ $pb->payment_amount+ $pb->payment_borrow}}, {{$pb->psp_id}} )" data-toggle="modal" data-target="#pay"

                            class="btn btn-info btn-xs" id="Pay">پرداخت</button>
                </td>
            </tr>

        @endforeach
        </tbody>
    </table>
    <script>

        $(document).ready(function () {

            $('#example').dataTable();
        })

        function setvale(val1,val2,val3,val4) {

            $("#payment_amount").val(val1);
            $("#payment").val(val2);
            $("#employee_salary").val(val3);
            $("#employee_id").val(val4);
            $("#borrow").val(val1);
        }
    </script>

</div>


<!-- Modal -->
<div id="pay" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content" style="margin-top: 20%;">
            <div class="modal-header">
                <button type="button" class="close right" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">پرداخت</h4>
            </div>
            <div class="modal-body">
                <form method="post" id="frm"  action="{{ route("employeereport.PayBorrow") }}" name="payment_form">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label for="pay">مقدار</label>
                        <input type="number" class="form-control" id="payment_amount" name="payment_amount">

                    </div>
                    <input type="hidden" id="employee_salary" name="employee_salary">
                    <input type="hidden" id="employee_id" name="employee_id">
                    <input type="hidden" id="payment" name="payment">
                    <input type="hidden" id="borrow" name="borrow">

                    <input type="submit" name="submit" class="btn btn-info" value="پرداخت">

                </form>
            </div>
        </div>

    </div>
</div>




