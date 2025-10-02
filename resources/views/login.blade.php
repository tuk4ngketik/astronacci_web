<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap5/bootstrap.min.css') }}">
    
    <script src="{{ asset('plugins/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap5/bootstrap.bundle.min.js') }}"></script>
</head>
<body>


    <div class="container">
     <div class="row">
        <div class="col-sm-4"></div>
        <div class="col-sm-4">
            <form method="post" action="login-act">
            <div class="card p-5 mt-5"> 
                    <div class="mb-3 text-center"> 
                        <h3>Astronacci</h3>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Alamat Email</label>
                        <input type="email" class="form-control" id="email" name="email" required autofocus value="{{ old('email') }}">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Alamat Email</label>
                        <input type="password" class="form-control" id="password" name="password" required autofocus value="{{ old('email') }}">
                    </div>
                    <div class="mb-3"> 
                        <input type="submit" class="btn btn-primary" value="Login">
                    </div>
            </div>  
            </form>
        </div>
        <div class="col-sm-4"></div>
     </div>
    </div> 

    <script src="{{ asset('js/app.js') }}"></script> 

</body>
</html>