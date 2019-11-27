@extends('layout.master')
@section('content')
	<div class="container">
		
		<div class="starter-template" style="align-text:center">
			<h1>Laravel Search Autocomplete</h1>
			<br>
			<input type="text" id="search" placeholder="Type to search users" autocomplete="off" >
		</div>
	
	</div>

@endsection
@section('js')
	<script src="/js/typeahead.bundle.js"></script>
	<script type="text/javascript">
        $(document).ready(function() {
            var bloodhound = new Bloodhound({
                datumTokenizer: Bloodhound.tokenizers.whitespace,
                queryTokenizer: Bloodhound.tokenizers.whitespace,
                remote: {
                    url: '/management/reason_pay/search',
                    wildcard: '%QUERY%'
                },
            });

            $('#search').typeahead({
                hint: true,
                highlight: true,
                minLength: 1
            }, {
                name: 'reason_pay',
                source: bloodhound,
                display: function(data) {
                    return data.name  //Input value to be set when you select a suggestion.
                },
                templates: {
                    empty: [
                        '<div class="list-group search-results-dropdown"><div class="list-group-item">Nothing found.</div></div>'
                    ],
                    header: [
                        '<div class="list-group search-results-dropdown">'
                    ],
                    suggestion: function(data) {
                        return '<div style="font-weight:normal; margin-top:-10px ! important;" class="list-group-item">' + data.title + '</div></div>'
                    }
                }
            });
        });
	</script>
	@endsection