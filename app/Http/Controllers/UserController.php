<?php

namespace App\Http\Controllers;

use App\Contracts\CounterContract;
use App\Facades\CounterFacade;
use App\Http\Requests\UpdateUser;
use App\Models\Image;
use App\Models\User;
use App\Services\Counter;
use Illuminate\Http\Request;

class UserController extends Controller
{   
    // private $counter;
    //1 . We use dependency injection here to avoid explicitly 
    //calling the service container

    //We remove the concretion and depend on the abstraction by the newly created CounterContract interface
    //public function __construct(CounterContract $counter)
    public function __construct()
    {
        $this->middleware('auth');
        $this->authorizeResource(User::class, 'user');
        // $this->counter = $counter;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //Using a service to let
        //user how many people are
        //seeing your post
        //Calling service container
        // $counter = resolve(Counter::class);

        

        return view('users.show', [
            'user' => $user,
            //2 . We do not need to resolve the for the Counter instance

            /** 
             * Replacing counter concretion for facade
             * 'counter' => $this->counter->increment("user-{$user->id}")
             */

            'counter' => CounterFacade::increment("user-{$user->id}"),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
        return view('users.edit', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUser $request, User $user)
    {
        //

        if ($request->hasFile('avatar')) {
            $path = $request->file('avatar')->store('avatars');

            if ($user->image) {
                $user->image->path = $path;
                $user->image->save();
            } else {
                $user->image()->save(
                    Image::make(['path' => $path])
                );
            }
        }

        $user->locale = $request->get('locale');
        $user->save();

        return redirect()->back()->withStatus(__('Profile image was updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
