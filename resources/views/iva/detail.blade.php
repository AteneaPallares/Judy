@extends('layouts.app')

@section('content')
    <ivacreate-component :number="2" v-bind:detailsid="{{$detailN}}"/>
@endsection