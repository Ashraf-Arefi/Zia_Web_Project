<div class="container">
<h3 style="text-align: right ; margin-right: 3%">
    {{isset($panel_title) ?$panel_title :''}}
</h3>

<form method="post" id="frm"
      action="{{isset($studentCard) ? route('card.studentCardUpdate',$studentCard->card_id):route('card.studentCardCreate')}}">

    {{csrf_field()}}

    <div class="row">
        <div class="col-sm-12 col-md-6">
            <div class="form-group required" id="form-card-error">
                <label for="card" class="col-md-4 control-label">نام کارت :</label>
                <select name="card" id="card" class="form-control required">
                    <option value="">انتخاب کارت</option>
                    @foreach($card as $c)

                        <option value="{{ $c->card_id}}" {{isset($studentCard->card_id) && $c->card_id == $studentCard->card_id ? 'selected'.'='.'selected':''}}>{{$c->card_name}}</option>

                    @endforeach
                </select>
                <span id="card-error" class="help-block"></span>
            </div>
        </div>
        <div class="col-sm-12 col-md-6">
            <div class="form-group required" id="form-student-error">
                <label for="student" class="col-md-4 control-label">نام شاگرد :</label>
                <select name="student" id="student" class="form-control required">
                    <option value="">انتخاب شاگرد</option>
                    @foreach($student as $s)
                        <option value="{{ $s->st_id}}" {{isset($studentCard->student_id) && $s->st_id == $studentCard->student_id ? 'selected'.'='.'selected':''}}>{{$s->first_name}} {{$s->last_name}}</option>
                    @endforeach
                </select>
                <span id="student-error" class="help-block"></span>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12 col-md-6">
            <div class="form-group required" id="form-payment-error">
                <label for="payment" class="col-md-4 control-label">فیس کارت:</label>
                <input type="number" placeholder="فیس کارت" id="payment" class="form-control required"
                       name="payment" value="">
            </div>
        </div>
        <div class="col-sm-12 col-md-6">
            <div class="form-group required" id="form-date-error">
                <label for="date" class="col-md-4 control-label"> تاریخ:</label>
                <input type="" placeholder="روز/ماه/سال" id="jalali-datepicker" class="form-control required"
                       name="date"
                       value="">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="form-group">
            <div class="col-md-6 col-md-offset-4 register">

                <button type="submit" id="btn_save" class="glyphicon glyphicon-floppy-disk btn btn-primary">
                    ذخیره
                </button>
                <a href="javascript:ajaxLoad('course')"
                   class="glyphicon glyphicon-backward btn btn-danger">لغو</a>
            </div>
        </div>
    </div>

</form>




<script type="text/javascript">

    $(document).ready(function () {



        $("#card").change(function () {

            var cardNumber = $(this).val();

            $.ajax({
                type: "get",
                url : 'card/getCardID/'+cardNumber,
                contentType: false,
                success: function (data) {

                    $("#payment").val(data);
                },
            });

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
          EDTITABEL TABLE
        * ===============*/
        $('.select2_1').select2();

    });

</script>
</div>