@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <!-- /.btn btn-primary float-right -->
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <BR/>
                        <img src="{{ $user->profile->profileImage() }}" alt="" class="float-left mr-2" style="width: 100px; height: 100px; border-radius: 50px;">

                        <h1>{{ $user->username }}</h1>
                        <p><strong>{{ $user->profile->title ?? '' }}</strong><BR/>{{ $user->profile->description  }}</p>
                        @can('update', $user->profile )
                            <a href="/profile/{{ $user->profile->id }}/edit" class="btn btn-secondary float-left mr-2">Edit profile</a>
                        @endcan
                        <follow-button user-id="{{ $user->id  }}" follows="{{ $follows }}"></follow-button>
                        <hr>
                        <div class="row">
                            <div class="col-md-4">
                                posts<BR/>
                                {{ $postCount  }}
                            </div>
                            <!-- /.col-md-4 -->
                            <div class="col-md-4">
                                followers<BR/>
                                {{ $followersCount }}
                            </div>
                            <!-- /.col-md-4 -->
                            <div class="col-md-4">
                                following<BR/>
                                {{ $followingCount  }}
                            </div>
                            <!-- /.col-md-4 -->
                        </div>
                        <!-- /.row -->
                        <hr>
                        <a href="#">{{ $user->profile->url ?? 'N/A' }}</a>
                    </div>
                </div>
            </div>
        </div>
        <h2 class="mt-4">Posts</h2>
        <div class="row">
            @foreach($user->posts as $post)
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            {{ $post->caption }}
                        </div>
                        <!-- /.card-header -->
                        <a href="/p/{{ $post->id  }}">
                            <img src="/storage/{{ $post->image }}" alt="" style="width: 100%">
                        </a>
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col-md-4 -->
            @endforeach
        </div>
        <!-- /.row -->
    </div>
@endsection
