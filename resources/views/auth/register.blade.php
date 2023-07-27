<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <form method="POST" action="{{ route('register') }}">
            @csrf
            <!-- Image-->
            <div class="mt-4 text-center">
                <x-input-error :messages="$errors->get('avatar')" class="mt-2" />
                
                <!-- Container onde a imagem será exibida -->
                <div id="upload-demo"></div>
                
                <!-- Input oculto onde o arquivo de imagem será selecionado -->
                <input id="hidden-avatar" style="display: none;" type="file" name="avatar" accept="image/*" />
            
                <!-- Botão que acionará a seleção de arquivo no input oculto -->
                <x-primary-button class="ml-4" id="avatar" type="button">Escolha uma imagem de perfil</x-primary-button>
            
                <!-- Input oculto onde a imagem cortada será armazenada -->
                <input type="hidden" id="imagebase64" name="imagebase64">
            </div>

            <div class="grid grid-cols-2 gap-2">
                <!-- Name -->
            <div class="mt-4">
                <x-input-label for="name" :value="__('Nome de Usuário')" />
                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-input-label for="email" :value="__('E-mail')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Senha')" />

                <x-text-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-input-label for="password_confirmation" :value="__('Confirme a senha')" />

                <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required />

                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="text-sm text-sky-400 hover:text-sky-700" href="{{ route('login') }}">
                    {{ __('Já tem uma conta? Faça login') }}
                </a>

                <x-primary-button class="ml-4">
                    {{ __('Registrar') }}
                </x-primary-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://foliotek.github.io/Croppie/croppie.js"></script>
<link rel="stylesheet" href="https://foliotek.github.io/Croppie/croppie.css" />

<script>
$(document).ready(function(){
    var $uploadCrop;

    function readFile(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $uploadCrop = $('#upload-demo').croppie({
                    enableExif: true,
                    viewport: {
                        width: 100,
                        height: 100,
                        type: 'circle'
                    },
                    boundary: {
                        width: 300,
                        height: 300
                    }
                });
                $uploadCrop.croppie('bind', {
                    url: e.target.result
                }).then(function(){
                    console.log('jQuery bind complete');
                });
            }
            reader.readAsDataURL(input.files[0]);
        }
        else {
            console.log("Sorry, your browser doesn't support FileReader API");
        }
    }

    // Quando o botão é clicado, disparar o clique no input do tipo "file"
    $('#avatar').on('click', function () { 
        $('#hidden-avatar').click();
    });

    // Quando o input do tipo "file" muda (arquivo selecionado), ler o arquivo
    $('#hidden-avatar').on('change', function () {
        readFile(this); 
    });

    $('form').on('submit', function (ev) {
        ev.preventDefault();
        $uploadCrop.croppie('result', {
            type: 'base64',
            size: 'viewport'
        }).then(function (resp) {
            $('#imagebase64').val(resp);
            ev.target.submit();
        });
    });
});

</script>