<!--Промежуточный макет наследующий основной макет сайта layouts.site-->
@extends('layouts.site')

<!--Здесь подключаем секции-->
@section('header')
    @include('site.header')
@endsection

@section('content')
    @include('site.content')
@endsection

