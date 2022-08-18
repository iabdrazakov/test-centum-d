@if (session('url'))
    <ul class="alert-success success-save js-alert-success">
        {{ trans('general.successSave', ['url' => session('url')]) }}
    </ul>
@endif
