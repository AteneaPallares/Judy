@extends('layouts.app')

@section('content')
    <userscreate-component :number="2" v-bind:detailsid="{{$detailN}}"/>
@endsection