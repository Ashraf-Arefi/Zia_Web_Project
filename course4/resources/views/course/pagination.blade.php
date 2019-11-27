
<div class="container">

    <div id="table_data">
        @include('course.studentScoreList')

    </div>

</div>

<script>
    $(document).ready(function(){
        //$('#example').dataTable();

        $(document).on('click', '.pagination a', function(event){
            event.preventDefault();
            var page = $(this).attr('href').split('page=')[1];
            fetch_data(page);
        });

        function fetch_data(page)
        {
            $.ajax({
                url:"giveScore/fetch_data?page="+page,
                success:function(data)
                {
                    $('#table_data').html(data);
                    //$('#example').dataTable();
                }
            });
        }



    });
</script>
