<div class="container">
    <h3 style="text-align: center ; margin-right: 3%">
        {{isset($panel_title) ?$panel_title :''}}
    </h3>

    <form method="post" id="frm" action="{{isset($certificate) ?route('giveCertificate.update',$certificate->certificate_id):route('giveCertificate.create')}}">
        {{--{{isset($course) ?method_field('put') :''}}--}}
        {{csrf_field()}}
        <div class="row">
            <div class="col-sm-12 col-md-4">
                <div class="form-group required" id="form-student_name-error">
                    <label for="student_name" class="control-label">نام شاگرد: </label>
                    <select name="student_name" id="student_name" class="form-control required">
                        <option value="">شاگرد را انتخاب کنید</option>
                        @foreach($student as $s)
                            <option value="{{$s->st_id}}" {{isset($certificate->student_id) && $certificate->student_id == $s->st_id ? 'selected'.'='.'selected':''}}>{{$s->first_name}} {{$s->last_name}}</option>
                        @endforeach
                    </select>
                    <span id="student_name-error" class="help-block"></span>
                </div>
            </div>
            <div class="col-sm-12 col-md-4">
                <div class="form-group required" id="form-class-error">
                    <label for="class" class="control-label">کلاس: </label>
                    <select name="class" id="class" class="form-control required">
                        <option value="">کلاس را انتخاب کنید</option>
                        @foreach($class as $c)
                            <option value="{{$c->class_id}}" {{isset($certificate->class_id) && $c->class_id == $certificate->class_id ? 'selected'.'='.'selected':''}}>{{$c->class_name}}</option>
                        @endforeach
                    </select>
                    <span id="class-error" class="help-block"></span>
                </div>
            </div>
            <div class="col-sm-12 col-md-4">
                <div class="form-group required " id="form-payment-error">
                    <label for="payment" class="control-label">پرداخت :</label>
                    <input type="number" name="payment" id="payment" class="form-control" value="{{isset($certificate->payment)? $certificate->payment:''}}">
                    <span id="payment-error" class="help-block"></span>
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-sm-12 col-md-4">
                <div class="form-group required" id="form-givedCertificate_date-error">
                    <label for="givedCertificate_date" class="control-label ">تاریخ روز:</label>
                    <div class="input-group">
                        <input type="text" class="form-control required" placeholder="روز/ماه/سال" id="jalali-datepicker" value="{{isset($certificate->date)? $certificate->date:''}}"
                               name="givedCertificate_date" >
                        <span class="input-group-addon bg-primary text-white"><i class="fa fa-calendar"></i></span>
                    </div>
                    <span id="givedCertificate_date-error" class="help-block"></span>
                </div>
            </div>
            <div class="col-sm-12 col-md-4">
                <div class="form-group required " id="form-description-error">
                    <label for="description" class="control-label">توضیحات :</label>
                    <textarea class="form-control" name="description" id="description" rows="1">{{isset($certificate->description)? $certificate->description:''}}</textarea>
                    <span id="description-error" class="help-block"></span>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-4 form-group" style="margin-top: 3%;">
            <div class="col-sm-12 col-md-12 col-md-offset-4 register">
                <button type="submit" id="btn_save" class="glyphicon glyphicon-floppy-disk btn btn-primary">
                    ذخیره
                </button>

                <a href="javascript:ajaxLoad('giveCertificate')"
                   class="glyphicon glyphicon-backward btn btn-danger">لغو</a>
            </div>
        </div>

    </form>


</div>

<script type="text/javascript">

    $(document).ready(function () {


        /*
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
