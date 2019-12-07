@extends('dashboard.layouts.master')

@section('title',__('tr.Contacts'))

@section('stylesheet')

<link rel="stylesheet" type="text/css" href="{{ asset('dashboard/css/jquery.dataTables.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('dashboard/css/buttons.dataTables.min.css') }}">


@endsection

@section('content')




	<div class="col-lg-12">
		<table id="example" class="display" style="width:100%">
			<thead>
				<tr>
					<th>@lang('tr.Name')</th>
					<th>@lang('tr.Email')</th>
					<th>@lang('tr.Subject')</th>
					<th>@lang('tr.Message')</th>
					<th>@lang('tr.Sent At')</th>
					<th>@lang('tr.Action')</th>
				</tr>
			</thead>
			<tbody>
                @foreach ($contacts as $contact)
                    <tr>
						<td>{{ $contact->name }}</td>
						<td>{{ $contact->email }}</td>
						<td>{{ $contact->subject }}</td>
						<td>{{ $contact->content }}</td>
						<td>{{ $contact->created_at }}</td>
						<td>
							<a title="@lang('tr.Send Message')" data-toggle="modal" data-target="#exampleModal" data-id="{{ $contact->id }}" data-name="{{ $contact->name }}" data-email="{{ $contact->email }}" href="{{ route('EditPages',$contact->id) }}" class="btn btn-primary sendMessageBtn" style="border-radius: 0;font-weight: bold;font-size: 10px;"><i class="fa fa-reply"></i></a>
                        </td>
                    </tr>
					@endforeach
			</tbody>
			<tfoot>
                <tr>
                    <th>@lang('tr.Name')</th>
					<th>@lang('tr.Email')</th>
					<th>@lang('tr.Subject')</th>
					<th>@lang('tr.Message')</th>
					<th>@lang('tr.Sent At')</th>
					<th>@lang('tr.Action')</th>
                </tr>
			</tfoot>
		</table>
	</div>


@include('dashboard.modals.sendMessage')


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
    
    $('.sendMessageBtn').on('click',function(){
        $('.emailTxt').text('To: '+$(this).attr("data-email"));
        $('.toemail').val($(this).attr("data-email"));
        $('.toname').val($(this).attr("data-name"));
    });
</script>

@endsection
