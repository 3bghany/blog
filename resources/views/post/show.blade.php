<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Show Post
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="d-flex justify-content-center">

                        <div class="card col-12 col-md-10 col-lg-8 mx-auto">

                            <div class="card">
                                <div class="card-header">
                                  <h4 style="font-size: 1.5rem;">{{$post->title}}</h4>
                                </div>
                                <div class="card-body">
                                    {{$post->content}}
                                </div>
                                <div class="card-footer">
                                    <h4>Comments</h4>
    
                                    <div class="card p-3" style="width: 700px;">
                                        @foreach ($post->comments as $comment)
    
                                        <div class="d-flex align-items-center mb-2">
    
                                            <i class="fa-solid fa-circle-user" style="font-size: 2rem; color: #007bff;"></i>
    
                                            <span class="ml-2 font-weight-bold mr-2">{{$comment->user->name}}</span>
                                            @can('isMyComment',$comment)
                                                <a  class="btn delete-comment-btn" href="{{route('comment.destroy',$comment->id)}}"><i class="fa-solid fa-circle-minus"></i></a>
                                            @endcan
                                        </div>
    
                                        <div class="mt-2">
                                            <p class="card-text border p-2 rounded" style="border-width: 1px; border-color: #ccc;">{{$comment->content}}</p>
                                        </div>
                                        <br>
                                            
                                        @endforeach
                                        <div class="d-flex align-items-center mb-2">
                                            <!-- Icon -->
                                            <i class="fa-solid fa-circle-user" style="font-size: 2rem"></i>
    
                                            <span class="ml-2">{{Auth::user()->name}}</span>
                                            @if ($errors->has('content'))
                                            <span style="color: red"> *{{$errors->first('content')}}</span>
                                                
                                            @endif
                                        </div>
                                        <form action="{{route('comment.store')}}" method="POST">
                                            @csrf
                                            <div>
                                                <input type="hidden" name="post_id" value="{{$post->id}}">
                                                <textarea class="form-control" required  name="content" maxlength="5000" placeholder="Write a comment..." style="max-height: 200px; min-height:80px; height: 100px;" rows="3"></textarea>
                                            </div>
                                            <div class="mt-2">
                                                <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                                            </div>
    
                                        </form>
                                        
                                    </div>
                                  </div>
                              </div>
                        
                        
                </div>


                    </div>
        </div>
    </div>
@push('styles')
    <style>
    .delete-comment-btn{
        background: none;
    border: none;
    padding: 0;
    margin-left: 10px;
    cursor: pointer;
    }
    .delete-comment-btn i {
        color: gray;
    transition: color 0.3s ease;
    }
    
    
    .delete-comment-btn i:hover {
        color: red;
    }
    </style>
@endpush

@push('scripts')
<script>
    $(document).ready(function(){
        $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        $('body').on('click','.delete-comment-btn',function(event){
            event.preventDefault();
            let deleteURL= $(this).attr('href');

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
                            title: (data.status == 'success')?"Deleted!":"Error",
                            text: data.message,
                            icon: data.status
                            }).then(()=>{window.location.reload()});
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
