@if($errors->any())
<div class="alert alert-danger rounded error-message">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    @foreach ($errors->all() as $error)
        <p>{{ $error }}</p>
    @endforeach
</div>
@endif
