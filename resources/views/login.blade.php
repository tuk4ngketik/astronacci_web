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
            <form method="post" action="login-act" id="form">
                @csrf
                <div class="card p-5 mt-5"> 
                        <div class="mb-3 text-center"> 
                            <h3>Astronacci</h3>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Alamat Email</label>
                            <input type="email" class="form-control"  name="email" required">
                            <div class="text text-danger email"></div>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Alamat Email</label>
                            <input type="password" class="form-control"  name="password" required">
                            <div class="text text-danger password"></div>
                        </div>
                        <div class="mb-3"> 
                            <input type="submit" class="btn btn-primary" id="submit" value="Login">
                        </div>
                </div>  
            </form>
        </div>
        <div class="col-sm-4"></div>
     </div>
    </div> 

    
  <script>
      const inputs = [ 'email','password' ]   
      $('#form').submit(function(e) { 
            e.preventDefault(); 
            var action = $(this).attr('action');
            var formData = $(this).serialize(); 
            _submitLoginFrom(action, formData,  inputs);    
      }); 

      
function _submitLoginFrom(action, formData,   objInput){   
  $('.text').text('') 
  $.ajax({
      type: 'POST', 
      url: action, 
      data: formData,
      dataType: 'JSON', 
      beforeSend: function() {
        $("input#submit").val('Proses ...');
         $("input#submit").attr('disabled','disable'); 
      }, 
      complete: function() {
          $("input#submit").val('Login');
           $("input#submit").removeAttr('disabled'); 
      }, 
      success: function(data) {   
            
        if(data.status == true){     
            alert(data.msg);
            location.href = '/';
            return;
        }  
       
        var d = data.data
        $(objInput).each(function(i){
            var k =  objInput[i]  
            $('.'+k).text('')
            if(d[k]){  
                $('.'+k).text(d[k])
            }
        })   
     }  
  })
  .fail(function(jqXHR, textStatus, errorThrown) {   
         alert('Maaf,\nTerjadi kesalahan !');
         location.href = '/';
    });    
}  

  </script>

</body>
</html>