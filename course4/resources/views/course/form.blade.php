<div class="container">
    <h3 style="text-align: right ; margin-right: 3%">
        {{isset($panel_title) ?$panel_title :''}}
    </h3>

    <form method="post" id="frm"
          action="{{isset($course) ? url('course/update/'.$course->class_id): route('course.create')}}">
        {{isset($course) ?method_field('put') :''}}
        {{csrf_field()}}
        <input name="class_name" id="class_name" type="hidden" value="">
        <input name="class_id" id="class_id" type="hidden" value="">
        <div class="row">
            <div class="col-sm-12 col-md-4">
                <div class="form-group required" id="form-subject-error">
                    <label for="subject" class=" control-label">مضمون :</label>
                    <select name="subject" id="subject" class="form-control required">
                        <option value="">انتخاب مضمون</option>
                        @foreach($subjects as $subject)
                            <option value="{{ $subject->subject_id}}"
                                    {{isset($course->subject_id) && $subject->subject_id == $course->subject_id ? 'selected'.'='.'selected':''}}>
                                {{$subject->subject_name}}
                            </option>
                        @endforeach
                    </select>
                    <span id="subject-error" class="help-block"></span>
                </div>
            </div>
            <div class="col-sm-12 col-md-4">
                <div class="form-group required" id="form-employee-error">
                    <label for="employee" class=" control-label">استاد:</label>
                    <select name="employee[]" id="employee" class="form-control" multiple>
                        <option value="">انتخاب استاد</option>
                        @foreach($employees as $employee)
                            <option value="{{ $employee->employee_id}}"

                            @foreach($class_teacher as $id)


                                @if ($id->teacher_id == $employee->employee_id)
                                    selected
                                @endif
                                    @endforeach

                            >

                                {{ $employee->first_name }} {{ $employee->last_name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-sm-12 col-md-4">
                <div class="form-group required" id="form-room-error">
                    <label for="room" class=" control-label">اتاق :</label>
                    <select name="room" id="room" class="form-control">
                        @foreach($rooms as $room)
                            <option value="{{ $room->room_name}}"
                                    {{isset($course->room_id) && $room->room_id == $course->room_id ? 'selected'.'='.'selected':''}}>
                                {{$room->room_name}}
                            </option>
                        @endforeach
                    </select>
                    <span id="room-error" class="help-block"></span>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-sm-12 col-md-4">
                <div class="form-group required" id="form-start_time-error">
                    <label for="start_time" class="control-label"> تایم :</label>
                    <div class="form-control">

                        <input type="text" class=" required timepicker class_start_time" name="start_time"
                               id="start_time"
                               value="{{ old('start_time',isset($course->start_time)? $course->start_time:'') }}">
                        <input type="text" class=" required timepicker class_end_time" name="end_time" id="end_time"
                               value="{{ old('end_time',isset($course->end_time)? $course->end_time:'') }}">
                    </div>
                    <span id="start_time-error" class="help-block"></span>
                </div>
            </div>
            <div class="col-sm-12 col-md-4">
                <div class="form-group required" id="form-fees-error">
                    <label for="fees" class="col-md-12 col-sm-12 control-label"> فیس کلاس :</label>
                    <input type="number" placeholder="فیس کلاس" id="fees" class="form-control required"
                           name="fees" value="{{ old('fees',isset($course->fees)? $course->fees:'') }}">
                </div>
            </div>
            <div class="col-sm-12 col-md-4">
                <div class="form-group required" id="form-course_percentage-error">
                    <label for="course_percentage" class="col-md-12 col-sm-12 control-label"> فیصدی کورس :</label>
                    <input type="course_percentage" placeholder="فیصدی کورس" id="fecourse_percentagees"
                           class="form-control required"
                           name="course_percentage"
                           value="{{ old('course_percentage',isset($course->course_percentage)? $course->course_percentage:'') }}">
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-sm-12 col-md-4">
                <div class="form-group required" id="form-start_date-error">
                    <label for="start_date" class="col-md-12 col-sm-12 control-label"> تاریخ شروع :</label>
                    <input type="" placeholder="روز/ماه/سال" id="jalali-datepicker" class="form-control required"
                           name="start_date"
                           value="{{ old('start_date',isset($course->start_date)? $course->start_date:'') }}">
                </div>
            </div>
            <div class="col-sm-12 col-md-4">
                <div class="form-group required" id="form-class_status-error">
                    <label for="class_status" class=" control-label">حالت کلاس :</label>
                    <select name="class_status" id="class_status" class="form-control required">
                        <option value="درحال جریان" {{isset($course->class_status) && $course->class_status =='درحال جریان' ? 'selected'.'='. 'selected':''}}>
                            درحال جریان
                        </option>
                        <option value="قراره شروع شود" {{isset($course->class_status) && $course->class_status =='قراره شروع شود' ? 'selected'.'='. 'selected':''}}>
                            قراره شروع شود
                        </option>
                        <option value="درحال ختم" {{isset($course->class_status) && $course->class_status =='درحال ختم' ? 'selected'.'='. 'selected':''}}>
                            درحال ختم
                        </option>
                        <option value="ختم شده" {{isset($course->class_status) && $course->class_status =='ختم شده' ? 'selected'.'='. 'selected':''}}>
                            ختم شده
                        </option>

                    </select>
                    <span id="class_status-error" class="help-block"></span>
                </div>
            </div>
            <div class="col-sm-12 col-md-4" style="margin-top: 8px;">

                <div class="form-group required" id="form-certificate-error">
                    <label for="certificate">مدرک(certificate) : </label><br>
                    <label>
                        <input type="radio"

                               @if(isset($course))

                               @if($course->certificate == "دارد")
                               checked
                               @endif

                               @endif
                               name="certificate" value="دارد"/>
                        دارد
                    </label>
                    <label>
                        <input type="radio"
                               @if(isset($course))

                               @if($course->certificate == "ندارد")
                               checked
                               @endif

                               @endif
                               name="certificate" value="ندارد"/>
                        ندارد
                    </label>
                    <span id="certificate-error" class="help-block"></span>
                </div>

            </div>

        </div>
        <div class="row">
            <div class="col-sm-12 col-md-4 form-group" style="margin-top: 3%;">
                <div class="col-sm-12 col-md-12 col-md-offset-4 register">
                    <button type="submit" id="btn_save" class="glyphicon glyphicon-floppy-disk btn btn-primary">
                        ذخیره
                    </button>

                    <a href="javascript:ajaxLoad('course')"
                       class="glyphicon glyphicon-backward btn btn-danger">لغو</a>
                </div>
            </div>
        </div>


    </form>


</div>

<script type="text/javascript">

    $(document).ready(function () {

        $('#employee').select2();


        /* $('.timepicker-input').timepicker({
             timeFormat: 'h:mm p',
             interval: 60,
             minTime: '10',
             maxTime: '6:00pm',
             defaultTime: '11',
             startTime: '10:00',
             dynamic: true,
             dropdown: true,
             scrollbar: true
         });

     });*/
        // get subject name and set it to class name

        if ($('#subject').change(function () {

            var d = $('#subject option:selected').html();

            $("#class_name").val(d)
        })) ;


        var d = $('#subject option:selected').html();

        $("#class_name").val(d)

        // get subject id and set it to class id
        $("#subject").change(function () {

            var d = $(this).val();

            $("#class_id").val(d)
        });

        // Time Picker Initialization from celebration start time
        $('#start_time').timepicker();

        // Time Picker Initialization from celebration end time
        $('#end_time').timepicker();


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
