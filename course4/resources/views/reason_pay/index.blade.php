
<div class="col-md-12">
	<h3 style="text-align: center">
		{{isset($panel_title) ?$panel_title :''}}
	</h3>
	<table id="example" class="table table-striped table-bordered display" style="width:100%">
		<thead>
		<tr>
			<th>ادی</th>
			<th>نوع مصرف</th>
			<th>عملیات</th>
		
		</tr>
		</thead>
		<tfoot>
		<tr>
			<th>ادی</th>
			<th>نوع مصرف</th>
			<th>عملیات</th>
		
		</tr>
		</tfoot>
		<tbody>
		@foreach($reason_pays as $reason_pay)
			<tr>
				<td>{{$reason_pay->expense_reason_id}}</td>
				<td>{{$reason_pay->title}}</td>
				
				
				<td><a href="javascript:ajaxLoad('{{route('reason_pay.update',$reason_pay->expense_reason_id)}}')" class="glyphicon glyphicon-edit btn btn-primary btn-xs" style="margin-left: 3%;"></a>
					<a href="javascript:if(confirm('آیا میخواهدی حذف کنید؟؟')) ajaxDelete('{{route('reason_pay.delete',$reason_pay->expense_reason_id)}}','{{csrf_token()}}')" class=" glyphicon glyphicon-trash btn btn-danger btn-xs" ></a>
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







