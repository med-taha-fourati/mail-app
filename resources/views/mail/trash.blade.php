@foreach($trash as $attrib)
@if($attrib['user_id'] == auth()->user()->id)
@include('components.side-message', ['modifier' => 'trash'])
@endif
@endforeach