@extends('layouts.default')

@push('styles')
    <link rel="stylesheet" href="/css/summernote.css" media="screen" title="no title">

@endpush

@section('content')
    <procedures></procedures>
@stop


@push('scripts')

    <script type="text/javascript" src="/js/summernote.js"></script>
    <script type="text/javascript" src="/js/summernote-zh-CN.js"></script>

@endpush
