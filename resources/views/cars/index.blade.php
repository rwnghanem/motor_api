@extends('layout')

@section('content')
    <div class="inline-block m-10 w-full overflow-hidden align-middle border-b border-gray-200 shadow sm:rounded-lg">
        <table class="w-full overflow-hidden">
            <thead>
                <tr>
                    <th
                        class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                        Name</th>
                    <th
                        class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                        Model</th>
                    <th
                        class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                        Description</th>
                    <th
                        class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                        Status</th>
                    <th
                        class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                        Delete</th>
                </tr>
            </thead>

            <tbody class="bg-white ">

                @foreach ($cars as $car)
                    <tr>
                        <td class="px-6 py-4  border-b border-gray-200 whitespace-normal">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 w-10 h-10">
                                    <img class="w-10 h-10 rounded-full object-contain"
                                        src="{{ asset('storage/uploads') . '/' . $car->image }}" alt="admin dashboard ui">
                                </div>

                                <div class="ml-4">
                                    <div class="text-sm font-medium leading-5 text-gray-900 ">
                                        {{ $car->name }}
                                    </div>
                                </div>
                            </div>
                        </td>

                        <td class="px-6 py-4  border-b border-gray-200 whitespace-normal">
                            <div class="text-sm leading-5 text-gray-500">{{ $car->model }}</div>
                        </td>

                        <td class="px-6 py-4  border-b border-gray-200 whitespace-normal  ">
                            {{ $car->description }}
                        </td>
                        <td class="px-6 py-4  border-b border-gray-200 whitespace-normal">
                            {{ $car->status }}
                        </td>


                        <td class="px-6 py-4 text-sm leading-5 text-gray-500  border-b border-gray-200 whitespace-normal">
                            <form action="/dashboard/cars/{{ $car->id }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-red-400" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach


            </tbody>
        </table>
    </div>
    </div>
    </div>
@endsection
