<!DOCTYPE html>
<html lang="en">
    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <title>Newsletter System</title>
      
        <!-- Custom fonts for this template-->
        <link href="{{ asset('dashboard/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('frontend/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('frontend/css/floating-labels.css') }}" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
      
        <style>
           

            .bd-placeholder-img {
              font-size: 1.125rem;
              text-anchor: middle;
              -webkit-user-select: none;
              -moz-user-select: none;
              -ms-user-select: none;
              user-select: none;
            }

        
      
            @media (min-width: 768px) {
              .bd-placeholder-img-lg {
                font-size: 3.5rem;
              }
            }
          </style>
      </head>
<body>

        

    <form class="form-signin" action="{{ route('Subscribe') }}" method="POST">



            <div class="alert alert-success alert-dismissible fade show" id="successMSG" style="display:none;">
                <p style="text-align:center;font-weight:bold;">You Subscribed Successfully, Please Check Mail</p>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                </button>
              </div><br />

            <div class="alert alert-danger alert-dismissible fade show" id="errorMSG" style="display:none;">
                <p style="text-align:center;font-weight:bold;">Email Address is Required</p>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                </button>
              </div><br />
    
    
            <div class="alert alert-danger alert-dismissible fade show" id="failedMSG" style="display:none;">
                <p style="text-align:center;font-weight:bold;">You Already Subscribed</p>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
              </button>
            </div><br />


        @csrf
        <div class="text-center mb-4">
            <i class="fa fa-envelope" style="    color: #007bff;font-size: 100px;margin-bottom: 15px;"></i>
          <h1 class="h3 mb-3 font-weight-normal">Subscribe</h1>
        </div>
      

        <div class="form-label-group">
                <input type="email" id="email" name="email" class="form-control" placeholder="Email address" required >
                <label for="email">Email address</label>
              </div>
      
        
        <button class="btn btn-lg btn-primary btn-block subscribeBTN" type="submit">Subscribe</button>
        <p class="mt-5 mb-3 text-muted text-center">&copy; {{ date('Y') }} Newsletter System</p>
      </form>


    <script src="{{ asset('dashboard/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('dashboard/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <script>
        $(document).ready(function(){
          var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
          $(".subscribeBTN").click(function(e){
              e.preventDefault();
              if($("#email").val() == ''){
                $('#errorMSG').css('display','flex');
              }else{
                $('#errorMSG').css('display','none');

                $.ajax({
                  url: '{{ route("Subscribe") }}',
                  type: 'POST',
                  data: {_token: CSRF_TOKEN, email:$("#email").val()},
                  dataType: 'JSON',
                  success: function (data) { 
                      if(data.status == "success"){
                          $('#successMSG').css('display','flex');
                          $('#failedMSG').css('display','none');
                          $("#email").val("");
                      }else{
                        $('#successMSG').css('display','none');
                        $('#failedMSG').css('display','flex');
                      }
                  }
              }); 
              }
              
          });
     });    
    </script>

</body>
</html>