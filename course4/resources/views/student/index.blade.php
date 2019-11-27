
<div class="col-md-12">

    <h3 style="text-align: center">{{isset($panel_title) ?$panel_title :''}}</h3>
    <table id="example" class="table table-striped table-bordered display" style="width:100%">
        <thead>
        <tr>
            <th>ادیِ</th>
            <th>نام</th>
            <th>تخلص</th>
            <th>نام پدر</th>
            <th>تلیفون</th>
            <th>آدرس</th>
            <th>تاریخ</th>
            <th>عملیات</th>
        
        </tr>
        </thead>
        <tfoot>
        <tr>
            <th>ادیِ</th>
            <th>نام</th>
            <th>تخلص</th>
            <th>نام پدر</th>
            <th>تلیفون</th>
            <th>آدرس</th>
            <th>تاریخ</th>
            <th>عملیات</th>
        
        </tr>
        </tfoot>
        <tbody>
        @foreach($students as $student)
            <tr>
                <td>{{$student->st_id}}</td>
                <td>{{$student->first_name}}</td>
                <td>{{$student->last_name}}</td>
                <td>{{$student->father_name}}</td>
                <td>{{$student->phone}}</td>
                <td>{{$student->address}}</td>
                <td>{{$student->date}}</td>

                <td>
                    <a href="javascript:ajaxLoad('{{route('student.showDetail',$student->st_id)}}')" class="btn btn-info btn-xs" id="show_details">نمایش جزئیات</a>
                    <a href="javascript:ajaxLoad('{{route('student.update',$student->st_id)}}')" class="glyphicon glyphicon-edit btn btn-success btn-xs" id="edit_student"></a>
                    <a href="javascript:if(confirm('آیامیخواهید این شاگرد راحذف کنید؟؟'))ajaxDelete('{{route('student.delete',$student->st_id)}}','{{csrf_token()}}')" class="glyphicon glyphicon-trash btn btn-danger btn-xs" id="delete_student"></a>
                </td>
            </tr>
        @endforeach
        
        </tbody>
    </table>
    <script>

        $(document).ready(function () {

            $('#example').dataTable();
        })


    </script>

</div>








<

