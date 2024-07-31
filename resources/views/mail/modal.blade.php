<div id="id01" class="w3-modal" style="z-index:4">
  <div class="w3-modal-content w3-animate-zoom">
    <div class="w3-container w3-padding w3-red">
       <span onclick="document.getElementById('id01').style.display='none'"
       class="w3-button w3-red w3-right w3-xxlarge"><i class="fa fa-remove"></i></span>
      <h2>Send Mail</h2>
    </div>
    <div class="w3-panel">
        <form action="{{ route('mail.store', '') }}" method="post">
            @csrf
            @method('POST')
            <label>To</label>
            <input class="w3-input w3-border w3-margin-bottom" type="text" name="to">
            <label>Subject</label>
            <input class="w3-input w3-border w3-margin-bottom" type="text" name="subject">
            <input class="w3-input w3-border w3-margin-bottom" style="height:150px" placeholder="What's on your mind?" name="text">
            <div class="w3-section">
            <a class="w3-button w3-red" onclick="document.getElementById('id01').style.display='none'">Cancel <i class="fa fa-remove"></i></a>
            <button type="submit" name="action" value="send" class="w3-button w3-light-grey w3-right" onclick="document.getElementById('id01').style.display='none'">Send <i class="fa fa-paper-plane"></i></button>
            <button type="submit" name="action" value="draft" class="w3-button w3-light-grey w3-right" style="margin-right: 3rem;" onclick="document.getElementById('id01').style.display='none'">Save as a draft</button>
            <!--<button type="submit" class="w3-button w3-light-grey w3-right" style="margin-right: 3rem;" onclick="document.getElementById('id01').style.display='none'">Save as a draft</button>-->
        </form>
      </div>    
    </div>
  </div>
</div>