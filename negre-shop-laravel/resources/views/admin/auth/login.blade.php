@extends('admin.layouts.guest')

@section('title', 'Connexion')

@section('content')
<div class="container">

    <!-- Bouton retour au site -->
    <div class="row">
        <div class="col-12">
            <a href="{{ url('/') }}" class="btn btn-link text-dark mt-3">
                <i class="fas fa-arrow-left"></i> Retour au site
            </a>
        </div>
    </div>

    <!-- Outer Row -->
    <div class="row justify-content-center">

        <div class="col-xl-10 col-lg-12 col-md-9">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Bienvenue !</h1>
                                </div>

                                <!-- Session Status -->
                                @if (session('status'))
                                    <div class="alert alert-success mb-4" role="alert">
                                        {{ session('status') }}
                                    </div>
                                @endif

                                <form method="POST" action="{{ route('login') }}" class="user">
                                    @csrf

                                    <!-- Email Address -->
                                    <div class="form-group">
                                        <input type="email" 
                                               class="form-control form-control-user @error('email') is-invalid @enderror"
                                               id="email" 
                                               name="email" 
                                               value="{{ old('email') }}"
                                               required 
                                               autofocus
                                               autocomplete="username"
                                               placeholder="Adresse email">
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Password -->
                                    <div class="form-group">
                                        <input type="password" 
                                               class="form-control form-control-user @error('password') is-invalid @enderror"
                                               id="password"
                                               name="password"
                                               required
                                               autocomplete="current-password"
                                               placeholder="Mot de passe">
                                        @error('password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Remember Me -->
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox small">
                                            <input type="checkbox" class="custom-control-input" id="remember_me" name="remember">
                                            <label class="custom-control-label" for="remember_me">
                                                Se souvenir de moi
                                            </label>
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-primary btn-user btn-block">
                                        Connexion
                                    </button>
                                </form>

                                <div class="text-center mt-4">
                                    <small class="text-muted">
                                        <i class="fas fa-info-circle"></i> 
                                        Contactez un super administrateur pour obtenir vos identifiants.
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>
@endsection

