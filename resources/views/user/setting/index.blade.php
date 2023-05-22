@extends('user.layouts.main')
@section('content')
    <div id="settings">
      @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
      @endif
      <form action="{{ route('user.settings.update', ['id' => $user->id]) }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form">
          <label for="">Change Picture:</label>
          <input type="file" class="inp" name="picture">
          @error('picture')
            <div class="error">{{ $message }}</div>
          @enderror
        </div>
        <div class="form">
          <label for="name">Name:</label>
          <input type="text" value="{{ $user->name }}" id="name" class="inp" name="name">
          @error('name')
            <div class="error">{{ $message }}</div>
          @enderror
        </div>
        <div class="form">
          <label for="username">Username:</label>
          <input type="text" value="{{ $user->username }}" id="username" class="inp" name="username">
          @error('username')
            <div class="error">{{ $message }}</div>
          @enderror
        </div>
        <div class="form">
          <label for="bio">Bio:</label>
          <input type="text" value="{{ $user->bio }}" id="bio" class="inp" name="bio">
          @error('bio')
            <div class="error">{{ $message }}</div>
          @enderror
        </div>
        <button class="btn">Save Change</button>
      </form>
    </div>
@endsection