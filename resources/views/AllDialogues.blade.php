@extends('Layouts.main')
@include('layouts.Search')
@include('layouts.Dialogue')

@section('title')
    <title>ASN | Messages</title>
@endsection

@section('content')
    @yield('searchSection')
    <div class="dialogs">
        <div class="dialogs-left">
            <div id="app2">
                <all-dialogues my_id="{{ auth()->user()->id }}"></all-dialogues>
            </div>
        </div>
        <div class="dialogs-right">
            @if(isset($dialogue))
                @yield('messages')
            @endif
            @if(!isset($dialogue))
                <div>
                    <center><h4>Кликните по пользователю, чтобы начать с ним диалог!</h4></center>
                </div>
                @foreach($usersWithoutDialogue as $userWithoutDialogue)
                    <form action="{{ route('dialogues.create', $userWithoutDialogue->id) }}" method="get">
                        @csrf
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary userWithoutDialogue">
                                <div class="dialogueBlock">
                                    <div class="dialogueItem">
                                        <img class="avatar" src="/storage/{{ $userWithoutDialogue->avatar }}">
                                    </div>
                                    <div class="dialogueItem">
                                        <div>{{ $userWithoutDialogue-> name }}</div>
                                    </div>
                                </div>
                            </button>
                        </div>
                    </form>
                @endforeach
            @endif
        </div>
    </div>
@endsection
