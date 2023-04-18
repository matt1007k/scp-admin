<div>
    <div>
        <label class="form-label font-medium">Contraseña</label>
        <input name="password" type="password"
            class="form-control w-full border {{ $errors->has('password') ? ' border-danger' : '' }} "
            value="{{ old('password') }}" autocomplete="off">
        @error('password')
            <div class="login__input-error text-danger mt-2">
                {{ $message }}
            </div>
        @enderror
    </div>

    <div class="mt-6">
        <label class="form-label font-medium">Confirma contraseña</label>
        <input name="password_confirmation" type="password"
            class="form-control w-full border {{ $errors->has('password_confirmation') ? ' border-danger' : '' }} "
            value="{{ old('password_confirmation') }}" autocomplete="off">
        @error('password_confirmation')
            <div class="login__input-error text-danger mt-2">
                {{ $message }}
            </div>
        @enderror
    </div>
</div>
