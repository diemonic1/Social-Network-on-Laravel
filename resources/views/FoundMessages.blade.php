@extends('Layouts.main')
@include('layouts.Search')

@section('title')
    <title>ASN | Messages</title>
@endsection

@section('content')
<div class="container">
    @yield('searchSection')
    @foreach ($myMessages as $message)
        <form class="m-lg-3" action="{{ route('dialogues.showInDialogue', [$message->dialogue->id, $message]) }}" method="get">
            @csrf
            <div class="d-inline">{{ $message->user->name }}: {{ $message->content }}</div>
            <button type="submit" class="btn btn-primary">Открыть диалог</button>
        </form>
    @endforeach
</div>
@endsection
