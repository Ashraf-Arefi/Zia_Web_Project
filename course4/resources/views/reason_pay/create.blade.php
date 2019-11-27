@extends('layout.master')
@section('content')
  <div id="container">
	 
  </div>
    @stop
@section('js')
  <script >
    /*
    $(document).on('click','#create_reason', function(){
      
      $.ajax({
        url: "{{ route('management.reason_pay.create') }}",
        type: "GET", // not POST, laravel won't allow it
        success: function(data){
          
          $data = $(data); // the HTML content your controller has produced
          $('#container').fadeOut().html($data).fadeIn();
          
        }
      });
    });
    */
  </script>
@endsection
