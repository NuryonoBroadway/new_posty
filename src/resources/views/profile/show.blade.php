@extends('layouts.app')

@section('content')
    <div class="flex  justify-center">
        <div class="w-6/12 bg-gray-500 p-6 flex flex-col items-center rounded-lg">   
            @if (session('status'))
                <div class="text-white w-full px-6 py-4 border-0 rounded relative mb-4 bg-green-500">
                    <span class="inline-block align-middle mr-8">
                        {{ session('status') }}
                      </span>
                </div>
                @endif
            <div class="w-full bg-white p-6 rounded-lg justify-center ">
                <form action="{{ route('profile', $user)}} " method="post">
                    @csrf
                    @method('PATCH')
                    <div class="mb-4">
                        <label for="name" class="sr-only">Name</label>
                        <input type="text" name="name" id="name" placeholder="Your name" 
                        class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('name') border-red-500 @enderror" value="{{ old('name') ? old('name') : $user->name }}">

                        @error('name')
                            <div class="text-red-500 mt-2 text-sm text-center">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="username" class="sr-only">Username</label>
                        <input type="text" name="username" id="username" placeholder="Username" 
                        class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('username') border-red-500 @enderror" value="{{ old('username') ? old('username') : $user->username }}">

                        @error('username')
                            <div class="text-red-500 mt-2 text-sm text-center">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="email" class="sr-only">Email</label>
                        <input type="text" name="email" id="email" placeholder="Your email" 
                        class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('email') border-red-500 @enderror" value="{{ old('email') ? old('email') : $user->email }}">

                        @error('email')
                            <div class="text-red-500 mt-2 text-sm text-center">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div>
                        <button type="submit" class="bg-blue-500 text-white px-4 py-3 rounded 
                        font-medium w-full">Update Profile</button>
                    </div>
                </form>
            </div>
            <br>
            <div class="w-full bg-white p-6 rounded-lg justify-center ">
                <form action="{{ route('changePassword', $user)}} " method="post">
                    @csrf
                    @method('PATCH')
                    <div class="mb-4">
                        <label for="current_password" class="sr-only">Current Password</label>
                        <input type="password" name="current_password" id="current_password" placeholder="Current Password" 
                        class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('name') border-red-500 @enderror">

                        @error('current_password')
                            <div class="text-red-500 mt-2 text-sm text-center">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="new_password" class="sr-only">New Password</label>
                        <input type="password" name="new_password" id="new_password" placeholder="New Password" 
                        class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('new_password') border-red-500 @enderror">

                        @error('new_password')
                            <div class="text-red-500 mt-2 text-sm text-center">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="new_password_confirmation" class="sr-only">New Password Confirmation</label>
                        <input type="password" name="new_password_confirmation" id="new_password_confirmation" placeholder="New Password Confirmation" 
                        class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('new_password_confirmation') border-red-500 @enderror">

                        @error('new_password_confirmation')
                            <div class="text-red-500 mt-2 text-sm text-center">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div>
                        <button type="submit" class="bg-blue-500 text-white px-4 py-3 rounded 
                        font-medium w-full">Update Password</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection