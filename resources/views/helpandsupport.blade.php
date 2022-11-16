<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"> -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <!--Stylesheet-->
    <title>Help and support</title>
</head>
<body>
    <h1>Help and support

    </h1>
    <div class="container">


    <form class="form-horizontal" action="{{route('postsupport')}}" method="POST">

    @if (session()->has('Sucess'))
        <div class="alert alert-success">
            {{session()->get('Sucess')}}

        </div>

            
        @endif
  
   {{ csrf_field() }}
      
  <div class="form-group" >
   <label for="Name">Name: </label>
   <input type="text" class="form-control" id="name" placeholder="Name" name="name" required>
  </div>
  <div class="form-group">
   <label for="email">Email: </label>
   <input type="text" class="form-control" id="email" placeholder="Email" name="email" required>
  </div>
  <div class="form-group">
   <label for="phonenumber">Phonenumber: </label>
   <input type="number" class="form-control" id="phonenumber" placeholder="Number" name="phonenumber" required>
  </div>
  <div class="form-group">
   <label for="message">Message: </label>
   <textarea type="text" class="form-control" id="message" placeholder="Enter your message here" name="message" required> </textarea>
  </div>
  <div class="form-group">
    <button type="submit" class="btn btn-primary" value="Send">Send</button>
  </div>
    
</form>
</div>
    
</body>
</html>