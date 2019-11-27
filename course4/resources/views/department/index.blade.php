
<div class="col-md-12">
    <h3 style="text-align: center">{{isset($panel_title) ?$panel_title :''}}</h3>
    <table id="example" class="table table-striped table-bordered display" style="width:100%">
        <thead>
        <tr>
            <th>ادیِ</th>
            <th>نام دپارتمنت</th>
            <th>عملیات</th>
        
        </tr>
        </thead>
        <tfoot>
        <tr>
            <th>ادیِ</th>
            <th>نام دپارتمنت</th>
            <th>عملیات</th>

        </tr>
        </tfoot>
        <tbody>
        @foreach($department as $department)
            <tr>
                <td>{{$department->department_id}}</td>
                <td>{{$department->department_name}}</td>
                <td>
                    <a href="javascript:ajaxLoad('{{route('department.update',$department->department_id)}}')" class="glyphicon glyphicon-edit" id="edit_department" style="margin-left: 2%"></a>
                    <a href="javascript:if(confirm('Do you want delete this record?'))ajaxDelete('{{route('department.delete',$department->department_id)}}','{{csrf_token()}}')" class="glyphicon glyphicon-trash" id="delete_department"></a>
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

