@if (session('url'))
    <ul class="bg-success text-light">
        {{ trans('general.successSave', ['url' => session('url')]) }}
    </ul>
@endif
