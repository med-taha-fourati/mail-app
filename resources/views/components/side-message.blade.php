<a href="javascript:void(0)" class="w3-bar-item w3-button w3-border-bottom test w3-hover-light-grey" onclick="openMail('{{ $attrib->id.$modifier }}');w3_close();" id="firstTab">
<div class="w3-container">
    <img class="w3-round w3-margin-right" src="{{ asset('avatar3.png') }}" style="width:15%;">
    <span class="w3-opacity w3-large">
        {{ Str::limit($attrib['from'], 16) }}
    </span>
    <h6>Subject: {{Str::limit($attrib['subject'], 10)}}</h6>
    <p>{{Str::limit($attrib['content'], 25)}}</p>
</div>
</a>