<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Create New Post
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="col-12 col-md-12 col-lg-12">
                        <form action="{{route('post.store')}}" method="POST">
                            @csrf
                        <div class="form-group">
                            <label>Title</label>
                            @if ($errors->has('title'))
                                            <span style="color: red"> *{{$errors->first('title')}}</span>
                                                
                                            @endif
                            <input required type="text" name="title" autofocus class="form-control">
                          </div>

                          <div class="form-group">
                            <label>content</label>
                            @if ($errors->has('content'))
                                            <span style="color: red"> *{{$errors->first('content')}}</span>
                                                
                                            @endif
                            <textarea required class="form-control" maxlength="8000" name="content" style="max-height: 300px; height: 100px;"></textarea>
                          </div>
                          <br>
                          <button type="submit" class="btn btn-primary">Publish</button>

                        </form>

                       
                    
                    
            </div>
        </div>
    </div>


</x-app-layout>
