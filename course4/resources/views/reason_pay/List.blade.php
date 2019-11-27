@foreach($reasons as $rs)
	<tr>
		<td>{{ $rs->reson_pay_id }}</td>
		<td>{{ $rs->title }}</td>
		<td>
			<a href="#" class="btn btn-success btn-xs" id="edit" data-id="{{$rs->id }}">Edit</a>
			<a href="#" class="btn btn-danger btn-xs" id="del" data-id="{{$rs->id }}">Delete</a>
		</td>
	</tr>
	@endforeach