@if ($errors->any())
    <ul class="bg-danger text-light">
        <p>{{ trans('general.errorSave') }}</p>
        {!! implode('', $errors->all('<li >:message</li>')) !!}
    </ul>
@endif
