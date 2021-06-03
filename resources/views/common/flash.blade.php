@if(Session::get('success_message'))
    <div class="alert alert-success containerAlert">
        <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span
                class="sr-only">Close</span></button>
        {{ Session::get('success_message') }}
    </div>
@endif

@if(Session::get('error_message'))
    <div class="alert alert-danger containerAlert">
        <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span
                class="sr-only">Close</span></button>
        {{ Session::get('error_message') }}
    </div>
@endif

@if(count($errors)>0)
    @foreach($errors->all() as $errors)
        <div class="alert alert-danger containerAlert">
            <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span
                    class="sr-only">Close</span></button>
            {{ $errors }}
        </div>
    @endforeach
@endif
