<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\RoleResource;
use App\Http\Resources\UserResource;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $usersQuery = User::query();

        $this->applySearch($usersQuery, $request->search);
        $this->applySort($usersQuery, $request->sort);
        $this->applyFilter($usersQuery, $request->filter);

        $users = UserResource::collection($usersQuery->paginate(10));

        return inertia('Admin/Users/Index', [
            'users' => $users,
            'search' => $request->search ?? '',
        ]);
    }

    protected function applySearch(Builder $query, $search)
    {
        return $query->when($search, function ($query, $search) {
            $query->where('name', 'like', '%' . $search . '%')
                ->orWhere('email', 'like', '%' . $search . '%');
        });
    }

    protected function applySort(Builder $query, $sort)
    {
        return $query->when($sort, function ($query, $sort) {
            $direction = $sort === 'asc' ? 'asc' : 'desc';
            $query->orderBy('name', $direction);
        });
    }

    protected function applyFilter(Builder $query, $filter)
    {
        return $query->when($filter, function ($query, $filter) {
            $roles = explode(',', $filter);
            $query->whereIn('role_id', $roles);
        });
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = RoleResource::collection(Role::all());

        return inertia('Admin/Users/Create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        // Merge additional data into the request
        $request->merge([
            'email_verified_at' => now(),
            'password' => Hash::make($request->password),
            'remember_token' => Str::random(10),
        ]);

        // Create the user with the merged data
        User::create($request->all());

        // Redirect to the users index page
        return redirect()->route('users.index');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $roles = RoleResource::collection(Role::all());

        return inertia('Admin/Users/Edit', [
            'roles' => $roles,
            'user' => UserResource::make($user),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $user->update($request->validated());

        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index');
    }
}
