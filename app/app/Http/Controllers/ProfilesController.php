<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Intervention\Image\Facades\Image;

class ProfilesController extends Controller
{
    public function index ( $user )
    {
        // if user is authenticated, then check if authenticated user is following the user (contains)
        $follows = ( auth()->user() ) ? auth()->user()->following->contains( $user ) : false;
        //dd( $follows );
        $user = User::findOrFail( $user );

        $postCount      = Cache::remember(
            'count.posts.' . $user->id,
            now()->addSeconds( 30 ),
            function () use ( $user ) {
                return $user->posts->count();
            } );
        $followersCount = Cache::remember(
            'count.followersCount.' . $user->id,
            now()->addSeconds( 30 ),
            function () use ( $user ) {
                return $user->profile->followers->count();
            } );
        $followingCount =Cache::remember(
            'count.followingCount.' . $user->id,
            now()->addSeconds( 30 ),
            function () use ( $user ) {
                return  $user->following->count();
            } );

        return view( 'profiles.index', [
            'user'           => $user,
            'follows'        => $follows,
            'postCount'      => $postCount,
            'followersCount' => $followersCount,
            'followingCount' => $followingCount
        ] );
    }

    public function edit ( \App\User $user )
    {
        $this->authorize( 'update', $user->profile );
        return view( 'profiles.edit', compact( 'user' ) );
    }

    public function update ( \App\User $user )
    {
        $this->authorize( 'update', $user->profile );
        $data = request()->validate( [
            'title'       => 'required',
            'description' => 'required',
            'url'         => 'url',
            'image'       => ''
        ] );
        //dd( $data );

        if ( request( 'image' ) ) {
            // move file and get string which will be saved to the database
            $imagePath = request( 'image' )->store( 'profile', 'public' );
            $image     = Image::make( public_path( "storage/{$imagePath}" ) )->fit( 100, 100 );
            $image->save();
            $imageArray = [ 'image' => $imagePath ];
        }

        // Edit profile of given ID
        //$user->profile->update( $data );
        // Only edit your own profile
        auth()->user()->profile->update( array_merge(
            $data,
            $imageArray ?? []
        ) );

        return redirect( "/profile/{$user->id}" );
    }
}
