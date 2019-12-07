@extends('dashboard.layouts.master')

@section('title',__('tr.Edit Profile'))

@section('stylesheet')

@endsection

@section('content')

<form style="padding:20px;" action="{{ route('MyProfileUpdate') }}" method="POST">

    @csrf
	<div class="form-group row">
		<label class="col-sm-12 col-md-2 col-form-label">@lang('tr.Name')</label>
		<div class="col-sm-12 col-md-10">
			<input class="form-control" type="text" value="{{ $user->name }}" placeholder="@lang('tr.Name')" name="name" required>
		</div>
	</div>
	<div class="form-group row">
		<label class="col-sm-12 col-md-2 col-form-label">@lang('tr.Email')</label>
		<div class="col-sm-12 col-md-10">
			<input class="form-control" value="{{ $user->email }}" placeholder="@lang('tr.Email')" type="email" name="email" required>
		</div>
	</div>

    <div class="form-group row">
            <label class="col-sm-12 col-md-2 col-form-label">@lang('tr.Roles')</label>
            <div class="col-sm-12 col-md-10 checkbox-group required">
                {{--  all roles belongs to this user  --}}
                @foreach ($user->roles as $user_role) 
                    <span style="border:1px solid #6e707e61;border-radius:5px;padding:5px;margin-right:5px;">
                        <input type="checkbox" name="role_id[]" id="role" value="{{ $user_role->id }}" checked>&nbsp;{{ $user_role->name }}
                    </span>
                @endforeach
                {{--  all roles belongs to this user  --}}
                @foreach ($roles as $role)
                    <span style="border:1px solid #6e707e61;border-radius:5px;padding:5px;margin-right:5px;">
                        <input type="checkbox" name="role_id[]" id="role" value="{{ $role->id }}" >&nbsp;{{ $role->name }}
                    </span>   
                @endforeach
                <br><br>
                <span class="errorRole" style="color:red;">@lang('tr.Please Choose One Role at Least')</span>
        </div>
        </div>

        <hr>
        <div class="form-group row">
            <h6 style="font-weight:bold;">@lang('tr.Password If You Want To Update')</h6>
        </div>

        <div class="form-group row">
            <label class="col-sm-12 col-md-2 col-form-label">@lang('tr.Password')</label>
            <div class="col-sm-12 col-md-10">
                <input class="form-control" placeholder="@lang('tr.Password')" type="password" name="password">
            </div>
        </div>


        

        <hr>
        <div class="form-group row">
            <input type="submit" value="@lang('tr.Save')" class="btn btn-primary col-sm-12 col-md-2">
        </div>

</form>







@endsection

@section('javascript')

<script>
    $(document).ready(function(){
        $('.errorRole').hide();
        $('form').submit(function(){
            if($('div.checkbox-group.required :checkbox:checked').length > 0){
                $('.errorRole').hide();
                return true;
            }else{
                $('.errorRole').fadeIn();
                return false;
            }
        });
    });
</script>

@endsection
