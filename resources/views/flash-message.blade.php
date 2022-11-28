<?php
  $alert = "";
  if ($message = Session::get('success')) {
    $alert = "alert-success";
    $flash = session('success');
  } elseif ($message = Session::get('error')) {
    $alert = "alert-danger";
    $flash = session('error');
  } elseif ($message = Session::get('warning')) {
    $alert = "alert-warning";
    $flash = session('warning');
  } elseif ($message = Session::get('info')) {
    $alert = "alert-info";
    $flash = session('info');
  }  
?>

@if ($message = Session::get('success') || $message = Session::get('error') || $message = Session::get('warning') || $message = Session::get('info'))
<div class="alert {{ $alert }} alert-dismissible fade show" role="alert">
  <strong>{{ $flash }}</strong>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
