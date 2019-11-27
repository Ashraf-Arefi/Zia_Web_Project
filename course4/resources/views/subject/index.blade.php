
<div class="col-md-12">
    <h3 style="text-align: center" >
        {{isset($panel_title) ?$panel_title :''}}
    </h3>
    <table id="example" class="table table-striped table-bordered display" style="width:100%">
        <thead>
        <tr>
            <th>ادیِ</th>
            <th>نام مضمون</th>
            <th> فیس پرداختی</th>
            <th>دپارتمنت</th>
            <th>عملیات</th>
        
        </tr>
        </thead>
        <tfoot>
        <tr>
            <th>ادیِ</th>
            <th>نام مضمون</th>
            <th> فیس پرداختی</th>
            <th>دپارتمنت</th>
            <th>عملیات</th>
        
        </tr>
        </tfoot>
        <tbody>
        @foreach($subjects as $subject)
            <tr>
                <td>{{$subject->subject_id}}</td>
                <td>{{$subject->subject_name}}</td>
                <td>{{$subject->subject_payment}}</td>
                <td>{{$subject->department_name}}</td>

                <td>
                    <a href="javascript:ajaxLoad('{{route('subject.update',$subject->subject_id)}}')" class="glyphicon glyphicon-edit btn btn-primary btn-sm" id="edit_subject" style="margin-left: 3%"></a>
                    <a href="javascript:if(confirm('Do you want delete this record?'))ajaxDelete('{{route('subject.delete',$subject->subject_id)}}','{{csrf_token()}}')" class="glyphicon glyphicon-trash btn btn-danger btn-sm" id="delete_subject"></a>
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

