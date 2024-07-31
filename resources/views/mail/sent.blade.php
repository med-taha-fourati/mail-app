@foreach($mail as $attrib)
@if($attrib['from'] == auth()->user()->email && $attrib['trash_id'] == null)
@include('components.side-message', ['modifier' => ''])
@endif
@endforeach