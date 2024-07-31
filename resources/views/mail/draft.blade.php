@foreach($draft as $attrib)
@if($attrib['user_id'] == auth()->user()->id)
@include('components.side-message', ['modifier' => 'draft'])
@endif
@endforeach