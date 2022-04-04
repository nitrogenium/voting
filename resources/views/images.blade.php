
@extends('layout')


@section ('content')

    <div class="mt-5">
        <h1 class="text-gray-900 text-3xl">Отдайте свой голос</h1>
{{--        <p class="text-gray-400">Голосовать можно только один раз</p>--}}

        <div class="grid grid-cols-2 gap-5 mt-5">

            @foreach($folder->images()->withCount('votes')->orderBy('votes_count', 'desc')->get() as $image)

                <div class="">
                    <div>
                        <img src="{{ ('/storage/'.$image->folder->name. '/'. $image->name) }}" class="h-[600px]">

                    </div>

                    <div class="mt-2 flex items-center">
                        <p class="text-3xl mr-4 font-bold text-gray-600">
                           {{ $image->votes()->count() }}
                        </p>

                        @php ($btn_class = (optional($upvoted)->image_id === $image->id) ? 'bg-red-600 hover:bg-red-700 focus:ring-red-500':'bg-indigo-600 hover:bg-indigo-700 focus:ring-indigo-500')

                    <a type="button" href="{{route('up', $image->id)}}"
                       class="inline-flex items-center px-3 py-2 border border-transparent shadow-sm text-sm leading-4 font-medium rounded-md text-white  focus:outline-none focus:ring-2 focus:ring-offset-2 {{$btn_class}}">

                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5" />
                    </svg>
                </a>

                        </div>

                </div>

            @endforeach()

        </div>


    </div>

@endsection
