# Component Contracts

**Feature**: Bootstrap Laravel Conversion  
**Date**: 2025-11-07  
**Purpose**: Define reusable Blade component interfaces and expected behaviors

## Layout Component

### Component: `<x-layout>`
**Purpose**: Base page structure with Bootstrap integration and common elements

**Props**:
```php
$title: string                 // Page title for <title> tag and header
$bodyClass: string = ''        // Additional CSS classes for <body>
$breadcrumbs: array = []       // Breadcrumb navigation array
```

**Slot**: `$slot` - Main page content area

**Generated HTML Structure**:
```html
<!DOCTYPE html>
<html>
<head>
    <title>{$title} - VENOM IPTV Panel</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/app.css" rel="stylesheet">
</head>
<body class="{$bodyClass}">
    <x-navigation />
    
    <main class="container-fluid">
        @if($breadcrumbs)
            <x-breadcrumbs :items="$breadcrumbs" />
        @endif
        
        {!! $slot !!}
    </main>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
```

**Dependencies**: Navigation component, optional Breadcrumbs component

---

## Navigation Component

### Component: `<x-navigation>`
**Purpose**: Consistent admin navigation across all authenticated pages

**Props**: None (uses Auth facade internally)

**Generated HTML Structure**:
```html
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="/dashboard">VENOM IPTV Panel</a>
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link {active class}" href="/dashboard">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {active class}" href="/profile">Profile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {active class}" href="/settings">Settings</a>
                </li>
            </ul>
            
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                        {{ Auth::user()->name }}
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="/profile">Profile</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form method="POST" action="/logout">
                                @csrf
                                <button class="dropdown-item" type="submit">Logout</button>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
```

**Behavior**:
- Highlights current page with `.active` class
- Shows authenticated user name in dropdown
- Provides logout functionality with CSRF protection
- Responsive collapse for mobile devices

---

## Admin Panel Component

### Component: `<x-admin-panel>`
**Purpose**: Common admin page structure with sidebar and content area

**Props**:
```php
$pageTitle: string             // Page heading
$sidebarContent: string = ''   // Optional sidebar content
```

**Slot**: `$slot` - Main content area

**Generated HTML Structure**:
```html
<div class="row">
    <div class="col-md-3 col-lg-2">
        <div class="sidebar bg-light p-3">
            @if($sidebarContent)
                {!! $sidebarContent !!}
            @else
                <h6>Quick Actions</h6>
                <div class="list-group">
                    <a href="/dashboard" class="list-group-item list-group-item-action">
                        Dashboard
                    </a>
                    <a href="/profile" class="list-group-item list-group-item-action">
                        Profile
                    </a>
                    <a href="/settings" class="list-group-item list-group-item-action">
                        Settings
                    </a>
                </div>
            @endif
        </div>
    </div>
    
    <div class="col-md-9 col-lg-10">
        <div class="content p-4">
            <h1 class="mb-4">{{ $pageTitle }}</h1>
            {!! $slot !!}
        </div>
    </div>
</div>
```

**Usage Pattern**:
```php
<x-layout title="Dashboard">
    <x-admin-panel page-title="Admin Dashboard">
        <!-- Dashboard content here -->
    </x-admin-panel>
</x-layout>
```

---

## Alert Component

### Component: `<x-alert>`
**Purpose**: Display success, error, and informational messages

**Props**:
```php
$type: string = 'info'         // Bootstrap alert type: success, danger, warning, info
$dismissible: bool = true      // Whether alert can be dismissed
```

**Slot**: `$slot` - Alert message content

**Generated HTML Structure**:
```html
<div class="alert alert-{{ $type }} @if($dismissible) alert-dismissible fade show @endif" role="alert">
    {!! $slot !!}
    
    @if($dismissible)
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    @endif
</div>
```

**Usage Examples**:
```php
<x-alert type="success">User profile updated successfully!</x-alert>
<x-alert type="danger" :dismissible="false">Invalid credentials provided.</x-alert>
```

## Component Integration Patterns

### Controller Usage
```php
public function dashboard()
{
    return view('dashboard', [
        'userCount' => User::count(),
        'systemStatus' => 'operational'
    ]);
}
```

### View Usage
```blade
<x-layout title="Dashboard">
    <x-admin-panel page-title="IPTV Admin Dashboard">
        @if(session('success'))
            <x-alert type="success">{{ session('success') }}</x-alert>
        @endif
        
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">System Status</h5>
                        <p class="card-text">{{ $systemStatus }}</p>
                    </div>
                </div>
            </div>
        </div>
    </x-admin-panel>
</x-layout>
```

### Performance Characteristics
- Components render server-side (no JavaScript overhead)
- Bootstrap classes applied directly (no CSS-in-JS)
- Minimal prop processing for fast rendering
- Cached Blade compilation for production performance