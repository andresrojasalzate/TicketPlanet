<link rel="stylesheet" href="{{ asset('css/styles.css') }}">
<div class="card-form-reset">
    <form method="POST" action="{{ route('password.update') }}">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">
        <div class="correoLogin">
            <label for="email">{{ __('Correo electrónico') }}</label>
            <div class="correoLogin">
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                    name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
                
            </div>
        </div>
        <div class="contraLogin">
            <label for="password">{{ __('Nueva contraseña') }}</label>
            <div class="contraLogin">
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                    name="password" required autocomplete="new-password">

                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="contraLogin">
            <label for="password-confirm">{{ __('Vuelve a escribir la contraseña') }}</label>
            <div class="contraLogin">
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required
                    autocomplete="new-password">
            </div>
        </div>
        <div>
            <div>
                <input type="submit" class="btnIniciaSesion" value="Guardar">
                
            </div>
        </div>
    </form>
</div>
