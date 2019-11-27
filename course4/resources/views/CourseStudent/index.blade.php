
<div class="col-md-12">
    
    <button type="button" class="btn btn-primary margin-bottom-10 waves-effect waves-light" data-toggle="modal" data-target="#boostrapModal-1">Standard modal</button>
    <button type="button" class="btn btn-success margin-bottom-10 waves-effect waves-light" data-toggle="modal" data-target="#boostrapModal-2">Large modal</button>
    <button type="button" class="btn btn-warning margin-bottom-10 waves-effect waves-light" data-toggle="modal" data-target="#boostrapModal-3">Small modal</button>
    
    <table id="example" class="table table-striped table-bordered display" style="width:100%">
        <thead>
        <tr>
            <th>ادیِ</th>
            <th>مضمون</th>
            <th>استاد</th>
            <th> اتاق</th>
            <th> زمان</th>
            <th> تاریخ شروع</th>
            <th> تاریخ ختم</th>
            <th>عملیات</th>
        
        </tr>
        </thead>
        <tfoot>
        <tr>
            <th>ادیِ</th>
            <th>مضمون</th>
            <th>استاد</th>
            <th> اتاق</th>
            <th> زمان</th>
            <th> تاریخ شروع</th>
            <th> تاریخ ختم</th>
            <th>عملیات</th>
        </tr>
        </tfoot>
        <tbody>
        @foreach($courses as $course)
            <tr>
                <td>1</td>
                <td>{{$course->subject_id}}</td>
                <td>{{$course->emaployee_id}}</td>
                <td>{{$course->room_id}}</td>
                <td>{{$course->time}}</td>
                <td>{{$course->start_date}}</td>
                <td>{{$course->end_date}}</td>
                <td>
                    <a href="javascript:ajaxLoad('{{route('course.update',$course->class_id)}}')" class="btn btn-success btn-xs" id="edit_course">Edit</a>
                    <a href="javascript:if(confirm('Do you want delete this record?'))ajaxDelete('{{route('course.delete',$course->class_id)}}','{{csrf_token()}}')" class="btn btn-danger btn-xs" id="delete_coures">Delete</a>
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

