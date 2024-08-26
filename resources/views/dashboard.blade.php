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
                    <div class="row">
                        @foreach ($posts as $post)
                    <div class="col-12 col-md-6 mb-4">
                            
                        <div class="card bg-whitesmoke card-secondary mb-4">
                            <div class="card-header">
                              <h4 class="card-title">{{$post->title}}</h4>
                              <div class="card-header-action">
                                <a href="{{route('post.show',$post->id)}}" class="btn btn-primary">
                                  Details
                                </a>
                              </div>
                            </div>
                            <div class="card-body">
                              <p class="card-text content-card">{{$post->content}}</p>
                            </div>
                          </div>
                    </div>
                    @endforeach


                    </div>
                    
                    
            </div>
        </div>
    </div>

    @push('styles')
<style>
  .content-card {
      max-height: 300px;
      overflow: hidden;
      text-overflow: ellipsis;
      display: -webkit-box; /* Required for multiline truncation */
        -webkit-line-clamp: 3; /* Number of lines to display before truncating */
        -webkit-box-orient: vertical; /* Required for multiline truncation */
        line-height: 1.5em; /* Adjust line height to control the text spacing */
  }
</style>
@endpush
</x-app-layout>
