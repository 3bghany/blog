<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            My Posts
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="col-12 col-md-12 col-lg-12">
                        <a href="{{route('post.create')}}" class="btn btn-primary float-end">+ Create</a>
                        <br>
                        <br>
                        <div class="card">
                            <div class="card-header">
                              <h4>My Posts</h4>
                            </div>
                            <div class="card-body">
                              <div class="section-title mt-0">Light</div>
                              <table class="table table-hover" >
                                <thead>
                                  <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Content</th>
                                    <th scope="col">Created At</th>
                                    <th scope="col">Action</th>
                                  </tr>
                                </thead>
                                <tbody>
                                    @foreach ($posts as $post)                                        
                                  <tr>
                                    <th scope="row">{{$post->id}}</th>
                                    <td class="title-table-column">{{$post->title}}</td>
                                    <td class="content-table-column">{{$post->content}}</td>
                                    <td>{{$post->created_at}}</td>
                                    <td><a class="btn btn-primary" href="{{route('post.edit',$post->id)}}">edit</a></td>
                                  </tr>
                                  @endforeach

                                </tbody>
                              </table>
                            </div>
                          </div>
                    
                    
            </div>
        </div>
    </div>

@push('styles')
<style>
  .title-table-column {
      max-width: 150px; /* Adjust the width as needed */
      overflow: hidden;
      text-overflow: ellipsis;
      white-space: nowrap;
  }
  .content-table-column {
      max-width: 300px; /* Adjust the width as needed */
      overflow: hidden;
      text-overflow: ellipsis;
      white-space: nowrap;
  }
</style>
@endpush
</x-app-layout>
