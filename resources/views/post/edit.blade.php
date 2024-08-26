<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Post
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="col-12 col-md-12 col-lg-12">
                        <form action="{{route('post.update',$post->id)}}" method="POST">
                            @csrf
                            @method('PUT')
                        <div class="form-group">
                            <label>Title</label>
                            @if ($errors->has('title'))
                                            <span style="color: red"> *{{$errors->first('title')}}</span>
                                                
                            @endif
                            <input required type="text" name="title" class="form-control" value="{{$post->title}}">
                          </div>

                          <div class="form-group">
                            <label>content</label>
                            @if ($errors->has('content'))
                                            <span style="color: red"> *{{$errors->first('content')}}</span>
                                                
                                            @endif
                            <textarea required class="form-control" maxlength="8000" name="content" style="max-height: 300px; height: 100px;" >{{$post->content}}</textarea>
                          </div>
                          <br>
                          <button type="submit" class="btn btn-primary">Update</button>
                        <a href="{{route('post.destroy',$post->id)}}" class="btn btn-danger float-end delete-post-btn">Delete Post</a>

                        </form>


                       
                    
                    
            </div>
        </div>
    </div>

@push('scripts')
<script>
    $(document).ready(function(){
        $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        $('body').on('click','.delete-post-btn',function(event){
            event.preventDefault();
            let deleteURL= $(this).attr('href');
            console.log(deleteURL);


            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
              }).then((result) => {
                if (result.isConfirmed) {
              
                  $.ajax({
                    method:'DELETE',
                    url:deleteURL,
                    success:function(data){
                        if(data.status){                                
                            Swal.fire({
                            title: "Deleted!",
                            text: data.message,
                            icon: "success"
                            }).then(()=>{window.location.replace('/post')});
                        }
                    },
                    error:function(data){
                      console.log(data);
                    },
                  })
                }
              });

            
        })
    })
</script>
@endpush
</x-app-layout>
