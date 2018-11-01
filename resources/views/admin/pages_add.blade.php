<!--Промежуточный шаблон который наследует базовый шаблон Admin panel-->
@extends('layouts.admin')

@section('header')
    @include('admin.header')
@endsection

@section('content')
    @include('admin.content_pages_add')
@endsection