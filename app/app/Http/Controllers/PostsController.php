<?php

namespace App\Http\Controllers;

use App\Posts;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class PostsController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct ()
    {
        $this->middleware( 'auth' );
    }

    public function index ()
    {
        // now get the user ids from the users the logged in user is following
        $users = auth()->user()->following()->pluck( 'profiles.user_id' );
        // Get posts from the users
        // $posts = Posts::whereIn( 'user_id', $users )->orderBy( 'created_at', 'DESC' )->get();
        // Get posts from the users with pagination
        $posts = Posts::whereIn( 'user_id', $users )->with( 'user' )->orderBy( 'created_at', 'DESC' )->paginate( 4 );
        //dd( $posts );
        $sidebarText = 'Lorem ipsum dolor sit amet';
        return view( 'posts.index', compact( 'posts', 'sidebarText' ) );
    }

    //
    public function create ()
    {
        return view( 'posts.create' );
    }

    public function store ()
    {
        $data = request()->validate( [
            'caption' => 'required',
            'image'   => [ 'required', 'image' ]
        ] );

        // move file and get string which will be saved to the database
        $imagePath = request( 'image' )->store( 'uploads', 'public' );

        $image = Image::make( public_path( "storage/{$imagePath}" ) )->fit( 200, 200 );
        $image->save();

        auth()->user()->posts()->create( [
            'caption' => $data[ 'caption' ],
            'image'   => $imagePath
        ] );

        // dd( request()->all() );
        return redirect( '/profile/' . auth()->user()->id );
    }

    public function show ( \App\Posts $post )
    {
        return view( 'posts.show', compact( 'post' ) );
    }


}
