
<div class="col-md-12">
    <h3 style="text-align: center">{{isset($panel_title) ?$panel_title :''}}</h3>
    <table id="example" class="table table-striped table-bordered display" style="width:100%">
        <thead>
        <tr>
            <th>ادیِ</th>
            <th>نام کارت</th>
            <th> قیمت کارت</th>
            <th>دپارتمنت</th>
            <th>عملیات</th>
        
        </tr>
        </thead>
        <tfoot>
        <tr>
            <th>ادیِ</th>
            <th>نام کارت</th>
            <th> قیمت کارت</th>
            <th>دپارتمنت</th>
            <th>عملیات</th>
        
        </tr>
        </tfoot>
        <tbody>

        @foreach($cards as $card)
            <tr>
                <td>{{$card->card_id}}</td>
                <td>{{$card->card_name}}</td>
                <td>{{$card->card_price}}</td>
                <td>{{$card->department_name}}</td>

                <td>
                    <a href="javascript:ajaxLoad('{{route('card.update',$card->card_id)}}')" class="glyphicon glyphicon-edit btn btn-primary btn-xs" id="edit_card" style="margin-left: 3%"></a>
                    <a href="javascript:if(confirm('Do you want delete this record?'))ajaxDelete('{{route('card.delete',$card->card_id)}}','{{csrf_token()}}')" class="glyphicon glyphicon-trash btn btn-danger btn-xs" id="delete_card"></a>
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




