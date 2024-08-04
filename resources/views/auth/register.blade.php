<link rel="stylesheet" href="{{ asset('bootstrap/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/all.min.css') }}">
<x-guest-layout>
    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required
                autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

            {{-- rule --}}
            <div class="col-md-12 mt-4">
                <x-input-label for="rule" :value="__('Select Rule')" />
                <select name="rule_id" id="rule_id" class="form-select custom-select text-white" style="background-color: #343a40; color: white;">
                    <option class="bg-dark text-white" value="" selected disabled>Select Category</option>
                    @foreach ($rule as $item)
                        <option class="bg-dark text-white" value="{{$item->id}}">{{$item->title}}</option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('rule_id')" class="mt-2" />
            </div>

            {{-- image --}}
            <div class="col-md-12 mt-4">
                <x-input-label for="image" :value="__('Upload Image')" />

                <x-text-input id="image" class="block mt-1 w-full" type="file" name="image" :value="old('image')"  autocomplete="image" />
                <x-input-error :messages="$errors->get('image')" class="mt-2" />
            </div>


        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 bg-dark dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4 bg-dark">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
