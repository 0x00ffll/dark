@extends('layouts.app')

@section('title', 'Placeholder - VENOM IPTV Admin')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card radius-10">
            <div class="card-body text-center">
                <div class="py-5">
                    <img src="{{ asset('assets/images/icons/placeholder.png') }}" alt="Placeholder" width="128" class="mb-4">
                    <h3 class="mb-3">Placeholder Page</h3>
                    <p class="text-muted mb-4">This is a placeholder page for future features and functionality.</p>
                    <div class="row row-cols-1 row-cols-md-3 g-4 mt-4">
                        <div class="col">
                            <div class="card h-100">
                                <div class="card-body text-center">
                                    <div class="text-primary mb-3">
                                        <i class="bx bx-tv fs-1"></i>
                                    </div>
                                    <h5>Channel Management</h5>
                                    <p class="text-muted">Manage IPTV channels, categories, and streaming sources</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col">
                            <div class="card h-100">
                                <div class="card-body text-center">
                                    <div class="text-success mb-3">
                                        <i class="bx bx-user-plus fs-1"></i>
                                    </div>
                                    <h5>User Management</h5>
                                    <p class="text-muted">Handle user accounts, subscriptions, and access control</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col">
                            <div class="card h-100">
                                <div class="card-body text-center">
                                    <div class="text-warning mb-3">
                                        <i class="bx bx-server fs-1"></i>
                                    </div>
                                    <h5>Server Management</h5>
                                    <p class="text-muted">Monitor and configure streaming servers and load balancing</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mt-5">
                        <a href="{{ route('dashboard') }}" class="btn btn-primary btn-lg me-3">Back to Dashboard</a>
                        <a href="#" class="btn btn-outline-secondary btn-lg">Documentation</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection