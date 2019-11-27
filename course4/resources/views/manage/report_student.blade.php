<link rel="stylesheet" type="text/css" href="/css/jquery-ui.min.css">
<div class="row">
    <form action="{{route('report_data')}}" id="report">
        <div class="col col-md-12">

            <div class="col col-md-3">
                <div class="form-group">
                    <label for="reason">نوع درامد:</label>
                    <select name="reason" id="reason" class="form-control select2_1">
                        <option value="select_option">نوع درامد </option>
                        <option value="all">همه درامد</option>
                        <option value="class">درامد کلاس ها</option>
                        <option value="book">درامد کتاب ها</option>

                    </select>
                </div>



            </div>
            <div class="col col-md-3">
                <div class="form-group" id="choose">
                    <label for="type">نحوه گزارش:</label>
                    <select id="type" name="type" class="form-control">
                        <option  value="type-1">نوع</option>
                        <option  value="day">روز</option>
                        <option value="week">هفته</option>
                        <option value="month">ماه</option>
                        <option value="year">سال</option>
                        <option value="bt_date">بین تاریخ</option>
                    </select>
                </div>

            </div>
            <div class="col col-md-6">
                @include('manage.month')
                @include('manage.year')
                @include('manage.bettwen_date')
            </div>



        </div>

    </form>






    <div class="col-md-12">


        <table id="example" class="table table-striped table-bordered display" style="width:100%">
            <thead>
            <tr>
                <th>مقدار</th>
                <th>پول رایچ</th>
                <th>زمان</th>


            </tr>
            </thead>
            <tfoot>
            <tr>
                <td></td>
                <td></td>
                <td style="float: left">
                    <a href="javascript:ajaxLoad('expense')" class="btn btn-danger">Back</a>
                    <a href="#"><i class=" btn fa fa-file-pdf-o" style="color: red; font-size: 22px;"></i></a>

                    <button class="btn btn-default" id="btn-print"><i class="glyphicon glyphicon-print"
                                                                      style="color: #1d84df"></i><span
                                style="margin-right: 6px;">پرنت</span></button>

                </td>
            </tr>

            </tfoot>
            <tbody id="tbl_report">



            </tbody>
        </table>


    </div>

</div>
<script src="/js/jquery-ui.min.js"></script>
<script type="text/javascript">

    $(document).ready(function () {

        $('#report').on('click', function (e) {
            e.preventDefault();
            var data = $(this).serialize();
            var url = $(this).attr('action');

            // var Post = $(this).attr('method');
            $.ajax({
                type: 'GET',
                url: url,
                data: data,
                dataType: 'json',
                success: function (data) {
                    console.log(data);
                    $('#tbl_report').html(data.table_data);
                }
            });
        });

    });



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
        kamaDatepicker('jalali-enddate', opt);
        kamaDatepicker('jalali-startdate', opt);

        /*================
          EDTITABEL TABLE
        * ===============*/
        $('.select2_1').select2();

    });



    /**  report js**/
    $(function () {
        $('#as_date').hide();
        $('#year').hide();
        $('#month').hide();
        $('#between_date').hide();
        $('#type').change(function () {

            if ($('#type').val() == 'month') {
                $('#between_date').hide();
                $('#year').hide();
                $('#as_date').hide();
                $('#month').show();
            } else if ($('#type').val() == 'week') {
                $('#month').hide();
                $('#as_date').hide();
                $('#between_date').hide();
                $('#year').hide();

            } else if ($('#type').val() == 'day') {
                $('#month').hide();
                $('#as_date').hide();
                $('#between_date').hide();
                $('#year').hide();

            } else if ($('#type').val() == 'year') {
                $('#month').hide();
                $('#as_date').hide();
                $('#year').show();
            } else if ($('#type').val() == 'bt_date') {
                $('#month').hide();
                $('#year').hide();
                $('#as_date').show();
                $('#between_date').show();
            } else {
                $('#selection').hide();
            }
        });

    });




</script>

