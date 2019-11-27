<div class="row">
    <div class="col-md-12">
        <h3 style="text-align: center">{{isset($panel_title) ?$panel_title :'لیست سالون ها'}}</h3>
    </div>
</div>

<div class="row">
    <div class="col-sm-12 col-md-12">
        {{-- start table section --}}
        <table id="example" class="table table-striped table-bordered display responsive" style="width:100%">
            <thead>
            <tr>
                <th>شماره</th>
                <th>نام کارت</th>
                <th>نام شاگرد</th>
                <th>هزینه کارت</th>
                <th>تاریخ</th>
                <th>عملیات</th>

            </tr>
            </thead>
            <tfoot>
            <tr>
                <th>شماره</th>
                <th>نام کارت</th>
                <th>نام شاگرد</th>
                <th>هزینه کارت</th>
                <th>تاریخ</th>
                <th>عملیات</th>


            </tr>
            </tfoot>
            <tbody>

            @foreach($student_card as $st_card)

                <tr>
                    <td>{{$st_card->student_card_id}}</td>
                    <td>{{$st_card->card_name}}</td>
                    <td>{{$st_card->first_name}} {{$st_card->last_name}}</td>
                    <td>{{$st_card->payment}}</td>
                    <td>{{$st_card->date}}</td>



                    <td colspan="2">
                        <a href="javascript:if(confirm('Are you want to delete this record?'))ajaxDelete('{{route('card.studentCardDelete',$st_card->student_card_id)}}','{{csrf_token()}}')"><i class=" glyphicon glyphicon-trash btn btn-danger btn-sm" ></i></a>
                        <a href="javascript:ajaxLoad('{{route('card.studentCardUpdate',$st_card->student_card_id)}}')"><i class="glyphicon glyphicon-edit btn btn-primary btn-sm"></i></a>
                    </td>

                </tr>

            @endforeach

            </tbody>
        </table>

    </div>
</div>





<script type="text/javascript">

    $(document).ready(function () {

        $('#example').dataTable();
    })


</script>

</div>

