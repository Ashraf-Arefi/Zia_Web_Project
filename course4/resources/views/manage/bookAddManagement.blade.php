<div class="container">

    <h3 style="text-align: right ; margin: 3%" >
        {{isset($panel_title) ?$panel_title :''}}

    </h3>
    <div class=" col-md-12 col-lg-12 col-sm-12">

            <div class="col-md-6">

                <form method="post" id="frm"
                      action="{{isset($student_book) ? route('management.barrowBookUpdate',$student_book->st_bk_id): route('bookCreate.create')}}" >
                    {{csrf_field()}}
                    <div class=" form-group required col-md-12 "  id="form-student_id-error">
                        <label for="student_id " class="col-md-12 control-label">جستجو آی دی شاگرد:</label>
                        <input name="student" id="student-search-input" type="number" class="form-control required "
                               value="{{isset($student_book)? $student_book->student_id:''}}">
                        <span id="student_id-error" class="help-block"></span>
                    </div>

                    <div class="form-group required col-md-6" id="form-book_id-error">
                        <label for="book_id" class="col-md-12 control-label">کتاب :</label>
                        <select name="book_id" id="book_id" class="form-control required">
                            <option value="">کتاب را انتخاب کنید</option>
                            @foreach($book as $b)

                                <option value="{{ $b->book_id }}" {{isset($student_book->book_id) && $b->book_id == $student_book->book_id ? 'selected'.'='.'selected':''}}>{{$b->book_name}}</option>

                            @endforeach
                        </select>
                        <span id="class_book_id-error" class="help-block"></span>
                    </div>
                    <div class="form-group col-md-6 required" id="form-book_number-error">
                        <label for="book_number" class="col-md-12 control-label">تعداد کتاب :</label>
                        <input name="book_number" type="number" id="book_number" class="form-control required"
                               onblur="calculate()" onfocus="calculate()"  onmouseleave="calculate()"     value="{{isset($student_book)? $student_book->quantity:''}}">
                        <span id="book_number-error" class="help-block"></span>
                    </div>
                    <div class="form-group col-md-6 required" id="form-book_price-error">
                        <label for="book_price" class="col-md-12 control-label">قیمت کتاب :</label>
                        <input name="book_price" type="number" id="book_price" class="form-control required"
                               onfocus="calculate()" onblur="calculate()"       value="{{isset($student_book)? (($student_book->payment/$student_book->quantity)+$student_book->borrow+$student_book->discount):''}}">
                        <span id="book_price-error" class="help-block"></span>
                    </div>
                    <div class="form-group col-md-6 required" id="form-payment-error">
                        <label for="payment" class="col-md-12 control-label">مقدارپرداخت :</label>
                        <input name="payment" id="payment" type="number" class="form-control required"
                               value="{{isset($student_book)? $student_book->payment:''}}">
                        <span id="payment-error" class="help-block"></span>
                    </div>
                    <div class="form-group col-md-6 required" id="form-total_payment-error">
                        <label for="total_payment" class="col-md-12 control-label">مجموعه پرداخت :</label>
                        <input name="total_payment" id="total_payment" type="number" class="form-control required">
                        <span id="total_payment-error" class="help-block"></span>
                    </div>
                    <div class="form-group col-md-6 required" id="form-discount-error">
                        <label for="discount" class="col-md-12 control-label">مقدارتخفیف :</label>
                        <input name="discount" id="discount" value="0" type="number" class="required form-control"
                               value="{{isset($student_book)? $student_book->discount:''}}">
                        <span id="class_discount-error" class="help-block"></span>
                    </div>
                    <div class="form-group col-md-6 required" id="form-date-error">
                        <label for="date" class="control-label">تاریخ:</label>
                        <input id="jalali-datepicker"  placeholder="روز/ماه/سال" type="" class="form-control jalali-datepicker required" name="date"
                               value="{{isset($student_book)? $student_book->date:'' }}"
                               autofocus>
                        <span id="date-error" class="help-block"></span>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-10 register">
                            <div class="margin-top-1">
                                <button type="submit" id="btn_save" class="btn btn-primary glyphicon glyphicon-floppy-disk"> راجسترکردن</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="col-md-6">


                <label for="subject" class="col-md-10 control-label ">مشخصات شاگرد :</label>


                <table class="table table-striped table-bordered table-responsive">
                    <thead>
                    <tr>
                        <td>آدی</td>
                        <td>نام</td>
                        <td>نام پدر</td>
                        <td>نمبرتماس</td>
                    </tr>
                    </thead>

                    <tbody class="tbody">

                    </tbody>
                </table>


            </div>


        </div>

</div>

<script>

    $(document).ready(function () {


        $("#student-search-input").keyup(function () {

            var search = $(this).val();

            $.ajax({
                type: "get",
                url: "management/book/search/"+search,
                contentType: false,
                success: function (data) {
                    $(".tbody").html(data)


                },
            });

        });



    })

    function setdata(data) {

        $("#student-id").val(data);

    }

    $(document).ready(function () {



        $("#book_id").change(function () {


            var search = $(this).val();

            $.ajax({
                type: "get",
                url: "management/book/bookPaymentChoice/"+search,
                contentType: false,
                success: function (data) {

                    $("#book_price").val(data);
                },
            });


        });

    });

    calculate = function () {
        var bn = document.getElementById('book_number').value;
        var bp = document.getElementById('book_price').value;


        document.getElementById('total_payment').value = (parseInt(bn) * parseInt(bp));


    }

    function setdata(data) {

        $("#book_id").val(data);

    }

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