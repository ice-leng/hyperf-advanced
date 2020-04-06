@extends('layouts.base')

@section('title', $name)

@section('sidebar')
    @parent
    <p>-----this is sidebar -------</p>
@endsection

@section('content')
    <p>this is content </p>
    {{$name}}
@endsection
