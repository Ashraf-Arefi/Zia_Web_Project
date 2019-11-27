
<div class="col-md-12">
    <h3 style="text-align: center">{{isset($panel_title) ?$panel_title :''}}</h3>
    <table id="example" class="table table-striped table-bordered display" style="width:100%">
        <thead>
        <tr>
            <th>ادیِ</th>
            <th>عنوان کتاب</th>
            <th>نسخه کتاب</th>
            <th>قیمت کتاب</th>
            <th> دیپارتمنت</th>
            <th>عملیات</th>
        </tr>
        </thead>
        <tfoot>
        <tr>
            <th>ادیِ</th>
            <th>عنوان کتاب</th>
            <th>قیمت کتاب</th>
            <th>نسخه کتاب</th>
            <th> دیپارتمنت</th>
            <th>عملیات</th>
        </tr>
        </tfoot>
        <tbody>
        @foreach($books as $book)
            <tr>
                <td>{{$book->book_id}}</td>
                <td>{{$book->book_name}}</td>
                <td>{{$book->book_edition}}</td>
                <td>{{$book->book_price}}</td>
                <td>{{$book->department_name}}</td>
                <td>
                    <a href="javascript:ajaxLoad('{{route('book.update',$book->book_id)}}')" class="glyphicon glyphicon-edit btn btn-primary btn-xs" id="edit_book"></a>
                    <a href="javascript:if(confirm('Do you want delete this record?'))ajaxDelete('{{route('book.delete',$book->book_id)}}','{{csrf_token()}}')" class="glyphicon glyphicon-trash btn btn-danger btn-xs" id="delete_card"></a>
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






