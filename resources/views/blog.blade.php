<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    @php
        $langs = ['ar', 'he'];
    @endphp
    @if (app()->currentLocale() == 'ar')
    <style>
        body {
            direction: rtl;
            text-align: right;
        }
    </style>
    @endif

</head>
<body>

    <ul>
        @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
            <li>
                <a rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                    {{ $properties['native'] }}
                </a>
            </li>
        @endforeach
    </ul>

    {{ __('app.upload') }}

    @foreach ($posts as $post)
        <h2>{{ $post->trans_title }}</h2>
        <p>{{ $post->trans_content }}</p>
        <hr>
    @endforeach


</body>
</html>
