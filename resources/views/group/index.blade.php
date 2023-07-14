@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">{{ __('Groups') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div class="row">
                            @forelse ($groups as $group)
                                <div class="col-md-4 my-2">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4>
                                                <strong>
                                                    <a href="{{ route('groups.show', $group) }}">{{ $group->name }}</a>
                                                </strong>
                                            </h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="card-title">
                                                <ul class="list-group mb-3">
                                                    @forelse ($group->users as $user)
                                                        <li class="list-group-item">{{ $user->name }}</li>
                                                    @empty
                                                        <p class="text-danger text-center">
                                                            <strong>
                                                                <small>Please Join this group!</small>
                                                            </strong>
                                                        </p>
                                                    @endforelse
                                                </ul>
                                                <div class="d-flex justify-content-between">
                                                    @can('join-group', $group)
                                                        <a href="{{ route('groups.joinGroup', $group) }}" id="joinGroupButton"
                                                            data-group-id="{{ $group->id }}"
                                                            class="btn btn-sm btn-primary">Join Group</a>
                                                    @else
                                                        <a href="{{ route('groups.leaveGroup', $group) }}" id="leaveGroupButton"
                                                            class="btn btn-sm btn-danger"
                                                            data-group-id="{{ $group->id }}">Leave Group</a>
                                                    @endcan
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
