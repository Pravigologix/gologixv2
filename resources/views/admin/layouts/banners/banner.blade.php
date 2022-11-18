
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
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
    padding-left: 30%;
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
@include('admin.layouts.sidebars.banner')
</nav>

<div class="mainbody">

<div class="row">
  <div class="col-8">
    <h1>Banners</h1>
  </div>
  <div class="col-4">
    <div>
      <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addBannerModal">Add Banner</button>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="addBannerModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Banner</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form action="{{route('addbanner')}}" method="POST" enctype="multipart/form-data">
            {{csrf_field()}}
            <div class="modal-body">
                <input type="file" name="banner_image_url" id="banner_image_url" class="form-control mb-3" >

                <input type="text" name="banner_descprition" id="banner_descprition" class="form-control" placeholder="Banner Description">
                {{-- <button type="submit" class="btn btn-success mt-3">Delete </button> --}}
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
              <button type="submit" class="btn btn-success">Add Banner</button>
            </div>
        </form>
        </div>
      </div>
    </div>
  </div> 
</div>
<div class="container">
   
  <table class="table table-bordered">
      <thead>
          <tr>
            <th>Banners</th>
            <th>Description</th>
            <th>action</th>
          </tr>
      </thead>
      <tbody>
        
        @foreach($banners as $key => $value)
            <tr>
                <td><img src="{{ $value->banner_image_url }}" height="100" alt="{{ $value->banner_image_url }}"></td>
                <td>{{ $value->banner_descprition }}</td>
              <td>
                <div>
                  <div>
                    <button type="button"  class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal"><i class="material-icons" style="font-size:20px">delete</i></button>
                  </div>
                  <!-- Modal -->
                  <div class="modal fade" id="deleteModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Alert</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          Do you want delete banner.
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                          <form method="GET" action="{{route('deletebanner', ['id'=> $value->id ])}}">
                            @csrf
                            <button type="submit" class="btn btn-danger">Delete </button>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>     
              </td> 
            </tr>
        @endforeach

</tbody>
</table>
</div>

<div class="row mt-5">
  <div class="col-8">
    <h1>Banners Videos</h1>
  </div>
  <div class="col-4">
    <div>
      <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addBannerVideoModal">Add Banner Video</button>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="addBannerVideoModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Banner Video</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form action="{{route('addvideo')}}" method="POST" enctype="multipart/form-data">
            {{csrf_field()}}
            <div class="modal-body">
                <input type="file" name="clip_url" id="clip_url" class="form-control mb-3" >
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
              <button type="submit" class="btn btn-success">Add Banner Video</button>
            </div>
        </form>
        </div>
      </div>
    </div>
  </div> 
</div>
<div class="container">
   
  <table class="table table-bordered">
      <thead>
          <tr>
            <th>Banners video</th>
            <th>action</th>
          </tr>
      </thead>
      <tbody>
        
        @foreach($videoclip as $key => $value)
            <tr>
                <td>
                  <video width="400" height="240" controls>
                    <source src="{{ $value->clip_url }}" type="video/mp4">
                    <source src="{{ $value->clip_url }}" type="video/ogg">
                    Your browser does not support the video tag.
                  </video>
                </td>
              <td>
                <div>
                  <div>
                    <button type="button"  class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteBanVideoModal"><i class="material-icons" style="font-size:20px">delete</i></button>
                  </div>
                  <!-- Modal -->
                  <div class="modal fade" id="deleteBanVideoModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Alert</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          Do you want delete banner video.
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                          <form method="POST" action="{{route('deletevideo', ['id'=> $value->id ])}}">
                            @csrf
                            <button type="submit" class="btn btn-danger">Delete </button>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>     
              </td> 
            </tr>
        @endforeach

</tbody>
</table>
</div>

</div>
  






    
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
</html>