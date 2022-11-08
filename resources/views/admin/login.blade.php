<!DOCTYPE html>  
<html lang="en">  
  <head>  
     <title>Admin login</title>  
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"/>  
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">  
  </head>  
  <body>  

<div class="container">  

  <h1>Signin</h1>        
  <img src="face23.jpg" class="img-circle" alt="profile"  width="300" height="250">   


<form style="width:300px" action="/api/admin/welcome" method="POST">  
@csrf
  <div class="form-group">  
    <label for="email_address">Email address</label>  
    <input type="text" id="email_address" name="email" class="form-control"  placeholder="Email">  
  </div>  
  <div class="form-group">  
    <label for="password">Password</label>  
    <input type="password" id="password" name="password" class="form-control"  placeholder="Password">  
  </div>  
    
  <!-- <div class="form-check">
      <label class="form-check-label">
        <input class="form-check-input" type="checkbox"> Remember me
      </label>
    </div> -->
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</div>

  
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>  
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>  
</div>

  </body>  
</html>  
