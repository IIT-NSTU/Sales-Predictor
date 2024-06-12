@extends('layout.app')
@section('content')
    @include('components.invoice.invoice-list')
    @include('components.invoice.invoice-delete')
    @include('components.invoice.invoice-details')
@endsection
