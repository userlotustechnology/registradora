@extends('layouts.app')

@section('title', 'Cadastro - Nossa Paroquia Online')

@section('content')
<div class="container-fluid">
    <div class="main-content d-flex flex-column p-0">
        <div class="m-lg-auto my-auto w-930 py-4">
            <div class="card bg-white border rounded-10 border-white py-100 px-130">
                <div class="p-md-5 p-4 p-lg-0">
                    <div class="text-center mb-4">
                        <h3 class="fs-26 fw-medium" style="margin-bottom: 6px;">Cadastrar</h3>
                        <p class="fs-16 text-secondary lh-1-8">Já tem uma conta? <a href="{{ route('login') }}" class="text-primary text-decoration-none">Entrar</a></p>
                    </div>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        
                        <div class="mb-20">
                            <label class="label fs-16 mb-2">Nome</label>
                            <div class="form-floating">
                                <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                       id="floatingInput1" name="name" 
                                       placeholder="Digite seu nome *" 
                                       value="{{ old('name') }}" required>
                                <label for="floatingInput1">Digite seu nome *</label>
                            </div>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-20">
                            <label class="label fs-16 mb-2">Endereço de Email</label>
                            <div class="form-floating">
                                <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                       id="floatingInput2" name="email" 
                                       placeholder="Digite seu email *" 
                                       value="{{ old('email') }}" required>
                                <label for="floatingInput2">Digite seu email *</label>
                            </div>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-20">
                            <label class="label fs-16 mb-2">Sua Senha</label>
                            <div class="form-group" id="password-show-hide">
                                <div class="password-wrapper position-relative password-container">
                                    <input type="password" class="form-control text-secondary password @error('password') is-invalid @enderror" 
                                           name="password" placeholder="Digite sua senha *" required>
                                    <i style="color: #A9A9C8; font-size: 22px; right: 15px;" 
                                       class="ri-eye-off-line password-toggle-icon translate-middle-y top-50 position-absolute cursor text-secondary" 
                                       aria-hidden="true"></i>
                                </div>
                            </div>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-20">
                            <label class="label fs-16 mb-2">Confirmar Senha</label>
                            <div class="form-group" id="password-confirm-show-hide">
                                <div class="password-wrapper position-relative password-container">
                                    <input type="password" class="form-control text-secondary password-confirm @error('password_confirmation') is-invalid @enderror" 
                                           name="password_confirmation" placeholder="Confirme sua senha *" required>
                                    <i style="color: #A9A9C8; font-size: 22px; right: 15px;" 
                                       class="ri-eye-off-line password-confirm-toggle-icon translate-middle-y top-50 position-absolute cursor text-secondary" 
                                       aria-hidden="true"></i>
                                </div>
                            </div>
                            @error('password_confirmation')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-20">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" required>
                                <label class="form-check-label fs-16" for="flexCheckDefault">
                                    Eu aceito os <a href="#" class="text-decoration-none text-primary">Termos e condições</a>
                                </label>
                            </div>
                        </div>

                        <div class="mb-4">
                            <button type="submit" class="btn btn-primary fw-normal text-white w-100" 
                                    style="padding-top: 18px; padding-bottom: 18px;">Cadastrar</button>
                        </div>

                        <div class="position-relative text-center z-1 mb-12">
                            <span class="fs-16 bg-white px-4 text-secondary card d-inline-block border-0">ou cadastre com</span>
                            <span class="d-block border-bottom border-2 position-absolute w-100 z-n1" style="top: 13px;"></span>
                        </div>

                        <ul class="p-0 mb-0 list-unstyled d-flex justify-content-center" style="gap: 10px;">
                            <li>
                                <a href="#" class="d-inline-block rounded-circle text-decoration-none text-center text-white transition-y fs-16" 
                                   style="width: 30px; height: 30px; line-height: 30px; background-color: #3a559f;">
                                    <i class="ri-facebook-fill"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="d-inline-block rounded-circle text-decoration-none text-center text-white transition-y fs-16" 
                                   style="width: 30px; height: 30px; line-height: 30px; background-color: #0f1419;">
                                    <i class="ri-twitter-x-line"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="d-inline-block rounded-circle text-decoration-none text-center text-white transition-y fs-16" 
                                   style="width: 30px; height: 30px; line-height: 30px; background-color: #e02f2f;">
                                    <i class="ri-google-fill"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="d-inline-block rounded-circle text-decoration-none text-center text-white transition-y fs-16" 
                                   style="width: 30px; height: 30px; line-height: 30px; background-color: #007ab9;">
                                    <i class="ri-linkedin-fill"></i>
                                </a>
                            </li>
                        </ul>
                    </form> 
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Toggle password visibility
    document.addEventListener('DOMContentLoaded', function() {
        // Password toggle
        const passwordToggle = document.querySelector('.password-toggle-icon');
        const passwordInput = document.querySelector('.password');
        
        if (passwordToggle && passwordInput) {
            passwordToggle.addEventListener('click', function() {
                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text';
                    passwordToggle.classList.remove('ri-eye-off-line');
                    passwordToggle.classList.add('ri-eye-line');
                } else {
                    passwordInput.type = 'password';
                    passwordToggle.classList.remove('ri-eye-line');
                    passwordToggle.classList.add('ri-eye-off-line');
                }
            });
        }

        // Password confirmation toggle
        const passwordConfirmToggle = document.querySelector('.password-confirm-toggle-icon');
        const passwordConfirmInput = document.querySelector('.password-confirm');
        
        if (passwordConfirmToggle && passwordConfirmInput) {
            passwordConfirmToggle.addEventListener('click', function() {
                if (passwordConfirmInput.type === 'password') {
                    passwordConfirmInput.type = 'text';
                    passwordConfirmToggle.classList.remove('ri-eye-off-line');
                    passwordConfirmToggle.classList.add('ri-eye-line');
                } else {
                    passwordConfirmInput.type = 'password';
                    passwordConfirmToggle.classList.remove('ri-eye-line');
                    passwordConfirmToggle.classList.add('ri-eye-off-line');
                }
            });
        }
    });
</script>
@endsection
