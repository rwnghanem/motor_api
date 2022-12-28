@extends('layout')

@section('content')
    <div class="container max-w-4xl mx-auto  p-1">
        <form action="/dashboard/users/{{ $user->id }}" method="post" enctype="multipart/form-data"
            class="mt-6 mb-0 space-y-4 rounded-lg p-8 shadow-2xl">
            @csrf
            @method('PUT')

            @foreach ($errors->all() as $error)
                <div role="alert" class="rounded border-l-4 border-red-500 bg-red-50 p-4">
                    <strong class="block font-medium text-red-700"> {{ $error }} </strong>
                </div>
            @endforeach
            <p class="text-lg font-medium ">Update <span
                    class="px-4 py-2  items-center text-base rounded-full text-blue-600  bg-blue-200">{{ $user->name }}</span>
            </p>

            <div>
                <label for="name" class="text-sm font-medium">Name</label>

                <div class="relative mt-1">
                    <input name="name" type="text" id="name"
                        class="w-full rounded-lg border-gray-200 p-4 pr-12 text-sm shadow-sm" placeholder="Enter Name"
                        value="{{ $user->name }}" />
                </div>
            </div>
            <div>
                <label for="email" class="text-sm font-medium">Email</label>

                <div class="relative mt-1">
                    <input name="email" type="email" id="email"
                        class="w-full rounded-lg border-gray-200 p-4 pr-12 text-sm shadow-sm" placeholder="Enter email"
                        value="{{ $user->email }}" />
                </div>
            </div>

            <div>
                <label for="password" class="text-sm font-medium">Password</label>

                <div class="relative mt-1">
                    <input name="password" type="text" id="password"
                        class="w-full rounded-lg border-gray-200 p-4 pr-12 text-sm shadow-sm" placeholder="Enter password"
                        value="{{ $user->password }}" />

                </div>
            </div>
            <div>
                <label for="role" class="text-sm font-medium">Role</label>

                <div class="relative mt-1">

                    <select id="role"
                        class="block px-3 py-2 text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm w-52 focus:outline-none focus:ring-primary-500 focus:border-primary-500"
                        name="role">
                        <option value=''>
                            Select a role
                        </option>
                        <option value="B">
                            Buyer
                        </option>
                        <option value="S">
                            Seller
                        </option>
                    </select>

                </div>
            </div>
            <div>
                <label for="image" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Image</label>

                <div class="relative mt-1">
                    <input name="image" type="file" id="image"
                        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" />
                </div>
            </div>

            <button type="submit"
                class="inline-flex items-center rounded border border-indigo-600 bg-indigo-600 px-8 py-3 text-white hover:bg-black hover:text-white focus:outline-none focus:ring active:text-white ">
                Update User
            </button>

        </form>
    </div>
@endsection
