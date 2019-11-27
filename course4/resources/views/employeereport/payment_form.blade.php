<div class=" col-md-6 col-lg-6 col-xs-12" >

    <h3 style="margin-right: 2%">
        {{isset($panel_title) ?$panel_title :''}}
    </h3>

    <form method="post" id="frm" action="{{isset($salary) ?route('employeereport.payment',$salary->payment_id):route('employeereport.create')}}">
        {{isset($salary) ?method_field('put') :''}}
        {{csrf_field()}}

        @if(isset($salary))

            <div class="input-group margin-bottom-20 required" id="form-employee_id-error" >
                <div class="input-group-btn"><label for="employee_id" class="btn btn-default">مشخصات کار مند</label></div>
                <!-- /.input-group-btn -->

                <input id="employee_id" type="text" class="form-control" placeholder=" معاش" name="employee_id" disabled="disabled"
                       value="{{$employee->first_name}}{{$employee->last_name}}" >
                <input id="employee_id" type="hidden" class="form-control" placeholder=" معاش" name="employee_id" disabled="disabled"
                       value="{{$employee->employee_id}}">
                <span id="employee_id-error" class="help-block"></span>
            </div>

            <!-- /.input-group -->
            <div class="input-group margin-bottom-20 required" id="form-salary-error">
                <div class="input-group-btn"><label for="salary" class="btn btn-default">معاش</label></div>
                <!-- /.input-group-btn -->
                <input id="salary" type="number" class="form-control  " placeholder=" معاش" name="salary"
                       value="{{old('salary',isset($employee->salary)? $employee->salary:'')}}" disabled="disabled">
                <span id="salary-error" class="help-block"></span>
            </div>

            <!-- /.input-group -->
            <div class="input-group margin-bottom-20 required" id="form-payment_month-error">
                <div class="input-group-btn"><label for="payment_month" class="btn btn-default">طلب ازماه</label></div>
                <!-- /.input-group-btn -->
                <input name="payment_month" id="payment_month" class="form-control required "
                       value="{{old('payment_month',isset($salary->payment_month)?  $salary->payment_month:'')}}">
                <span id="payment_month-error" class="help-block"></span>
            </div>

            <div class="input-group margin-bottom-20 required" id="form-payment_amount-error">
                <div class="input-group-btn"><label for="payment_amount" class="btn btn-default">مقدار پرداخت:*</label></div>
                <!-- /.input-group-btn -->
                <input id="payment_amount" type="number" class="form-control required" placeholder=" مقدار پرداخت " name="payment_amount"
                       value="{{old('payment_amount',isset($salary->payment_amount)?  $salary->payment_borrow:'')}}">
                <span id="payment_amount-error" class="help-block"></span>
            </div>

            <!-- /.input-group -->
            <div class="input-group margin-bottom-20 required" id="form-payment_date-error">
                <div class="input-group-btn"><label for="payment_date" class="btn btn-default">تاریخ:*</label></div>
                <input type="" class="form-control required" placeholder="روز/ماه/سال" id="jalali-datepicker" name="payment_date"
                       value="{{old('payment_date',isset($salary->payment_date)? $salary->payment_date:'')}}">
                <span class="input-group-addon bg-primary text-white"><i class="fa fa-calendar"></i></span>

                <input id="id" type="hidden"  class="form-control" name="id"
                       value="{{ old('id',isset($salary->payment_id)? $salary->payment_id:'') }}"
                       autofocus>
                <span id="payment_date-error" class="help-block"></span>
            </div>
            <!-- /.input-group -->
            <a href="javascript:ajaxLoad('employeereport')" class="btn btn-danger">لغو<i class="fa fa-backward" style="margin-right: 5px;"></i></a>
            <button class="btn btn-primary" type="submit" id="btn_save">ذخیره<i class="fa fa-save" style="margin-right: 5px;"></i></button>
    </form>

</div>

<script type="text/javascript">
    $(document).ready(function () {

        selectTwo();
        jalali();

    });

</script>

    <script type="text/javascript">
        $(document).ready(function () {
            /*================
       JALALI DATEPICKER
       * ===============*/
            var opt = {

                // placeholder text

                placeholder: "",

                // enable 2 digits

                twodigit: true,

                // close calendar after select

                closeAfterSelect: true,

                // nexy / prev buttons

                nextButtonIcon: "fa fa-forward",

                previousButtonIcon: "fa fa-backward",

                // color of buttons

                buttonsColor: "پیشفرض ",

                // force Farsi digits

                forceFarsiDigits: true,

                // highlight today

                markToday: true,

                // highlight holidays

                markHolidays: false,

                // highlight user selected day

                highlightSelectedDay: true,

                // true or false

                sync: false,

                // display goto today button

                gotoToday: true

            }

            kamaDatepicker('jalali-datepicker', opt);

            /*================
              EDTITABEL TABLE
            * ===============*/
            $('.select2_1').select2();

        });

    </script>

    @endif
