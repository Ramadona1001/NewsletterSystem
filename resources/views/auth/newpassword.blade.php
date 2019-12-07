@extends('dashboard.layouts.auth')

@section('title',__('tr.Reset Password'))

@section('content')


@if(\App\Systems::count() > 0)
<style>
    .bg-login-image{
        background: url({{ asset(App\Systems::findOrfail(1)->logo) }});
        background-position: center;
        background-size: cover;
    }
</style>
@endif

<div class="row justify-content-center" style="margin-top:15%;">

        <div class="col-xl-10 col-lg-12 col-md-9">
  
          <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
              <!-- Nested Row within Card Body -->
              <div class="row">
                <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                <div class="col-lg-6">
                  <div class="p-5">
                    <div class="text-center">
                      <h1 class="h4 text-gray-900 mb-4">@lang('tr.Reset Password')</h1>
                    </div>
                    <form class="user" method="POST" action="{{ route('NewPasswordPost',$user->id) }}">
                        @csrf
                      <div class="form-group">
                            <input id="password" type="password" placeholder="@lang('tr.New Password')" style="border-radius: 60px; height: 50px; outline: none;" class="form-control @error('password') is-invalid @enderror" name="password" value="{{ old('password') }}" required autofocus>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                      </div>
                     
                      <button type="submit" class="btn btn-primary  btn-user btn-block">
                            {{ __('tr.Reset Password') }}
                        </button>

                    </form>
                    
                  </div>
                </div>
              </div>
            </div>
          </div>
  
        </div>
  
      </div>
    
@endsection