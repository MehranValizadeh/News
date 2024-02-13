<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <table class="table text-center">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Content</th>
                                <th>Source</th>
                                <th>Updated At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($news as $item)
                            <tr>
                                <td>{{$item->title}}</td>
                                <td>{{$item->body}}</td>
                                <td>{{last(explode('/' , $item->source))}}</td>
                                <td>{{$item->updated_at}}</td>
                                <td><a href="{{route('news.update' , $item->id)}}" class="btn btn-primary border-4">Update</a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
