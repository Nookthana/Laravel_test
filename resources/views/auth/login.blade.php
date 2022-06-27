<x-guest-layout>
    <x-auth-card >
        <x-slot name="logo" ></x-slot>

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />


        <div class="container">
            <div class="row align-items-center vh-100">
                <div class="col-10 mx-auto">

                    <form method="POST" action="{{ route('login') }}" >
                        @csrf
                          <div class="row justify-content-center">
                                <div class="container text-center">
                                    <div class="row">
                                        <div class="col-sm">
                                             <a href="/">
                                                 <i class="fa-solid fa-house-chimney fa-2xl"></i>
                                             </a>
                                        </div>
                                     </div>
                                </div>
                             <div class="col-md-5 pt-3">       
                                     <div class="card ">
                                         <div class="card-header fs-2 text-center text-light bg-danger"><i class="fa-solid fa-right-to-bracket"></i>&nbsp;Login</div>
                                         <div class="card-body">

                                                    <!-- Validation Errors -->
                                                    <x-auth-validation-errors class="mb-4 text-danger" :errors="$errors" />

                                             <form action="" method="">
                                                 <div class="form-group row">
                                                     <label for="email_address" class="col-md-4 col-form-label text-md-right"><i class="fa-solid fa-envelope"></i>&nbsp;E-Mail</label>
                                                     <div class="col-md-6">
                                                         <x-input id="email" 
                                                                  class="form-control" 
                                                                  type="email" 
                                                                  name="email" 
                                                                  :value="old('email')" 
                                                                  required autofocus />
                                                     </div>
                                                 </div>
                                             
                                                 <div class="form-group row pt-3">
                                                     <label for="password" class="col-md-4 col-form-label text-md-right"><i class="fa-solid fa-key"></i>&nbsp;Password</label>
                                                     <div class="col-md-6">
                                                         <x-input id="password" 
                                                                  class="form-control"
                                                                  type="password"
                                                                  name="password"
                                                                  required autocomplete="current-password" />
                                                     </div>
                                                 </div>
                                             
                                                 <div class="col-md-6 offset-md-4 pt-3">
                                                     <div class="row">
                                                       <div class="col">
                                                     
                                                         <button type="submit" class="btn btn-success">
                                                             <i class="fa-solid fa-arrow-right-to-bracket"></i>&nbsp;    
                                                                 {{ __('Log in') }}
                                                         </button>
                                                     
                                                       </div>
                                                     </div>
                                                </div>
                                         </form>
                                     </div>
                                 </div>
                             </div>
                         </div>
                </div>
            </div>
        </div>


    </x-auth-card>
</x-guest-layout>
