<link href="{{ asset('css/admin.css') }}" rel="stylesheet">
<div class="login">
  <div class="login-triangle"></div>
  <h2 class="login-header">Log in</h2>

  <form method="POST" action="{{ route('admin.login') }}">
    @csrf
    <p>
        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

        @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </p>
    <p>
        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

        @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror

    </p>
    <p><input type="submit" value="Log in"></p>
  </form>
</div>
