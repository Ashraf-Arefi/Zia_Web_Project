
<div class="col-md-12">
    <h3 style="margin-right: 2%;text-align: center;">
        {{isset($panel_title) ?$panel_title :''}}
    </h3>
    <div class="row " >

    </div>

    <table id="example" class="table table-striped table-bordered display" style="width:100%">
        <thead>
        <tr>
            <th>شماره</th>
            <th>نام شاگرد</th>
            <th>کلاس</th>
            <th> مقدار پرداخت</th>
            <th>تاریخ</th>
            <th>توضیحات</th>
            <th>عملیات</th>

        </tr>
        </thead>
        <tfoot>
        <tr>
            <th>شماره</th>
            <th>نام شاگرد</th>
            <th>کلاس</th>
            <th> مقدار پرداخت</th>
            <th>تاریخ</th>
            <th>توضیحات</th>
            <th>عملیات</th>
        </tr>
        </tfoot>
        <tbody id="content-display">
        @foreach($giveCertificate as $key=> $c)
            <tr class="" >
                <td>{{++$key}}</td>
                <td>{{$c->first_name}} {{$c->last_name}}</td>
                <td>{{$c->class_name}}</td>
                <td>{{$c->payment}}</td>
                <td>{{$c->date}}</td>
                <td>{{$c->description}}</td>
                <td>

                    <a href="javascript:ajaxLoad('{{route('giveCertificate.update',$c->certificate_id)}}')" class="glyphicon glyphicon-edit btn btn-success btn-xs" id="edit_course"></a>
                    <a href="javascript:if(confirm('Do you want delete this record?'))ajaxDelete('{{route('giveCertificate.delete',$c->certificate_id)}}','{{csrf_token()}}')" class="glyphicon glyphicon-trash btn btn-danger btn-xs" id="delete_coures"></a>
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




