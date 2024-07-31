@extends('components.layout')
@section('content')
@if($mail->count() != 0)
@foreach($mail as $mail_attrib)
<div id="{{ $mail_attrib['id'] }}" class="w3-container person">
  <br>
  <img class="w3-round  w3-animate-top" src="{{ asset('avatar3.png') }}" style="width:20%;">
  <h5 class="w3-opacity">Subject: {{ $mail_attrib['subject'] }}</h5>
  <h4><i class="fa fa-clock-o"></i> From {{ $mail_attrib['from'] }}, {{ $mail_attrib['updated_at'] }}</h4>
  <h4><i class="fa fa-mail-reply"></i> To {{ $mail_attrib['to'] }}</h4>
  @if($mail_attrib['trash_id'] == null)
  
  @if($mail_attrib['from'] != auth()->user()->email)
  
  @include('mail.reply-modal', ['mail_attrib' => $mail_attrib])
  <a class="w3-button w3-light-grey" href="#" onclick="document.getElementById('id{{$mail_attrib->id}}02').style.display='block'">Reply<i class="w3-margin-left fa fa-mail-reply"></i></a>
  
  @endif
  
  @include('mail.forward-modal', ['mail_attrib' => $mail_attrib])
  <a class="w3-button w3-light-grey" href="#" onclick="document.getElementById('id{{$mail_attrib->id}}03').style.display='block'">Forward<i class="w3-margin-left fa fa-arrow-right"></i></a>
  
  <form action="{{ route('mail.update', $mail_attrib) }}" method="post">
    @csrf
    @method('PUT')
    <button type="submit" class="w3-button w3-light-grey">Send to trash<i class="fa fa-trash w3-margin-right"></i></button>
  </form>
  
  @endif
  @if ($mail_attrib['trash_id'] != null)
  <form action="{{ route('mail.restore', $mail_attrib) }}" method="post">
    @csrf
    @method('PUT')
    <button type="submit" class="w3-button w3-light-grey">Restore<i class="fa fa-trash w3-margin-right"></i></button>
  </form>
  @endif
  <hr>
  <p><?php echo wordwrap($mail_attrib['content'], 500, '<br>') ?></p>
</div>
@endforeach

@foreach($draft as $draft_attrib)
<div id="{{$draft_attrib['id']}}draft" class="w3-container person">
  <br>
  <img class="w3-round  w3-animate-top" src="{{ asset('avatar3.png') }}" style="width:20%;">
  <h5 class="w3-opacity">Subject: {{ $draft_attrib['subject'] }}</h5>
  <h4><i class="fa fa-clock-o"></i> From {{ $draft_attrib['from'] }}, {{ $draft_attrib['created_at'] }}</h4>
  <h4><i class="fa fa-mail-reply"></i> To {{ $mail_attrib['to'] }}</h4>
  <form action="{{ route('mail.undraft', $draft_attrib) }}" method="post">
    @csrf
    @method('PUT')
    <button type="submit" class="w3-button w3-light-grey">Undraft and send<i class="fa fa-trash w3-margin-right"></i></button>
  </form>

  <hr>
  <p><?php echo wordwrap($draft_attrib['content'], 500, '<br>') ?></p>
</div>
@endforeach

@foreach($trash as $trash_attrib)
<div id="{{$trash_attrib['id']}}trash" class="w3-container person">
  <br>
  <img class="w3-round  w3-animate-top" src="{{ asset('avatar3.png') }}" style="width:20%;">
  <h5 class="w3-opacity">Subject: {{ $trash_attrib['subject'] }}</h5>
  <h4><i class="fa fa-clock-o"></i> From {{ $trash_attrib['from'] }}, {{ $trash_attrib['created_at'] }}</h4>
  <h4><i class="fa fa-mail-reply"></i> To {{ $mail_attrib['to'] }}</h4>

  <form action="{{ route('mail.restore', $trash_attrib) }}" method="post">
    @csrf
    @method('PUT')
    <button type="submit" class="w3-button w3-light-grey">Restore<i class="fa fa-trash w3-margin-right"></i></button>
  </form>

  <hr>
  <p><?php echo wordwrap($trash_attrib['content'], 500, '<br>') ?></p>
</div>
@endforeach
@else
<div class="w3-container w3-center">
  <h2>No mail found</h2>
</div>
@endif
@endsection