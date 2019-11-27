
<div class="col-md-12">

    <button type="button" class="btn btn-primary margin-bottom-10 waves-effect waves-light" data-toggle="modal" data-target="#boostrapModal-1">Standard modal</button>
    <button type="button" class="btn btn-success margin-bottom-10 waves-effect waves-light" data-toggle="modal" data-target="#boostrapModal-2">Large modal</button>
    <button type="button" class="btn btn-warning margin-bottom-10 waves-effect waves-light" data-toggle="modal" data-target="#boostrapModal-3">Small modal</button>

    <table id="example" class="table table-striped table-bordered display" style="width:100%">
        <thead>
        <tr>
            <th>ادیِ</th>
            <th>نام</th>
            <th>تخلص</th>
            <th>نام پدر</th>
            <th>تلیفون</th>
            <th>آدرس</th>
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

                <td>
                    <a href="javascript:ajaxLoad('{{route('student.showDetail',$student->st_id)}}')" class="btn btn-info btn-xs" id="edit_book">Show Detail</a>
                    <a href="javascript:ajaxLoad('{{route('student.update',$student->st_id)}}')" class="btn btn-success btn-xs" id="edit_book">Edit</a>
                    <a href="javascript:if(confirm('Do you want delete this record?'))ajaxDelete('{{route('student.delete',$student->st_id)}}','{{csrf_token()}}')" class="btn btn-danger btn-xs" id="delete_card">Delete</a>
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

