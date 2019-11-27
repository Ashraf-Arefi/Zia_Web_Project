<div class="col-md-12">
    <h3 style="text-align: center">{{$panel_title}}</h3>
    <table id="example" class="table table-striped table-bordered display" style="width:100%">
        <thead>
        <tr>
            <th>ادیِ</th>
            <th> طبقه</th>
            <th> نام اطاق </th>
            <th>عملیات</th>
        
        </tr>
        </thead>
        <tfoot>
        <tr>
            <th>ادیِ</th>
            <th> طبقه</th>
            <th> نام اطاق </th>
            <th>عملیات</th>
        </tr>
        </tfoot>
        <tbody>
        @foreach($rooms as $room)
            <tr>
                <td>{{$room->room_id}}</td>
                <td>{{$room->room_floor}}</td>
                <td>{{$room->room_name}}</td>
                <td>
                    <a href="javascript:ajaxLoad('{{route('room.update',$room->room_id)}}')" class="glyphicon glyphicon-edit" id="edit_room" style="margin-left: 3%"></a>
                    <a href="javascript:if(confirm('واقعامیخواهید حذف کنید؟؟'))ajaxDelete('{{route('room.delete',$room->room_id)}}','{{csrf_token()}}')" class="glyphicon glyphicon-trash" id="delete_room"></a>
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

