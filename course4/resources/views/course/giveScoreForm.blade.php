<div class="container">
    <h3 style="text-align: center ; margin-right: 3%">
        {{isset($panel_title) ?$panel_title :''}}
    </h3>

    <form method="post" id="frm" action="{{isset($score) ?route('giveScore.update',$score->score_id):route('giveScore.create')}}">
        {{--{{isset($course) ?method_field('put') :''}}--}}
        {{csrf_field()}}
        <div class="row">
            <div class="col-sm-12 col-md-4">
                <div class="form-group required" id="form-student_name-error">
                    <label for="student_name" class="control-label">نام شاگرد: </label>
                    <select name="student_name" id="student_name" class="form-control required">
                        <option value="">شاگرد را انتخاب کنید</option>
                        @foreach($student as $s)
                            <option value="{{$s->st_id}}" {{isset($score->student_id) && $score->student_id == $s->st_id ? 'selected'.'='.'selected':''}}>{{$s->first_name}} {{$s->last_name}}</option>
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
                            <option value="{{$c->class_id}}" {{isset($score->class_id) && $c->class_id == $score->class_id ? 'selected'.'='.'selected':''}}>{{$c->class_name}}</option>
                        @endforeach
                    </select>
                    <span id="class-error" class="help-block"></span>
                </div>
            </div>
            <div class="col-sm-12 col-md-4">
                <div class="form-group required" id="form-exam_type-error">
                    <label for="exam_type" class="control-label">نوع امتحان: </label>
                    <select name="exam_type" id="exam_type" class="form-control required">
                        <option value="" disabled selected>نوع امتحان را مشخص کنید</option>
                        <option value="امتحان نصف کتاب" {{isset($score->exam_type) && $score->exam_type =='امتحان نصف کتاب' ? 'selected'.'='. 'selected':''}}>امتحان نصف کتاب</option>
                        <option value="امتحان نهایی" {{isset($score->exam_type) && $score->exam_type =='امتحان نهایی' ? 'selected'.'='. 'selected':''}}>امتحان نهایی</option>

                    </select>
                    <span id="exam_type-error" class="help-block"></span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 col-sm-4">
                <div class="form-group required" id="form-score-error">
                    <label for="score" class="control-label">نمره: </label>
                    <input id="score" type="number" class="form-control required" name="score" value="{{isset($score)?$score->score:''}}">
                    <span id="score-error" class="help-block"></span>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-4 form-group" style="margin-top: 3%;">
            <div class="col-sm-12 col-md-12 col-md-offset-4 register">
                <button type="submit" id="btn_save" class="glyphicon glyphicon-floppy-disk btn btn-primary">
                    ذخیره
                </button>

                <a href="javascript:ajaxLoad('giveScore')"
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
