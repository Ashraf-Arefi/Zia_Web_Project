
<div class="col-md-12">
    <h3 style="text-align: center">{{isset($panel_title) ?$panel_title :''}}</h3>
    <table id="example" class="table table-striped table-bordered display" style="width:100%">
        <thead>
        <tr>
            <th>شماره</th>
            <th>نام کتاب</th>
            <th>تعداد کتاب</th>
            <th>عملیات</th>
        </tr>
        </thead>
        <tfoot>
        <tr>
            <th>شماره</th>
            <th>نام کتاب</th>
            <th>تعداد کتاب</th>
            <th>عملیات</th>
        </tr>
        </tfoot>
        <tbody>
        @foreach($books as $book)
            <tr>
                <td>{{$book->book_library_id}}</td>
                <td>{{$book->book_name}}</td>
                <td>{{$book->quantity}}</td>

                <td>
                    <a href="javascript:ajaxLoad('{{route('library.update',$book->book_library_id)}}')" class="glyphicon glyphicon-edit btn btn-primary btn-xs" id="edit_book"></a>

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






