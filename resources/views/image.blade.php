<ul>
    @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
        <li>
            <a rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                {{ $properties['native'] }}
            </a>
        </li>
    @endforeach
</ul>


<h1>{{ __('app.upload') }}</h1>

<form action="{{ route('image') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="file" name="image">
    <button>Upload</button>
</form>
