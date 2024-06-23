<!-- resources/views/chat.blade.php -->

@extends('layouts.appchat')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">会員チャット</div>
        <div class="card-body">
            <chat-messages :messages="messages" :user="{{ auth()->user() }}"></chat-messages>
        </div>
        <div class="card-footer">
            <chat-form v-on:messagesent="addMessage" :user="{{ auth()->user() }}"></chat-form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    {{-- @vite(['resources/js/chat.js']) --}}
@endpush
