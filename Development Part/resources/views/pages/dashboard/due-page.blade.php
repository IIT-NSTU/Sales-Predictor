@extends('layout.app')
@section('content')
    @include('components.due.due-list')
    @include('components.due.due-create')
    @include('components.due.due-update')
    @include('components.due.due-details')
@endsection
