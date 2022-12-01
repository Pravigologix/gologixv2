
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
    <title>Dashboard</title>
</head>
<style>
    body {
  background-color: #fbfbfb;
}
.navbar-brand{
  padding-left: 25%;

}
@media (min-width: 991.98px) {
  main {
    padding-left: 260px;
  }
}

/* Sidebar */
.sidebar {
  position: fixed;
  top: 0;
  bottom: 0;
  left: 0;
  padding: 58px 0 0; /* Height of navbar */
  box-shadow: 0 2px 5px 0 rgb(0 0 0 / 5%), 0 2px 10px 0 rgb(0 0 0 / 5%);
  width:240px;
  z-index: 600;
}

@media (max-width: 991.98px) {
  .sidebar {
    width: 240px;
  }
}
.sidebar .active {
  border-radius: 5px;
  box-shadow: 0 2px 5px 0 rgb(0 0 0 / 16%), 0 2px 10px 0 rgb(0 0 0 / 12%);
}

.sidebar-sticky {
  position: relative;
  top: 0;
  height: calc(100vh - 48px);
  padding-top: 0.5rem;
  overflow-x: hidden;
  overflow-y: auto; /* Scrollable contents if viewport is shorter than content. */
}

.mainbody{
    /* left:50%;
     */
    padding-left: 280px;
}
</style>

<body >
<nav class="navbar navbar-light bg-light">


@include('admin.layouts.sidebars.vendor')




</nav>

<div class="mainbody">

<h1>Vendor</h1>



  
<div class="container">
   
  <table class="table table-bordered">
      <thead>
          <tr>
              <th>id</th>
              <th>ven_name</th>
              <th>ven_phone</th>
              <th>Email</th>
              <th>Status</th>
              <th>Action</th>


       
       
           
          </tr>
      </thead>
      <tbody>
          @if(!empty($vendor) && $vendor->count())
              @foreach($vendor as $key => $value)
                  <tr>
                      <td>{{ $value->id }}</td>
                      <td>{{ $value->name }}</td>
                      <td>{{ $value->phonenumber }}</td>
                      <td>{{ $value->email }}</td>
                      @if ($value->users_isverified==1)
                      <td>Verified</td>

                        
                      @else
                      <td>Not Verified</td>

                        
                      @endif
                      @if ($value->users_isactive==0)
                      <td>Active</td>

                        
                      @else
                      <td>InActive</td>

                        
                      @endif
                   


                      <td>
                        <form action="{{route('vendorbyid', ['id'=> $value->id ])}}" method="post">
                          @csrf
                          <button type="submit" class="btn btn-primary">View</button>
                        </form>/
                        @if ($value->users_isactive==0)
                        <form action="{{route('vendor-deactivate', ['id'=> $value->id ])}}" method="post">
                          @csrf
                          <button type="submit" class="btn btn-danger">De-Activate</button>
                        </form>
  
                          
                        @else
                        <form action="{{route('vendor-activate', ['id'=> $value->id ])}}" method="post">
                          @csrf
                          <button type="submit" class="btn btn-success">Activate</button>
                        </form>
  
                          
                        @endif
                       
                      </td>
                  </tr>
              @endforeach
          @else
              <tr>
                  <td colspan="10">There are no data.</td>
              </tr>
          @endif
      </tbody>
  </table>
       
</div>


{!! $vendor->links('pagination::bootstrap-4') !!}

</div>


    
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
</html>