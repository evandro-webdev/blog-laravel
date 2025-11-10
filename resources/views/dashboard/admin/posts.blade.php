@extends('dashboard.layout')

@props([
  'users'
])

@section('content')
  <x-page-heading 
    title="Posts" 
    subtitle="Gerencie todas as publicações do blog"
  />

  <x-ui.base.panel tone="darker">
    <x-dashboard.posts.table :$posts />
  </x-ui.base.panel>
@endsection
