
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
@include('admin.layouts.sidebars.vendor')
</nav>

    <div class="mainbody">
        <div>
            <div class="fw-bold h3">Vendor Details</div>
            @foreach($vendor as $key => $value)
            <div class="row mb-2">
                <div class="col-2 me-5">Name </div>
                <div class="col fw-bold"><span class="me-3">:</span>  {{ $value->name }}</div>
            </div>
            <div class="row mb-2">
                <div class="col-2 me-5">Email </div>
                <div class="col fw-bold"><span class="me-3">:</span>  {{ $value->email }}</div>
            </div>
            <div class="row mb-2">
                <div class="col-2 me-5">Phone number </div>
                <div class="col fw-bold"><span class="me-3">:</span>  {{ $value->phonenumber }}</div>
            </div>
            @endforeach
        </div>
        <div class="mt-4">
            <div class="fw-bold h3">KYC Details</div>
            @if($kyc->count() > 0)
            @foreach($kyc as $key => $value)
            <div class="row mb-2">
                <div class="col-2 me-5">{{ $value->venkyc_docname }} </div>
                <div class="col fw-bold"><span class="me-3">:</span>{{ $value->venkyc_docnumber }}</div>
            </div>
            {{-- <div class="row mb-2">
                <div class="col-2 me-5">Email </div>
                <div class="col fw-bold"><span class="me-3">:</span>{{ $value->email }}</div>
            </div>
            <div class="row mb-2">
                <div class="col-2 me-5">Phone number </div>
                <div class="col fw-bold"><span class="me-3">:</span>{{ $value->phonenumber }}</div>
            </div> --}}
            @endforeach
            @else
            <div class="fw-bold text-secondary mt-3 ms-5">
                KYC data not found / Not added by Vendor
            </div>
            @endif
        </div>
        <div class="mt-4">
            <div class="fw-bold h3">Account Details</div>
            @if($account_details->count() > 0)
            @foreach($account_details as $key => $value)
            <div class="row mb-2">
                <div class="col-2 me-5">Account holder name </div>
                <div class="col fw-bold"><span class="me-3">:</span>{{ $value->venacc_name }}</div>
            </div>
            <div class="row mb-2">
                <div class="col-2 me-5">Account number </div>
                <div class="col fw-bold"><span class="me-3">:</span>{{ $value->venacc_account_no }}</div>
            </div>
            <div class="row mb-2">
                <div class="col-2 me-5">IFSC code </div>
                <div class="col fw-bold"><span class="me-3">:</span>{{ $value->venacc_ifsc }}</div>
            </div>
            <div class="row mb-2">
                <div class="col-2 me-5">Bank name</div>
                <div class="col fw-bold"><span class="me-3">:</span>{{ $value->venacc_bank_name }}</div>
            </div>
            @endforeach
            @else
            <div class="fw-bold text-secondary mt-3 ms-5">
                Account data not found / Not added by Vendor
            </div>
            @endif
        </div>
        {{-- Verify button --}}
        <div class="mt-4">
            @if($kyc->count() > 0 && $account_details->count() > 0)
                <button class="btn btn-primary w-25">Verify</button>
            @endif
        </div>
    </div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
</html>