<div class="col-lg-8 col-md-8 col-xs-12">
    <h3 style="margin-right: 2%">
        {{isset($panel_title) ?$panel_title :''}}
    </h3>

    <form method="post" id="frm"
          action="{{isset($salary) ?route('employeereport.update',$salary->payment_id):route('employeereport.create')}}">
        {{isset($salary) ?method_field('put') :''}}
        {{csrf_field()}}


        <div class="input-group margin-bottom-20 required" id="form-employee_id-error">
            <div class="input-group-btn"><label for="employee_id" class="btn btn-default">انتخاب کار مند</label></div>
            <!-- /.input-group-btn -->
            <select name="employee_id" id="employee_id" class="form-control select2_1 required">
                <option value="">انتخاب کار مند</option>
                @foreach($employee as $emp)
                    <option value="{{ $emp->employee_id }}" {{isset($salary->employee_id) && $emp->employee_id == $salary->employee_id ? 'selected'.'='.'selected':''}}>{{$emp->first_name .' '.$emp->last_name}}</option>
                @endforeach
            </select>
            <span id="employee_id-error" class="help-block"></span>
        </div>

        <!-- /.input-group -->
        <div class="input-group margin-bottom-20 required" id="form-salary-error">
            <div class="input-group-btn"><label for="salary" class="btn btn-default">معاش</label></div>
            <!-- /.input-group-btn -->
            <input id="salary" type="number" class="form-control required " placeholder=" معاش" name="salary"
                   value="{{old('salary',isset($salary)? ($salary->payment_amount + $salary->payment_borrow):'')}}">
            <span id="salary-error" class="help-block"></span>
        </div>

        <div class="input-group margin-bottom-20 required" id="form-payment_amount-error">
            <div class="input-group-btn"><label for="payment_amount" class="btn btn-default">مقدار پرداخت:*</label>
            </div>
            <!-- /.input-group-btn -->
            <input id="payment_amount" type="number" class="form-control required" placeholder=" مقدار پرداخت "
                   name="payment_amount"
                   value="{{old('payment_amount',isset($salary->payment_amount)? $salary->payment_amount:'')}}">
            <span id="payment_amount-error" class="help-block"></span>
        </div>
        <!-- /.input-group -->
        <div class="input-group margin-bottom-20 required" id="form-payment_month-error">
            <div class="input-group-btn"><label for="payment_month" class="btn btn-default">انتخاب ماه</label></div>
            <!-- /.input-group-btn -->
            <select name="payment_month" id="payment_month" class="form-control select2_1">
                <option value="">انتخاب ماه</option>
                <option value="حمل" {{isset($salary->payment_month) && $salary->payment_month =='حمل' ? 'selected'.'='. 'selected':''}}>حمل</option>
                <option value="ثــور" {{isset($salary->payment_month) && $salary->payment_month =='ثــور' ? 'selected'.'='. 'selected':''}}>ثــور</option>
                <option value="جــوزا" {{isset($salary->payment_month) && $salary->payment_month =='جــوزا' ? 'selected'.'='. 'selected':''}}>جــوزا</option>
                <option value="ســرطان" {{isset($salary->payment_month) && $salary->payment_month =='ســرطان' ? 'selected'.'='. 'selected':''}}>ســرطان</option>
                <option value="اســد" {{isset($salary->payment_month) && $salary->payment_month =='اســد' ? 'selected'.'='. 'selected':''}}>اســد</option>
                <option value="ســنبله" {{isset($salary->payment_month) && $salary->payment_month =='ســنبله' ? 'selected'.'='. 'selected':''}}>ســنبله</option>
                <option value="مــیزان" {{isset($salary->payment_month) && $salary->payment_month =='مــیزان' ? 'selected'.'='. 'selected':''}}>مــیزان</option>
                <option value="عقــرب" {{isset($salary->payment_month) && $salary->payment_month =='عقــرب' ? 'selected'.'='. 'selected':''}}>عقــرب</option>
                <option value="قــوس" {{isset($salary->payment_month) && $salary->payment_month =='قــوس' ? 'selected'.'='. 'selected':''}}>قــوس</option>
                <option value="جــدی" {{isset($salary->payment_month) && $salary->payment_month =='جــدی' ? 'selected'.'='. 'selected':''}}>جــدی</option>
                <option value="دلـــو" {{isset($salary->payment_month) && $salary->payment_month =='دلـــو' ? 'selected'.'='. 'selected':''}}>دلـــو</option>
                <option value="حـــوت" {{isset($salary->payment_month) && $salary->payment_month =='حـــوت' ? 'selected'.'='. 'selected':''}}>حـــوت</option>


            </select>
            <span id="payment_month-error" class="help-block"></span>
        </div>
        <!-- /.input-group -->
        <div class="input-group margin-bottom-20 required" id="form-payment_date-error">
            <div class="input-group-btn"><label for="payment_date" class="btn btn-default">تاریخ:*</label></div>
            <input type="" class="form-control required " placeholder="روز/ماه/سال" id="jalali-datepicker"
                   name="payment_date"
                   value="{{old('payment_date',isset($salary->payment_date)? $salary->payment_date:'')}}">
            <span class="input-group-addon bg-primary text-white"><i class="fa fa-calendar"></i></span>

            <input id="id" type="hidden" class="form-control" name="id"
                   value="{{ old('payment_id',isset($salary->payment_id)? $salary->payment_id:'') }}"
                   autofocus>
            <span id="payment_date-error" class="help-block"></span>
        </div>
        <!-- /.input-group -->
        <div>
            <button class="btn btn-primary" type="submit" id="btn_save">ذخیره<i class="fa fa-save"
                ></i></button>
            <a href="javascript:ajaxLoad('employeereport')" class="btn btn-danger">لغو<i class="fa fa-backward"
                ></i></a>
        </div>
    </form>

</div>

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


    //get employee salary by ajax

    $(document).ready(function () {


        $("#employee_id").change(function () {

            var search = $(this).val();


            $.ajax({
                type: "get",
                url: "employeereport/getSalary/" + search,
                contentType: false,
                success: function (data) {

                    $("#salary").val(data);
                },
            });

        });

    })


    function setdata(data) {

        $("#employee_id").val(data);

    }


</script>

