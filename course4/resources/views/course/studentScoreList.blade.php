
<div class="col-md-12">
    <h3 style="margin-right: 2%;text-align: center;">
        {{isset($panel_title) ?$panel_title :''}}
    </h3>


    <table id="example" class="table table-striped table-bordered display" style="width:100%">
        <thead>
        <tr>
            <th>شماره</th>
            <th>نام شاگرد</th>
            <th>کلاس</th>
            <th>امتحان نصف کتاب</th>
            <th>امتحان نهایی</th>
            <th>جمع نمرات</th>
            <th>عملیات</th>

        </tr>
        </thead>
        <tfoot>
        <tr>
            <th>شماره</th>
            <th>نام شاگرد</th>
            <th>کلاس</th>
            <th>امتحان نصف کتاب</th>
            <th>امتحان نهایی</th>
            <th>نمره</th>
            <th>عملیات</th>
        </tr>

        </tfoot>
        <tbody id="content-display">
        @foreach($giveScore as $key=> $s)
            <tr class="" >
                <td>{{++$key}}</td>
                <td>{{$s->first_name}} {{$s->last_name}}</td>
                <td>{{$s->class_name}}</td>
                <td>{{$s->midterm_exam}}</td>
                <td>{{$s->final_exam}}</td>
                <td>{{$s->midterm_exam+$s->final_exam}}</td>
                <td>

                    <a href="javascript:ajaxLoad('{{route('giveScore.update',$s->score_id)}}')" class="glyphicon glyphicon-edit btn btn-success btn-xs" id="edit_course"></a>
                    <a href="javascript:if(confirm('Do you want delete this record?'))ajaxDelete('{{route('giveScore.delete',$s->score_id)}}','{{csrf_token()}}')" class="glyphicon glyphicon-trash btn btn-danger btn-xs" id="delete_coures"></a>
                </td>

            </tr>
        @endforeach

        </tbody>
    </table>
    <div class="row">
        <div class="col-sm-12 col-md-10">
            <p>برای نمایش اطلاعات بشتر از داخل دیتابیس از گزینه پایین استفاده کنید</p>
        </div>
        <div class="col-sm-12 col-md-2">
            <div style="text-align: center">

                {!! $giveScore->links(); !!}
            </div>
        </div>
    </div>

    <script>

        $(document).ready(function () {

          //  $('#example').dataTable();


        });

    </script>



</div>




