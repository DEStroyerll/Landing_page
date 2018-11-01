<!--Промежуточный макет наследующий основной макет сайта layouts.experience-->
@extends('layouts.experience')

<!--Здесь подключаем секцию experience_page-->
@section('experience_page')
    @include('site.experience_page')
@endsection
