<div class="container">
    <h4 class="box-title">
        {{isset($panel_title) ?$panel_title :''}}
    </h4>

        <form method="post" id="frm" enctype="multipart/form-data"
              action="{{ isset($student) ? route('student.update',$student->st_id): route('student.create')}}">
            {{csrf_field()}}
            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-3">
                        <div class="form-group required" id="form-name-error">
                            <label for="name" class="control-label">نام : </label>
                            <input id="name" type="text" class="form-control required" name="name"
                                   value="{{ old('description',isset($student)? $student->first_name:'') }}"
                                   autofocus>

                        </div>
                        <span id="name-error" class="help-block"></span>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group required" id="form-last_name-error">
                            <label for="last_name" class="control-label"> تخلص :</label>
                            <input id="last_name" type="text" class="form-control required" name="last_name"
                                   value="{{ old('description',isset($student)? $student->last_name:'') }}"
                                   autofocus>
                        </div>
                        <span id="last_name-error" class="help-block"></span>
                    </div>
                    <div class="col-md-3">

                        <div class="form-group required" id="form-father_name-error">
                            <label for="father_name" class="control-label"> نام پدر :</label>
                            <input id="father_name" type="text" class="form-control required" name="father_name"
                                   value="{{ old('description',isset($student)? $student->father_name:'') }}"
                                   autofocus>
                        </div>
                        <span id="father_name-error" class="help-block"></span>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group required" id="form-age-error">
                            <label for="age" class="control-label">سن :</label>
                            <input id="age" type="number" class="form-control required" name="age"
                                   value="{{ old('description',isset($student)? $student->age:'') }}"
                                   autofocus>
                        </div>
                        <span id="age-error" class="help-block"></span>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group required" id="form-phone-error">
                            <label for="phone" class="control-label">تلیفون :</label>
                            <input id="phone" type="text" class="form-control" name="phone"
                                   value="{{ old('description',isset($student)? $student->phone:'') }}"
                                   autofocus>
                        </div>
                        <span id="phone-error" class="help-block"></span>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group required" id="form-address-error">
                            <label for="address" class="control-label">آدرس :</label>
                            <input id="address" type="text" class="form-control" name="address"
                                   value="{{ old('description',isset($student)? $student->address:'') }}"
                                   autofocus>
                        </div>
                        <span id="address-error" class="help-block"></span>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group required" id="form-date-error">
                            <label for="date" class="control-label">تاریخ :</label>
                            <input id="jalali-datepicker"  placeholder="روز/ماه/سال" type="" class="form-control jalali-datepicker required" name="date"
                                   value="{{ old('come_date',isset($student)? $student->date:'') }}"
                                   autofocus>
                            <span id="date-error" class="help-block"></span>
                        </div>
                    </div>
                    <div class="col-md-3" style="margin-top: 30px;">
                        <div class="form-group{{ $errors->has('department') ? ' has-error' : '' }}">
                            <label for="department" class="control-label">جنسیت : </label>
                            <input type="radio"

                                   @if(isset($student))

                                   @if($student->gender == "male")
                                   checked
                                   @endif

                                   @endif

                                   name="gender" value="male" checked/>
                            آقا
                            </label>
                            <label>
                                <input type="radio"
                                       @if(isset($student))

                                       @if($student->gender == "female")
                                       checked
                                       @endif

                                       @endif
                                       name="gender" value="female"/>
                                خانم
                            </label>
                        </div>
                    </div>



                    <div class="col-md-4" >
                        <div class="form-group">
                            <input name="photo" style='height: 0px;width:0px; overflow:hidden;' id="photo" type='file' onchange="readURL1(this);" />
                            <img id="blah1"  style="height: 25%;width: 100%"  src="{{ asset("image/empty_profile.jpg") }}" alt="your image" />
                            <label {{ isset($student)? 'disabled' : "" }} for="photo" class="form-control btn btn-default">انتخاب عکس :</label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <input name="agreepaper" style='height: 0px;width:0px; overflow:hidden;' id="agreement" type='file' onchange="readURL2(this);" />
                            <img id="blah2"  style="height: 25%;width: 100%" src="{{ asset("image/agreement.jpg") }}" alt="your image" />
                            <label {{ isset($student)? 'disabled' : "" }} for="agreement" class="form-control btn btn-default">انتخاب تعهد نامه :</label>
                        </div>
                    </div>

                    <div class="form-group">
                    <div class="col-md-6 col-md-offset-4 register">
                        <button type="submit" id="btn_save" class="glyphicon glyphicon-floppy-disk btn btn-primary"> ذخیره</button>
                        <a href="javascript:ajaxLoad('student')" class="glyphicon glyphicon-backward btn btn-danger"> لغو</a>

                    </div>
                </div>
                </div>
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
</script>
