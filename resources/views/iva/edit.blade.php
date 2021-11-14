@extends('layouts.app')

@section('content')
    <ivacreate-component :number="1" v-bind:detailsid="{{$detailN}}"/>
@endsection