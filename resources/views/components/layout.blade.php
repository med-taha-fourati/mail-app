<!DOCTYPE html>
<html lang="en">
<head>
<title>W3.CSS Template</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link href='https://fonts.googleapis.com/css?family=RobotoDraft' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"><style>
html,body,h1,h2,h3,h4,h5 {font-family: "RobotoDraft", "Roboto", sans-serif}
.w3-bar-block .w3-bar-item {padding: 16px}
</style>
</head>
<body>
<?php 
  if ($mail == null || $mail->count() == 0) $mail_attrib = [];
  $num_mails = $mail->where(
    'to', '=', auth()->user()->email
    //['trash_id', null]
  )->where('trash_id', 'is', null)->count();
  $selected_attrib = [];
  //dd($num_mails);
?>

<!-- Side Navigation -->
<nav class="w3-sidebar w3-bar-block w3-collapse w3-white w3-animate-left w3-card" style="z-index:3;width:320px;" id="mySidebar">
  <a href="javascript:void(0)" class="w3-bar-item w3-button w3-border-bottom w3-large"><img src="https://www.w3schools.com/images/w3schools.png" style="width:60%;"></a>
  <form action="{{ route('auth.logout', '') }}" method="post">
    @csrf
    @method('POST')
    <button class="w3-bar-item w3-button w3-border-bottom w3-large" type="submit">{{Str::limit(auth()->user()->name, 25)}}, Logout</button>
  </form>

  <a href="javascript:void(0)" class="w3-bar-item w3-button w3-dark-grey w3-button w3-hover-black w3-left-align" onclick="document.getElementById('id01').style.display='block'">New Message <i class="w3-padding fa fa-pencil"></i></a>
  
  <!-- Inbox -->
  <a id="myBtn" onclick="myFunc('Demo1')" href="javascript:void(0)" class="w3-bar-item w3-button"><i class="fa fa-inbox w3-margin-right"></i>Inbox ({{ $num_mails }})<i class="fa fa-caret-down w3-margin-left"></i></a>
  <div id="Demo1" class="w3-hide w3-animate-left"><!--onclick="myFunc('Demo1')"-->
     @include('mail.mails')
  </div>

  <!-- Sent -->
  <a id="myBtn" onclick="myFunc('Demo3')" href="javascript:void(0)" class="w3-bar-item w3-button"><i class="fa fa-paper-plane w3-margin-right"></i>Sent<i class="fa fa-caret-down w3-margin-left"></i></a>
  <div id="Demo3" class="w3-hide w3-animate-left">
    @include('mail.sent')
  </div>
  
  <!-- Drafts -->
  <a id="myBtn" onclick="myFunc('Demo4')" href="javascript:void(0)" class="w3-bar-item w3-button"><i class="fa fa-hourglass-end w3-margin-right"></i>Drafts<i class="fa fa-caret-down w3-margin-left"></i></a>
  <div id="Demo4" class="w3-hide w3-animate-left">
    @include('mail.draft')
  </div>

  <!-- Trash -->
  <a id="myBtn" onclick="myFunc('Demo2')" href="javascript:void(0)" class="w3-bar-item w3-button"><i class="fa fa-trash w3-margin-right"></i>Trash<i class="fa fa-caret-down w3-margin-left"></i>
  </a>
  <div id="Demo2" class="w3-hide w3-animate-left">
    @include('mail.trash')
  </div>
</nav>

<!-- Overlay effect when opening the side navigation on small screens -->
<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="Close Sidemenu" id="myOverlay"></div>

<!-- Page content -->
<div class="w3-main" style="margin-left:320px;">
<i class="fa fa-bars w3-button w3-white w3-hide-large w3-xlarge w3-margin-left w3-margin-top" onclick="w3_open()"></i>
<a href="javascript:void(0)" class="w3-hide-large w3-red w3-button w3-right w3-margin-top w3-margin-right" onclick="document.getElementById('id01').style.display='block'"><i class="fa fa-pencil"></i></a>
    @yield('content')
</div>

<!-- Modal that pops up when you click on "New Message" -->
@include('mail.modal')

<script>
var openInbox = document.getElementById("myBtn");
openInbox.click();

function w3_open() {
  document.getElementById("mySidebar").style.display = "block";
  document.getElementById("myOverlay").style.display = "block";
}

function w3_close() {
  document.getElementById("mySidebar").style.display = "none";
  document.getElementById("myOverlay").style.display = "none";
}

function myFunc(id) {
  var x = document.getElementById(id);
  if (x.className.indexOf("w3-show") == -1) {
    x.className += " w3-show"; 
    x.previousElementSibling.className += " w3-red";
  } else { 
    x.className = x.className.replace(" w3-show", "");
    x.previousElementSibling.className = 
    x.previousElementSibling.className.replace(" w3-red", "");
  }
}

function openMail(personName) {
  var i;
  var x = document.getElementsByClassName("person");
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";
  }
  x = document.getElementsByClassName("test");
  for (i = 0; i < x.length; i++) {
    x[i].className = x[i].className.replace(" w3-light-grey", "");
  }
  document.getElementById(personName).style.display = "block";
  event.currentTarget.className += " w3-light-grey";
}
</script>

<script>
var openTab = document.getElementById("firstTab");
openTab.click();
</script>

</body>
</html> 
