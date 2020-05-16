@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <img src="/storage/{{ $post->image }}" alt="">
            </div>

            <!-- /.col-md-4 -->
            <div class="col-md-4">
                <img src="{{ $post->user->profile->profileImage() }}" alt="" style="width: 50px; height: 50px; border-radius: 50px;">
                <h3 class="float-right"> <a href="/profile/{{$post->user->id}}">{{$post->user->username}}</a></h3>
                    <hr>
                <p>{{$post->caption}}</p>
            </div>
            <!-- /.col-md-8 -->
        </div>
        <!-- /.row -->
    </div>
@endsection
