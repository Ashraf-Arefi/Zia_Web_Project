<div class="col-md-12">
    <h3 style="text-align: center">{{isset($panel_title) ?$panel_title :''}}</h3>
    <table id="example" class="table table-striped table-bordered display" style="width:100%">
        <thead>
        <tr>
            <th>ادیِ</th>
            <th>نام</th>
            <th>نام پدر</th>
            <th>مقدار تخفیف</th>
            <th>مقدار باقی</th>
            <th>تاریخ</th>
            <th>عملیات</th>

        </tr>
        </thead>
        <tfoot>
        <tr>
            <th>ادیِ</th>
            <th>نام</th>
            <th>نام پدر</th>
            <th>مقدار تخفیف</th>
            <th>مقدار باقی</th>
            <th>تاریخ</th>
            <th>عملیات</th>

        </tr>
        </tfoot>
        <tbody>

        @if($students)
            @foreach($students as $student)

                <tr>
                    <td>{{$student->student_id}}</td>
                    <td>{{$student->first_name}}</td>
                    <td>{{$student->father_name}}</td>
                    <td>{{$student->discount}}</td>
                    <td>{{$student->borrow}}</td>
                    <td>{{$student->date}}</td>

                    <td>
                        <button onclick="setvale({{ $student->borrow}} , {{$student->st_bk_id}} , {{ $student->payment }} )" data-toggle="modal" data-target="#pay"
                           {{--href="javascript:ajaxLoad('{{route('barrowclass.pay',$student->st_id)}}')"--}}
                           class="btn btn-info btn-xs" id="Pay">Pay</button>
                    </td>
                </tr>
            @endforeach
        @endif

        </tbody>
    </table>
    <script>

        $(document).ready(function () {

            $('#example').dataTable();


        })

        function setvale(val1,val2,val3) {

                $("#mount").val(val1);
                $("#id_pay").val(val2);
                $("#payment").val(val3);
                $("#borrow").val(val1);
        }

        /*$(function() {
            // Initialize form validation on the registration form.
            // It has the name attribute "registration"
            $("form[name='payment_form']").validate({
                // Specify validation rules
                rules: {
                    // The key name on the left side is the name attribute
                    // of an input field. Validation rules are defined
                    // on the right side
                    mount: "required",
                    minlength: 1

                },
                // Specify validation error messages
                    messages: {
                    mount: "مقدارپرداختی الزامی میباشد"
                },
                // Make sure the form is submitted to the destination defined
                // in the "action" attribute of the form when valid
                submitHandler: function(form) {
                    form.submit();
                }
            });
        });*/

    </script>

</div>


<!-- Modal -->
<div id="pay" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close right" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">پرداخت</h4>
            </div>
            <div class="modal-body">
                <form method="post" id="frm"
                      action="{{isset($book) ? route('management.barrowBookUpdate',$book->book_id): route('barrowbook')}}" >
                    {{csrf_field()}}
                    <div class="form-group">
                        <label for="pay">مقدار</label>
                        <input type="number" class="form-control" id="mount" name="mount">

                    </div>
                    <input type="hidden" id="id_pay" name="id">
                    <input type="hidden" id="payment" name="payment">
                    <input type="hidden" id="borrow" name="borrow">

                    <input type="submit" name="submit" class="btn btn-info" value="پرداخت">

                </form>
            </div>
        </div>

    </div>
</div>
