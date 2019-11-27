<div class="container">
    {{--  tab headers  --}}

    <div class="tabbable boxed parentTabs">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#set1">پرداخت معاشات ثابت</a></li>
            <li><a href="#set2">پرداخت معاشات فیصدی</a></li>
            <li><a href="#set3">پرداخت معاشات ساعتی</a></li>

        </ul>
        {{--  start tab content  --}}
        <div class="tab-content">

            <div class="tab-pane fade in active" id="set1">
                <form method="post" id="frm"
                      action="{{isset($salary) ?route('employeereport.update',$salary->payment_id):route('employeereport.create')}}">
                    {{isset($salary) ?method_field('put') :''}}
                    {{csrf_field()}}
                    <div class="row">
                        <div class="col-sm-12 col-md-4">
                            <div class="form-group" id="form-employee_id-error">
                                <label for="employee_id">انتخاب کار مند</label>

                                <select name="employee_id" id="employee_id" class="form-control  required">
                                    <option value="">انتخاب کار مند</option>
                                    @foreach($employee as $employee)
                                        <option value="{{$employee->employee_id}}">{{$employee->first_name}} {{$employee->last_name}}</option>
                                    @endforeach
                                </select>
                                <span id="employee_id-error" class="help-block"></span>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-4">
                            <div class="form-group required" id="form-salary-error">
                                <label for="salary">معاش </label>

                                <input id="salary" type="number" class="form-control required "
                                       placeholder="  معاش شخص  " name="salary">
                                <span id="salary-error" class="help-block"></span>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-4">
                            <div class="form-group required" id="form-payment_amount-error">
                                <label for="payment_amount">مقدار پرداخت:*</label>
                                <input id="payment_amount" type="number" class="form-control required"
                                       placeholder=" مقدار پرداخت "
                                       name="payment_amount"
                                       value="{{old('payment_amount',isset($salary->payment_amount)? $salary->payment_amount:'')}}">
                                <span id="payment_amount-error" class="help-block"></span>
                            </div>
                        </div>
                    </div>

                    <div class="row">


                        <div class="col-sm-12 col-md-4">
                            <div class="form-group required" id="form-payment_month-error">
                                <label for="payment_month">انتخاب ماه</label>

                                <select name="payment_month" id="payment_month" class="form-control select2_1">
                                    <option value="">انتخاب ماه</option>
                                    <option value="حمل">حمل</option>
                                    <option value="ثــور">ثــور</option>
                                    <option value="جــوزا">جــوزا</option>
                                    <option value="ســرطان">ســرطان</option>
                                    <option value="اســد">اســد</option>
                                    <option value="ســنبله">ســنبله</option>
                                    <option value="مــیزان">مــیزان</option>
                                    <option value="عقــرب">عقــرب</option>
                                    <option value="قــوس">قــوس</option>
                                    <option value="جــدی">جــدی</option>
                                    <option value="دلـــو">دلـــو</option>
                                    <option value="حـــوت">حـــوت</option>

                                </select>
                                <span id="payment_month-error" class="help-block"></span>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-4">
                            <div class="form-group required" id="form-payment_date-error">
                                <div class="form-group required" id="form-payment_date-error">
                                    <label for="payment_date" class="control-label"> تاریخ:</label>
                                    <input type="" placeholder="روز/ماه/سال" id="jalali-datepicker"
                                           class="form-control required" name="payment_date"
                                           value="{{ old('payment_date',isset($salary->payment_date)? $salary->payment_date:'') }}">
                                </div>

                                <input id="id" type="hidden" class="form-control" name="id"
                                       value="{{ old('payment_id',isset($salary->payment_id)? $salary->payment_id:'') }}"
                                       autofocus>
                                <span id="payment_date-error" class="help-block"></span>
                            </div>
                        </div>
                    </div>

                    <div class="row">


                    </div>
                    <div class="row">
                        <div>
                            <button class="btn btn-primary" type="submit" id="btn_save">ذخیره<i class="fa fa-save"
                                ></i></button>
                            <a href="javascript:ajaxLoad('employeereport')" class="btn btn-danger">لغو<i
                                        class="fa fa-backward"
                                ></i></a>
                        </div>
                    </div>

                </form>
            </div>


            <div class="tab-pane fade in" id="set2">
               <div class="row">
                   {{-- start of percentage feilds section--}}
                   <div class="col-sm-12 col-md-6">
                       <form method="post" id="frm"
                             action="{{isset($salary) ?route('employeereport.percentageSalaryUpdate',$salary->payment_id):route('employeereport.percentageSalaryCreate')}}">
                           {{isset($salary) ?method_field('put') :''}}
                           {{csrf_field()}}
                           <div class="row">

                               <div class="col-sm-12 col-md-6">
                                   <div class="form-group" id="form-p_class_id-error">
                                       <label for="p_class_id">انتخاب کلاس</label>

                                       <select name="p_class_id" id="p_class_id" class="form-control  required">
                                           <option value="">انتخاب کلاس</option>
                                           @foreach($course as $c)
                                               <option value="{{$c->class_id}}">{{$c->class_name}}  {{$c->start_date}}</option>
                                           @endforeach
                                       </select>
                                       <span id="p_class_id-error" class="help-block"></span>
                                   </div>
                               </div>
                               <div class="col-sm-12 col-md-6">
                                   <div class="form-group" id="form-p_employee_id-error">
                                       <label for="p_employee_id">انتخاب کار مند</label>

                                       <select name="p_employee_id" id="p_employee_id" class="form-control  required">
                                           <option value="">انتخاب کار مند</option>

                                       </select>
                                       <span id="p_employee_id-error" class="help-block"></span>
                                   </div>
                               </div>

                           </div>

                            <input type="hidden" id="salary_this_teacher" name="salary_this_teacher">
                           <div class="row">
                               <div class="col-sm-12 col-md-6">
                                   <div class="form-group required" id="form-p_payment_amount-error">
                                       <label for="p_payment_amount">مقدار پرداخت:*</label>
                                       <input id="p_payment_amount" type="number" class="form-control required"
                                              placeholder=" مقدار پرداخت "
                                              name="p_payment_amount"
                                              value="{{old('payment_amount',isset($salary->payment_amount)? $salary->payment_amount:'')}}">
                                       <span id="p_payment_amount-error" class="help-block"></span>
                                   </div>
                               </div>
                               <div class="col-sm-12 col-md-6">
                                   <div class="form-group required" id="form-p_payment_month-error">
                                       <label for="p_payment_month">انتخاب ماه</label>

                                       <select name="p_payment_month" id="p_payment_month" class="form-control select2_1">
                                           <option value="">انتخاب ماه</option>
                                           <option value="حمل">حمل</option>
                                           <option value="ثــور">ثــور</option>
                                           <option value="جــوزا">جــوزا</option>
                                           <option value="ســرطان">ســرطان</option>
                                           <option value="اســد">اســد</option>
                                           <option value="ســنبله">ســنبله</option>
                                           <option value="مــیزان">مــیزان</option>
                                           <option value="عقــرب">عقــرب</option>
                                           <option value="قــوس">قــوس</option>
                                           <option value="جــدی">جــدی</option>
                                           <option value="دلـــو">دلـــو</option>
                                           <option value="حـــوت">حـــوت</option>

                                       </select>
                                       <span id="p_payment_month-error" class="help-block"></span>
                                   </div>
                               </div>

                           </div>
                           <div class="row">
                               <div class="col-sm-12 col-md-6">
                                   <div class="form-group required" id="form-p_payment_date-error">
                                       <div class="form-group required" id="form-p_payment_date-error">
                                           <label for="p_payment_date" class="control-label"> تاریخ:</label>
                                           <input type="" placeholder="روز/ماه/سال" id="p-jalali-datepicker"
                                                  class="form-control required" name="p_payment_date"
                                                  value="{{ old('payment_date',isset($salary->payment_date)? $salary->payment_date:'') }}">
                                       </div>

                                       <input id="id" type="hidden" class="form-control" name="id"
                                              value="{{ old('payment_id',isset($salary->payment_id)? $salary->payment_id:'') }}"
                                              autofocus>
                                       <span id="payment_date-error" class="help-block"></span>
                                   </div>
                               </div>
                           </div>
                           <div class="row">
                               <div>
                                   <button class="btn btn-primary" type="submit" id="btn_save">ذخیره<i class="fa fa-save"
                                       ></i></button>
                                   <a href="javascript:ajaxLoad('employeereport')" class="btn btn-danger">لغو<i
                                               class="fa fa-backward"
                                       ></i></a>
                               </div>
                           </div>

                       </form>
                   </div>
                   {{-- end of percentage feilds section--}}

                   {{--start of percentage of teachers details--}}
                   <div class="col-sm-12 col-md-6">
                       <label for="subject" class="col-md-10 control-label ">سهم استادان نظر به فیصدی :</label>


                       <table class="table table-striped table-bordered table-responsive">
                           <thead>
                           <tr>
                               <td>شماره</td>
                               <td>نام استاد</td>
                               <td>کلاس</td>
                               <td>مقدار فیصدی</td>
                               <td>مقدار معاش</td>
                           </tr>
                           </thead>

                           <tbody class="tbody">

                           </tbody>
                       </table>
                   </div>
                   {{--end of percentage of teachers details--}}
               </div>
            </div>


            <div class="tab-pane fade in" id="set3">
                <form method="post" id="frm"
                      action="{{isset($salary) ?route('employeereport.hourlySalaryUpdate',$salary->payment_id):route('employeereport.hourlySalaryCreate')}}">
                    {{isset($salary) ?method_field('put') :''}}
                    {{csrf_field()}}
                    <div class="row">
                        <div class="col-sm-12 col-md-4">
                            <div class="form-group required" id="form-h_employee_id-error">
                                <label for="h_employee_id">انتخاب کار مند</label>

                                <select name="h_employee_id" id="h_employee_id" class="form-control  required">
                                    <option value="">انتخاب کار مند</option>
                                    @foreach($hourlyEmployee as $he)
                                        <option value="{{$he->employee_id}}">{{$he->first_name}} {{$he->last_name}}</option>
                                    @endforeach
                                </select>
                                <span id="h_employee_id-error" class="help-block"></span>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-4">
                            <div class="form-group required" id="form-hour-error">
                                <label for="hour">تعداد ساعت</label>
                                <input id="hour" type="number" class="form-control required "
                                       placeholder=" تعداد ساعت کاری روزانه" name="hour"
                                       value="">
                                <span id="hour-error" class="help-block"></span>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-4">
                            <div class="form-group required" id="form-present_day-error">
                                <label for="present_day">تعداد روز درماه</label>

                                <input id="present_day" type="number" class="form-control required "
                                       placeholder=" تعداد روزهای حاضردریک ماه" name="present_day"
                                       value="" onblur="calculate()">
                                <span id="present_day-error" class="help-block"></span>
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-sm-12 col-md-4">
                            <div class="form-group  required" id="form-h_salary-error">
                                <label for="h_salary">معاش ساعتی</label>
                                <input id="h_salary" type="number" class="form-control required "
                                       placeholder="  معاش فی ساعتی " name="h_salary">
                                <span id="h_salary-error" class="help-block"></span>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-4">
                            <div class="form-group required" id="form-h_total_salary-error">
                                <label for="h_total_salary">مجموعه معاش</label>

                                <input id="h_total_salary" type="number" class="form-control required "
                                       placeholder=" مجموعه معاش" name="h_total_salary"
                                       value="">
                                <span id="h_total_salary-error" class="help-block"></span>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-4">
                            <div class="form-group required" id="form-h_payment_amount-error">
                                <label for="h_payment_amount">مقدار پرداخت:</label>
                                <input id="h_payment_amount" type="number" class="form-control required"
                                       placeholder=" مقدار پرداخت "
                                       name="h_payment_amount">
                                <span id="h_payment_amount-error" class="help-block"></span>
                            </div>
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-sm-12 col-md-4">
                            <div class="form-group required" id="form-h_payment_month-error">
                                <label for="h_payment_month">انتخاب ماه</label>

                                <select name="h_payment_month" id="h_payment_month" class="form-control select2_1">
                                    <option value="">انتخاب ماه</option>
                                    <option value="حمل">حمل</option>
                                    <option value="ثــور">ثــور</option>
                                    <option value="جــوزا">جــوزا</option>
                                    <option value="ســرطان">ســرطان</option>
                                    <option value="اســد">اســد</option>
                                    <option value="ســنبله">ســنبله</option>
                                    <option value="مــیزان">مــیزان</option>
                                    <option value="عقــرب">عقــرب</option>
                                    <option value="قــوس">قــوس</option>
                                    <option value="جــدی">جــدی</option>
                                    <option value="دلـــو">دلـــو</option>
                                    <option value="حـــوت">حـــوت</option>

                                </select>
                                <span id="h_payment_month-error" class="help-block"></span>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-4">
                            <div class="form-group required" id="form-h_payment_date-error">
                                <div class="form-group required" id="form-h_payment_date-error">
                                    <label for="h_payment_date" class="control-label"> تاریخ:</label>
                                    <input type="" placeholder="روز/ماه/سال" id="h_jalali-datepicker"
                                           class="form-control required" name="h_payment_date">
                                </div>

                                <input id="id" type="hidden" class="form-control" name="id" autofocus>
                                <span id="h_payment_date-error" class="help-block"></span>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div>
                            <button class="btn btn-primary" type="submit" id="btn_save">ذخیره<i class="fa fa-save"
                                ></i></button>
                            <a href="javascript:ajaxLoad('employeereport')" class="btn btn-danger">لغو<i
                                        class="fa fa-backward"
                                ></i></a>
                        </div>
                    </div>

                </form>
            </div>
            {{--  end tab content  --}}
            <script type="text/javascript">


                $(document).ready(function () {

                    /*-------------------------*/
                    $("ul.nav-tabs a").click(function (e) {
                        e.preventDefault();
                        $(this).tab('show');
                    });


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

                    kamaDatepicker('p-jalali-datepicker', opt);



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

                    kamaDatepicker('h_jalali-datepicker', opt);

                    /*================
                      EDTITABEL TABLE
                    * ===============*/
                    $('.select2_1').select2();

                });


                //get employee salary by ajax for statics salary

                $(document).ready(function () {


                    $("#p_employee_id").change(function () {

                        $id_em = $("#p_employee_id option:selected").attr("salary");



                        $("#salary_this_teacher").val($id_em);

                    })


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

                    //get employee salary by ajax for hourly salary
                    $("#h_employee_id").change(function () {

                        var search = $(this).val();


                        $.ajax({
                            type: "get",
                            url: "employeereport/getHourlySalary/" + search,
                            contentType: false,
                            success: function (data) {

                                $("#h_salary").val(data);
                            },
                        });

                    });
                    // calculate sum of hourly salary section

                    calculate = function () {
                        var h = document.getElementById('hour').value;
                        var pd = document.getElementById('present_day').value;
                        var s = document.getElementById('h_salary').value;

                        document.getElementById('h_total_salary').value = parseInt(h) * parseInt(pd) * parseInt(s);

                    }

                    //get percentage details of teacher in a class
                    $("#p_class_id").change(function () {

                        var search = $(this).val();

                        $.ajax({
                            type: "get",
                            url: "employeereport/teachersPercentage/"+search,
                            contentType: false,
                            success: function (data) {


                                console.log(data)
                                $(".tbody").html(data.output)
                                $("#p_employee_id").html(data.teacher_id)




                            },
                        });

                    });


                });
            </script>

        </div>

    </div>
</div>