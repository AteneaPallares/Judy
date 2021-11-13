@extends('layouts.app')

@section('content')
    <userscreate-component :number="1" v-bind:detailsid="{{$detailN}}"/>
@endsection