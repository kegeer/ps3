@extends('layouts.default')


@section('content')
    <project-tasks :project="{{ $id }}"></project-tasks>
@stop
