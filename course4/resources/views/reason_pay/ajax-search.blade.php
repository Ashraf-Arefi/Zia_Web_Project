@extends('layout.master')
@section('content')
<body>
<div class="container box">
	<h3 align="center">Live search in laravel using AJAX</h3><br/>
	<div class="panel panel-default">
		<div class="panel-heading">Search Customer Data</div>
		<div class="panel-body">
			<div class="form-group">
				<input type="text" name="search" id="search" class="form-control"
				       placeholder="Search Customer Data"/>
			</div>
			<div class="table-responsive">
				<h3 align="center">Total Data : <span id="total_records"></span></h3>
				<table class="table table-striped table-bordered">
					<thead>
					<tr>
						<th>Customer Name</th>
						<th>Address</th>
						<th>City</th>
						<th>Postal Code</th>
						<th>Country</th>
					</tr>
					</thead>
					<tbody>
					
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
</body>
@endsection
@section('js')
	<script>
        $(document).ready(function(){

            fetch_customer_data();

            function fetch_customer_data(query = '')
            {
                $.ajax({
                    url:"{{ route('management.reason_pay.live_search') }}",
                    method:'GET',
                    data:{query:query},
                    dataType:'json',
                    success:function(data)
                    {
                        
                        $('tbody').html(data.table_data);
                        $('#total_records').text(data.total_data);
                        
                    }
                })
            }

            $(document).on('keyup', '#search', function(){
                var query = $(this).val();
                
                fetch_customer_data(query);
                
            });
        });
	</script>
@endsection