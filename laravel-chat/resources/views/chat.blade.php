@extends('layouts.app')
@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">Chats</div>
            <div class="card-body">
             <chat-messages :messages="messages"></chat-messages>
            </div>
            <div class="card-footer">
            
            </div>
    </div>
</div>
@endsection