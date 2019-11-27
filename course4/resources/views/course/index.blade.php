
<div class="col-md-12">
    <h3 style="margin-right: 2%;text-align: center;">
        {{isset($panel_title) ?$panel_title :''}}
    </h3>
    <div class="row " >

    </div>

    <table id="example" class="table table-striped table-bordered display" style="width:100%">
        <thead>
        <tr>

            <th>مضمون</th>
            <th>استاد</th>
            <th> اتاق</th>
            <th> زمان شروع</th>
            <th> زمان ختم</th>
            <th> تاریخ شروع</th>
            <th>حالت کلاس</th>
            <th>عملیات</th>
        
        </tr>
        </thead>
        <tfoot>
        <tr>

            <th>مضمون</th>
            <th>استاد</th>
            <th> اتاق</th>
            <th> زمان شروع</th>
            <th> زمان ختم</th>
            <th> تاریخ شروع</th>
            <th>حالت کلاس</th>
            <th>عملیات</th>
        </tr>
        </tfoot>
        <tbody id="content-display">
        @foreach($courses as $course)
            <tr class="" >

                <td>{{$course->class_name}}</td>
                <td>{{$course->first_name}} {{$course->last_name}}</td>
                <td>
                    اتاق :
                    {{ $course->room_name}}

                </td>
                <td>{{$course->start_time}}</td>
                <td>{{$course->end_time}}</td>
                <td>{{$course->start_date}}</td>
                <td>{{$course->class_status}}</td>
                <td >

                    <a href="javascript:ajaxLoad('{{route('student.studentWithNoCertificate',$course->class_id)}}')" class="btn btn-info btn-xs" id="show_student">نمایش شاگردان</a>
                    <a href="javascript:ajaxLoad('{{route('course.update',$course->class_id)}}')" class="glyphicon glyphicon-edit btn btn-success btn-xs" id="edit_course"></a>
                    <a href="javascript:if(confirm('Do you want delete this record?'))ajaxDelete('{{route('course.delete',$course->class_id)}}','{{csrf_token()}}')" class="glyphicon glyphicon-trash btn btn-danger btn-xs" id="delete_coures"></a>
                </td>

            </tr>
        @endforeach
        {!! $courses->links() !!}
        </tbody>
    </table>
    <script>
        
        $(document).ready(function () {
            
            //$('#example').dataTable();
        })
    </script>
    <script>

        $(document).ready(function () {

            // var s = $("#class-all").val();


            $("#class-selection").change(function () {

                var cl = $(this).val();

                $.ajax({
                    type: "get",
                    url: "course/filter/"+cl,
                    contentType: false,
                    success: function (data) {
                        //$('#example').html(data.table_data);
                        $('#example tbody').html(data.table_data);

                        if ( $.fn.dataTable.isDataTable('#example' ) ) {
                            table = $('#example').DataTable();
                            table.destroy();

                        }
                        else {
                            table = $('#example').DataTable({

                                //paging: false,
                                dom: 'Bfrtip',
                                buttons: [
                                    'copy', 'csv', 'excel', 'pdf', 'print'
                                ],
                                destroy: true,
                                retrieve: true,
                            });
                        }



                    },
                    error: function (xhr, status, error) {
                        alert(xhr.responseText);
                    }
                });



            });

        })


//change status class
        $(document).ready(function () {

            $(".class_status").change(function () {

                var form_data = $(#status_form).serialize();

                $.ajax({
                    type: "get",
                    url: "course/change_status/",
                    data:form_data,
                    contentType: false,
                    success: function (data) {
                       // $("#content").html(data);
                        alert("حالت کلاس به موفقت تغیرکرد");
                    },
                    error: function (xhr, status, error) {
                        alert(xhr.responseText);
                    }
                });



            });

        })

    </script>

</div>




