<!DOCTYPE html>
<html>
<head>
    <title>Website Name</title>
</head>
<body>
    <h2>Dear {{$comment->post->user->name}}</h2>
    <p style="font-size: 1.5rem">we would like to notify that <span style="font-weight: bold">{{$comment->user->name}}</span> have just write a comment on a recent post </p>
    <p style="font-size: 1.5rem">Post title: <span style="font-weight: bold">{{$comment->post->title}}</span></p>
    <a href="{{route('post.show',$comment->post_id)}}">show more</a>
</body>
</html>