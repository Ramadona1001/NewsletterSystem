@extends('dashboard.layouts.auth')

@section('title',__('tr.Forget Password'))

@section('content')


<style>
    .bg-login-image{
        background: url({{ asset('dashboard/system/newsletter.png') }});
        background-position: center;
        background-size: 400px 250px;
        background-repeat: no-repeat;
    }
</style>

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
                      <h1 class="h4 text-gray-900 mb-4">@lang('tr.Forget Password')</h1>
                    </div>
                    <form class="user" method="POST" action="{{ route('ForgetPasswordPost') }}">
                        @csrf
                      <div class="form-group">
                            <input id="email" type="email" placeholder="@lang('tr.Email')" style="border-radius: 60px; height: 50px; outline: none;" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                      </div>
                     
                      <button type="submit" class="btn btn-primary  btn-user btn-block">
                            {{ __('tr.Forget Password') }}
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