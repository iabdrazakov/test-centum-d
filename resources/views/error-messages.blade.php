@if ($errors->any())
    <ul class="alert-danger js-cms-errors-block">
        <p>{{ trans('general.errorSave') }}</p>
        {!! implode('', $errors->all('<li >:message</li>')) !!}
    </ul>
@endif
