
<h4 class="box-title" style="margin-bottom: 10px; text-align: center">
    {{isset($panel_title) ?$panel_title :''}}
</h4>


<div class="col-md-12">
    <table id="example" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
        <thead>
        <tr>
            <th >ای دی</th>
            <th >نام

            </th>

            <th >عملیات</th>


        </tr>
        </thead>
        <tbody>
            @foreach($user as $key=>$user)

                <tr>
                    <td>{{++$key}}</td>
                    <td>{{$user->position_name}}</td>

                    <td colspan="2">
                        <a href="javascript:if(confirm('Are you want to delete this record?'))ajaxDelete('{{route('position.delete',$user->position_id)}}','{{csrf_token()}}')"><i class=" glyphicon glyphicon-trash btn btn-danger btn-sm" ></i></a>
                        <a href="javascript:ajaxLoad('{{route('position.update',$user->position_id)}}')"><i class="glyphicon glyphicon-edit btn btn-primary btn-sm"></i></a>
                    </td>

                </tr>

                @endforeach
        </tbody>

    </table>
    <script>
       $(document).ready(function () {
           datatable();
       })
    </script>
</div>

