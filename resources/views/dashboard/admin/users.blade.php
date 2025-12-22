@extends('dashboard.layout')

@props([
  'users'
])

@php
  $roleLabels = [
    'admin' => 'Admin',
    'moderator' => 'Moderador',
    'author' => 'Autor',
  ];
@endphp

@section('content')
  <x-page-heading 
    title="Usuários" 
    subtitle="Gerencie o conteúdo do seu blog e veja estatísticas."
  />

  <x-ui.base.panel tone="darker">
    <x-dashboard.users.table :$users/>
  </x-ui.base.panel>
@endsection
