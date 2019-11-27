<div class="container">
    <h3 style="text-align: right ; margin: 3%">
        {{isset($panel_title) ?$panel_title :''}}
    </h3>
    <div class=" col-md-12 col-lg-12">


            <div class="col-md-6 col-sm-12">

                    <form method="post" id="frm"
                          action="{{isset($st_class) ? route('management.classUpdate',$st_class->st_cl_id): route('classmanage.create')}}" >
                        {{csrf_field()}}
                    <input name="class_name" id="class_name" type="hidden" value="">
                    <div class="form-group required col-md-6 col-lg-6 " id="form-bill_number-error">
                        <label for="bill_number" class="col-md-12 control-label">نمبر قبض :</label>
                        <input name="bill_number" id="student-bill_number" type="number" class="form-control required"
                               value="{{isset($st_class)? $st_class->bill_number:''}}">
                        <span id="bill_number-error" class="help-block"></span>
                    </div>

                    <div class="form-group required col-md-6 col-lg-6" id="form-student_id-error">
                        <label class="col-md-12 control-label ">جستجوی آی دی :</label>
                        <input name="student_id" id="student-search-input-s" type="number" class="form-control required"
                               value="{{isset($st_class)? $st_class->student_id:''}}">
                        <span id="student_id-error" class="help-block"></span>
                    </div>


                    <div class="form-group required col-md-6 col-lg-6" id="form-class_id-error">
                        <label for="class_id" class="col-md-10 control-label">کلاس:</label>
                        <select name="class_id" id="class_id" class="form-control required">
                            <option>-------</option>
                            @foreach($course as $c)

                                <option value="{{ $c->class_id }}" {{isset($st_class->class_id) && $c->class_id == $st_class->class_id ? 'selected'.'='.'selected':''}}>{{$c->class_name}}  {{$c->start_date}}</option>

                            @endforeach
                        </select>
                        <span id="class_id-error" class="help-block"></span>
                    </div>

                    <div class="form-group required col-md-6 " id="form-class_fees-error">
                        <label for="class_fees" class="col-md-10 control-label">فیس کلاس:</label>
                        <input name="class_fees" type="number" id="class_fees" class="form-control required"
                               value="{{isset($st_class)? $st_class->c_payment+$st_class->c_borrow:''}}">
                        <span id="class_fees-error" class="help-block"></span>
                    </div>
                    <div class=" form-group required col-md-6 " id="form-class_payment-error">
                        <label for="class_payment" class="col-md-10 control-label">مقدارپرداخت:</label>
                        <input name="class_payment" id="class_payment" type="number" class="form-control required"
                               value="{{isset($st_class)? $st_class->c_payment:''}}">
                        <span id="class_payment-error" class="help-block"></span>
                    </div>
                    <div class=" form-group  col-md-6 required" id="form-class_discount-error">
                        <label for="class_discount" class="col-md-10 control-label">تخفیف:</label>
                        <input name="class_discount" id="class_discount" value="0" type="number" class="form-control required"
                               value="{{isset($st_class)? $st_class->c_discount:''}}">
                        <span id="class_discount-error" class="help-block"></span>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12 col-md-offset-10 register">

                            <div class="margin-top-1">
                                <button type="submit" id="btn_save" class="btn btn-primary glyphicon glyphicon-floppy-disk"> راجسترکردن</button>

                                <a href="{{route('management.classList')}}" type="button" id="" class="btn btn-danger glyphicon glyphicon-floppy-disk"> لغو</a>

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
</div>

<script>

    $(document).ready(function () {





        $("#student-search-input-s").keyup(function () {

            var search = $(this).val();


            $.ajax({
                type: "get",
                url: "management/class/search/"+search,
                contentType: false,
                success: function (data) {
                    $(".tbody").html(data)

                },
            });

        });

    })

    function setdata(data) {

        $("#student-se-s").val(data);

    }

    $(document).ready(function () {



        $("#class_id").change(function () {

            var search = $(this).val();


            $.ajax({
                type: "get",
                url: "management/class/feesChoice/"+search,
                contentType: false,
                success: function (data) {

                    $("#class_fees").val(data);
                },
            });

        });

    })



    function setdata(data) {

        $("#class_id").val(data);

    }


</script>