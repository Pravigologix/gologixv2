
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
    padding-left: 240px;
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
    width: 30%;
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
    padding-left: 260px;
}
</style>

<body >
<nav class="navbar navbar-light bg-light">


@include('admin.layouts.sidebars.users')




</nav>

<div class="mainbody">

<h1>Users</h1>


   




<div class="container">
   
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>id</th>
                <th>Name</th>
                <th>Phone Number</th>
                <th>Email</th>
                <th>Created at</th>

                <!-- <th></th>
                <th>Payment Status</th>
                <th>Payment At</th> -->





                <!-- <th width="300px;">Action</th> -->
            </tr>
        </thead>
        <tbody>
            @if(!empty($users) && $users->count())
                @foreach($users as $key => $value)
                    <tr>
                        <td>{{ $value->id }}</td>
                        <td>{{ $value->name }}</td>
                        <td>{{ $value->email }}</td>
                        <td>{{ $value->phonenumber }}</td>

                       
                       
                        <td>{{ $value->created_at }}</td>
                      

                        <!-- <td>
                            <button class="btn btn-danger">Delete</button>
                        </td> -->
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="10">There are no data.</td>
                </tr>
            @endif
        </tbody>
    </table>
         
    {!! $users->links('pagination::bootstrap-4') !!}
</div>




    </div>
  


   
  






    
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
</html>