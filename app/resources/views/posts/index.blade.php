@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Posts from followers</h1>
       <div class="row">
           <div class="col-md-9">
               <div class="row">
                   @foreach ($posts as $post)
                       <div class="col-md-4">
                           <a href="/p/{{$post->id}}" class="card mb-4">
                               <img src="/storage/{{ $post->image }}" alt="">
                               <div class="card-body">
                                   <img src="{{ $post->user->profile->profileImage() }}" alt="" style="width: 50px; height: 50px; border-radius: 50px;">
                                   <span>{{$post->user->username}}</span>
                                   <hr>
                                   <p>{{$post->caption}}</p>
                               </div>
                               <!-- /.card-body -->
                           </a>
                           <!-- /.card -->
                       </div>

                       <!-- /.col-md-4 -->
                   @endforeach
               </div>
               <!-- /.row -->
               <div class="row">
                   <div class="col-md-12">
                       {{ $posts->links() }}
                   </div>
                   <!-- /.col-md-12 -->
               </div>
               <!-- /.row -->
           </div>
           <!-- /.col-md-9 -->
           <div class="col-md-3">
               <x-sidebar title="My Title" :content="$sidebarText" class="card">
                   <x-slot name="subtitle">subtitle</x-slot>
                   <div>Additional content</div>
               </x-sidebar>
           </div>
           <!-- /.col-md-3 -->
       </div>
       <!-- /.row -->
    </div>
@endsection
