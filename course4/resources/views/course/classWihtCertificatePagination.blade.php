
<div class="container">

    <div id="table_data">
        @include('course.classWithCertificateList')

    </div>

</div>




<script >

    $(document).on('click', '.pagination a', function(event){
        event.preventDefault();
        var page = $(this).attr('href').split('page=')[1];
        getCertificateClass(page);
    });

    function getCertificateClass(page)
    {
        $.ajax({
            url:"course/getCertificateClass?page="+page,
            success:function(data)
            {
                $('#table_data').html(data);
                //$('#example').dataTable();
            }
        });
    }
</script>