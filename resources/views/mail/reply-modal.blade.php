<div id="id{{$mail_attrib['id']}}02" class="w3-modal" style="z-index:4; display: none;">
  <div class="w3-modal-content w3-animate-zoom">
    <div class="w3-container w3-padding w3-red">
       <span onclick="document.getElementById('id{{$mail_attrib->id}}02').style.display='none'"
       class="w3-button w3-red w3-right w3-xxlarge"><i class="fa fa-remove"></i></span>
      <h2>Reply To Mail</h2>
    </div>
    @if($mail_attrib != null)
    <div class="w3-panel">
        <form action="{{ route('mail.reply', $mail_attrib) }}" method="post">
            @csrf
            @method('POST')
            <label>To</label>
            <input class="w3-input w3-border w3-margin-bottom" type="text" name="to" value="{{ $mail_attrib['from'] }}" disabled>
            <label>From</label>
            <input class="w3-input w3-border w3-margin-bottom" type="text" name="from" value=" {{ $mail_attrib['to'] }}" disabled>
            <label>Subject</label>
            <input class="w3-input w3-border w3-margin-bottom" type="text" name="subject">
            <input class="w3-input w3-border w3-margin-bottom" style="height:150px" placeholder="What's on your mind?" name="text">
            <div class="w3-section">
            <a class="w3-button w3-red" onclick="document.getElementById('id02').style.display='none'">Cancel <i class="fa fa-remove"></i></a>
            <button type="submit" class="w3-button w3-light-grey w3-right" onclick="document.getElementById('id02').style.display='none'">Send <i class="fa fa-paper-plane"></i></button> 
        </form>
      </div>    
    </div>
    @endif
  </div>
</div>