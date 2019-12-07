@extends('dashboard.layouts.master')

@section('title','Subscribers')

@section('stylesheet')

<link rel="stylesheet" type="text/css" href="{{ asset('dashboard/css/jquery.dataTables.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('dashboard/css/buttons.dataTables.min.css') }}">


@endsection

@section('content')

<form action="{{ route('SendSubscribesMails') }}"  id="myform">
	<button type="submit" class="btn btn-success sentSubManyMails"><i class="fa fa-envelope"></i> Send Mail To All Check</button>
	<br>
	<hr>

	<div class="col-lg-12">
		<table id="example" class="display" style="width:100%">
			<thead>
				<tr>
					<th>Email</th>
					<th>Status</th>
					<th>Subscribe At</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
                @foreach ($subscribes as $subscribe)
                    <tr>
						<td>{{ $subscribe->email }}</td>
						<td>@if($subscribe->status == 1) Subscribed @else Not Subscribed @endif</td>
						<td>{{ $subscribe->created_at }}</td>
						<td>
								<button title="Send Mail" data-id="{{ $subscribe->id }}"  href="{{ route('SendSubscribesMail',$subscribe->id) }}" class="btn btn-warning subscribeBTN" style="border-radius: 0;font-weight: bold;font-size: 10px;"><i class="fa fa-envelope"></i></button>
								<input type="checkbox" name="subscribers[]" value="{{ $subscribe->id }}" id="sendMailCheck" class="chBox" onclick='checkRequired("chBox")' required>
                        </td>
                    </tr>
					@endforeach
			</tbody>
			<tfoot>
				<tr>
					<th>Email</th>
					<th>Status</th>
					<th>Subscribe At</th>
					<th>Action</th>
				</tr>
			</tfoot>
		</table>
	</form>
	</div>





@endsection

@section('javascript')

<script src="{{ asset('dashboard/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('dashboard/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('dashboard/js/buttons.flash.min.js') }}"></script>
<script src="{{ asset('dashboard/js/jszip.min.js') }}"></script>
<script src="{{ asset('dashboard/js/pdfmake.min.js') }}"></script>
<script src="{{ asset('dashboard/js/vfs_fonts.js') }}"></script>
<script src="{{ asset('dashboard/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('dashboard/js/buttons.print.min.js') }}"></script>

<script>
	$(document).ready(function() {
		$('#example').DataTable( {
			dom: 'Bfrtip',
			buttons: [
				'copy', 'csv', 'excel', 'pdf', 'print'
			]
		} );
	} );
</script>

<script>
		function checkRequired(elClass) {
            el=document.getElementsByClassName(elClass);

            var atLeastOneChecked=false;//at least one cb is checked
            for (i=0; i<el.length; i++) {
                if (el[i].checked === true) {
                    atLeastOneChecked=true;
                }
            }

            if (atLeastOneChecked === true) {
                for (i=0; i<el.length; i++) {
                    el[i].required = false;
                }
            } else {
                for (i=0; i<el.length; i++) {
                    el[i].required = true;
                }
            }
        }
</script>

<script>
        $(document).ready(function(){
		  var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
		  var sendMailUrl = '{{ route("SendSubscribesMail","#id") }}';
		  var subscribeCheckBtns = "$('.subscribeRow#id').hide()";
          $(".subscribeBTN").click(function(e){
              e.preventDefault();
              $.ajax({
                  url: sendMailUrl.replace('#id',$(this).data("id")),
                  type: 'GET',
                  data: {_token: CSRF_TOKEN},
                  dataType: 'JSON',
                  success: function (data) { 
                      if(data.status == "success"){
						  alert('Mail Sent Successfully');
                      }else{
                        alert('Failed');
                      }
                  }
              }); 
		  });
		  

		  $(".sentSubManyMails").on('click',function(e){
			e.preventDefault();
			$.ajax({
				url: '{{ route("SendSubscribesMails") }}',
				type: 'GET',
				data: {"subscribes":$('#myform').serialize()},
				dataType: 'JSON',
				success: function (data) { 
					if(data.status == "success"){
						alert('Mails Sent');
						$('input[type=checkbox]').prop('checked',false);
					}else{
					  alert('Failed');
					}
				}
			}); 
		});
     });    
    </script>

@endsection
