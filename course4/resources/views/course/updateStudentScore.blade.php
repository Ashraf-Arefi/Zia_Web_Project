<div class="container">
    <h3 style="text-align: center ; margin-right: 3%">
        {{isset($panel_title) ?$panel_title :''}}
    </h3>

    <form method="post" id="frm" action="{{route('giveScore.update',$score->score_id)}}">
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
                <div class="form-group required" id="form-midterm_score-error">
                    <label for="midterm_score" class="control-label">نمره نصف کتاب: </label>
                    <input id="midterm_score" type="number" class="form-control required" name="midterm_score" value="{{isset($score)?$score->midterm_exam:''}}">
                    <span id="midterm_score-error" class="help-block"></span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 col-sm-4">
                <div class="form-group required" id="form-final_score-error">
                    <label for="final_score" class="control-label">نمره نهایی: </label>
                    <input id="final_score" type="number" class="form-control required" name="final_score" value="{{isset($score)?$score->final_exam:''}}">
                    <span id="final_score-error" class="help-block"></span>
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
