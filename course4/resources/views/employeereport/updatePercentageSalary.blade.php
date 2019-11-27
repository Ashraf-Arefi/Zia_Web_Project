<div class="row">
    {{-- start of percentage feilds section--}}
    <div class="col-sm-12 col-md-12">
        <h3 style="text-align: center;margin-bottom: 3%;">
            {{isset($panel_title) ?$panel_title :''}}
        </h3>
        <form method="post" id="frm"
              action="{{ route('employeereport.percentageSalaryUpdate',$percentageSalary->percentage_salary_payment_id) }}">
            {{isset($percentageSalary) ?method_field('put') :''}}
                    {{csrf_field()}}
            <div class="row">

                <div class="col-sm-12 col-md-4">
                    <div class="form-group" id="form-p_class_id-error">
                        <label for="p_class_id">انتخاب کلاس</label>

                        <select name="p_class_id" id="p_class_id" class="form-control  required">
                            <option value="">انتخاب کلاس</option>
                                @foreach($class as $c)
                                    <option value="{{ $c->class_id }}" {{isset($percentageSalary->class_id) && $c->class_id == $percentageSalary->class_id ? 'selected'.'='.'selected':''}}>{{$c->class_name}} </option>
                                @endforeach

                        </select>
                        <span id="p_class_id-error" class="help-block"></span>
                    </div>
                </div>
                <div class="col-sm-12 col-md-4">
                    <div class="form-group" id="form-p_employee_id-error">
                        <label for="p_employee_id">انتخاب کار مند</label>

                        <select name="p_employee_id" id="p_employee_id" class="form-control  required">
                            <option value="">انتخاب کار مند</option>
                            @if (isset($percentageSalary))
                                @foreach($employee as $e)
                                    <option value="{{ $e->employee_id }}" {{isset($percentageSalary->employee_id) && $e->employee_id == $percentageSalary->employee_id ? 'selected'.'='.'selected':''}}>{{$e->first_name}} {{$e->last_name}}</option>
                                @endforeach
                            @endif
                        </select>
                        <span id="p_employee_id-error" class="help-block"></span>
                    </div>
                </div>
                <div class="col-sm-12 col-md-4">
                    <div class="form-group required" id="form-p_percentage-error">
                        <label for="p_percentage">سهم کارمند نظر به فیصدی:*</label>
                        <input id="p_percentage" type="number" readonly class="form-control required"
                               placeholder=" مقدار پرداخت "
                               name="p_percentage"
                               value="{{old('payment_amount',isset($percentageSalary->payment_amount)? ($percentageSalary->payment_amount + $percentageSalary->payment_borrow):'')}}">
                        <span id="p_percentage-error" class="help-block"></span>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-sm-12 col-md-4">
                    <div class="form-group required" id="form-p_payment_amount-error">
                        <label for="p_payment_amount">مقدار پرداخت:*</label>
                        <input id="p_payment_amount" type="number" class="form-control required"
                               placeholder=" مقدار پرداخت "
                               name="p_payment_amount"
                               value="{{old('payment_amount',isset($percentageSalary->payment_amount)? $percentageSalary->payment_amount:'')}}">
                        <span id="p_payment_amount-error" class="help-block"></span>
                    </div>
                </div>
                <div class="col-sm-12 col-md-4">
                    <div class="form-group required" id="form-p_payment_month-error">
                        <label for="p_payment_month">انتخاب ماه</label>

                        <select name="p_payment_month" id="p_payment_month" class="form-control select2_1">
                            <option value="">انتخاب ماه</option>
                            <option value="حمل" {{isset($percentageSalary->payment_month) && $percentageSalary->payment_month =='حمل' ? 'selected'.'='. 'selected':''}}>حمل</option>
                            <option value="ثــور" {{isset($percentageSalary->payment_month) && $percentageSalary->payment_month =='ثــور' ? 'selected'.'='. 'selected':''}}>ثــور</option>
                            <option value="جــوزا" {{isset($percentageSalary->payment_month) && $percentageSalary->payment_month =='جــوزا' ? 'selected'.'='. 'selected':''}}>جــوزا</option>
                            <option value="ســرطان" {{isset($percentageSalary->payment_month) && $percentageSalary->payment_month =='ســرطان' ? 'selected'.'='. 'selected':''}}>ســرطان</option>
                            <option value="اســد" {{isset($percentageSalary->payment_month) && $percentageSalary->payment_month =='اســد' ? 'selected'.'='. 'selected':''}}>اســد</option>
                            <option value="ســنبله" {{isset($percentageSalary->payment_month) && $percentageSalary->payment_month =='ســنبله' ? 'selected'.'='. 'selected':''}}>ســنبله</option>
                            <option value="مــیزان" {{isset($percentageSalary->payment_month) && $percentageSalary->payment_month =='مــیزان' ? 'selected'.'='. 'selected':''}}>مــیزان</option>
                            <option value="عقــرب" {{isset($percentageSalary->payment_month) && $percentageSalary->payment_month =='عقــرب' ? 'selected'.'='. 'selected':''}}>عقــرب</option>
                            <option value="قــوس" {{isset($percentageSalary->payment_month) && $percentageSalary->payment_month =='قــوس' ? 'selected'.'='. 'selected':''}}>قــوس</option>
                            <option value="جــدی" {{isset($percentageSalary->payment_month) && $percentageSalary->payment_month =='جــدی' ? 'selected'.'='. 'selected':''}}>جــدی</option>
                            <option value="دلـــو" {{isset($percentageSalary->payment_month) && $percentageSalary->payment_month =='دلـــو' ? 'selected'.'='. 'selected':''}}>دلـــو</option>
                            <option value="حـــوت" {{isset($percentageSalary->payment_month) && $percentageSalary->payment_month =='حـــوت' ? 'selected'.'='. 'selected':''}}>حـــوت</option>



                        </select>
                        <span id="p_payment_month-error" class="help-block"></span>
                    </div>
                </div>
                <div class="col-sm-12 col-md-4">
                    <div class="form-group required" id="form-p_payment_date-error">
                        <div class="form-group required" id="form-p_payment_date-error">
                            <label for="p_payment_date" class="control-label"> تاریخ:</label>
                            <input type="" placeholder="روز/ماه/سال" id="jalali-datepicker"
                                   class="form-control required" name="p_payment_date"
                                   value="{{ old('payment_date',isset($percentageSalary->payment_date)? $percentageSalary->payment_date:'') }}">
                        </div>

                        <input id="id" type="hidden" class="form-control" name="id"
                               value="{{ old('payment_id',isset($percentageSalary->payment_id)? $percentageSalary->payment_id:'') }}"
                               autofocus>
                        <span id="payment_date-error" class="help-block"></span>
                    </div>
                </div>
                <p style="color:red;">توجه: مقدار پرداخت نباید بیشتر از سهم کارمند نظر به فیصدی باشد.</p>
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


</div>
<script>
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
                           JALALI DATEPICKER
                           * ===============*/


    })
</script>