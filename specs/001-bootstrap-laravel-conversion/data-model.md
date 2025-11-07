# Data Model: Bootstrap Laravel Conversion

**Feature**: Bootstrap Laravel Conversion  
**Date**: 2025-11-07  
**Purpose**: Define data entities and relationships for Dashtrans template integration and authentication

## Core Entities

### User
**Purpose**: Represents IPTV panel administrators with authentication credentials

**Fields**:
- `id` (Primary Key): Unique identifier
- `name` (String): Administrator display name for Dashtrans header
- `email` (String, Unique): Login credential and contact
- `email_verified_at` (Timestamp, Nullable): Email verification status
- `password` (String, Hashed): Authentication credential
- `avatar` (String, Nullable): Profile image path for Dashtrans user dropdown
- `designation` (String, Nullable): Job title displayed in Dashtrans header (e.g., "Web Designer")
- `remember_token` (String, Nullable): Persistent login token
- `created_at` (Timestamp): Account creation time
- `updated_at` (Timestamp): Last modification time

**Validation Rules**:
- Email: Required, valid email format, unique across users
- Password: Required, minimum 8 characters, must be hashed
- Name: Required, maximum 255 characters
- Avatar: Nullable, valid image file path
- Designation: Nullable, maximum 100 characters

**Relationships**: None (single entity for MVP)

**State Transitions**:
- Created → Email Verified (optional)
- Logged Out → Logged In (via authentication)
- Logged In → Logged Out (via logout action)

### Session
**Purpose**: Laravel-managed authentication sessions (handled by framework)

**Fields** (Laravel session table):
- `id` (String): Session identifier
- `user_id` (BigInt, Nullable): Associated user ID when authenticated
- `ip_address` (String, Nullable): Client IP address
- `user_agent` (Text, Nullable): Browser/client information
- `payload` (Text): Serialized session data
- `last_activity` (Integer): Timestamp of last activity

**Relationships**:
- Belongs to User (when authenticated)

**Lifecycle**:
- Created on first visit
- Updated on each request
- Destroyed on logout or timeout
- Garbage collected after expiration

## Dashtrans Component State Management

### Sidebar Navigation Component
**Purpose**: Metismenu-based navigation state for Dashtrans sidebar

**Props/State**:
- `current_route` (String): Active page identifier for menu highlighting
- `menu_items` (Array): Hierarchical navigation structure with icons and routes
- `collapsed_state` (Boolean): Whether sidebar is collapsed on mobile
- `active_parents` (Array): Parent menu items that should be expanded

**Menu Item Structure**:
```php
[
    'title' => 'Dashboard',
    'icon' => 'bx bx-home-alt',
    'route' => 'dashboard',
    'children' => [
        ['title' => 'eCommerce', 'route' => 'dashboard.ecommerce'],
        ['title' => 'Analytics', 'route' => 'dashboard.analytics']
    ]
]
```

### Header Topbar Component
**Purpose**: Dashtrans header with search, notifications, and user menu

**Props/State**:
- `user_name` (String): Current user's display name
- `user_designation` (String): User's job title
- `user_avatar` (String): Profile image URL
- `notification_count` (Integer): Unread notification count
- `message_count` (Integer): Unread message count
- `cart_items` (Array): Shopping cart items for demo purposes

**Notification Structure**:
```php
[
    'id' => 1,
    'type' => 'message|order|system',
    'title' => 'New Orders',
    'message' => 'You have received new orders',
    'time_ago' => '2 min ago',
    'avatar' => 'path/to/avatar.png'
]
```

### Page Wrapper Component
**Purpose**: Main content area within Dashtrans page-wrapper

**Props/State**:
- `page_title` (String): Page heading for breadcrumbs
- `breadcrumbs` (Array): Navigation breadcrumb trail
- `body_class` (String): Additional CSS classes for page-specific styling

## Dashtrans Asset Management

### Asset Dependencies
**Purpose**: Track Dashtrans template asset requirements

**CSS Dependencies**:
- `bootstrap.min.css` (Template's Bootstrap version)
- `bootstrap-extended.css` (Dashtrans extensions)
- `app.css` (Main template styles)
- `icons.css` (Icon fonts and styling)
- `pace.min.css` (Loading progress bar)

**JavaScript Dependencies**:
- `pace.min.js` (Page loading progress)
- `bootstrap.min.js` (Bootstrap functionality)
- `app.js` (Main template JavaScript)

**Plugin Dependencies**:
- `simplebar` (Custom scrollbars)
- `perfect-scrollbar` (Scroll enhancement)
- `metismenu` (Collapsible navigation)
- `datatable` (Table enhancements)

## Performance Considerations

### Database Queries
- User lookup by email during authentication (indexed)
- Session validation on each request (framework optimized)
- No complex joins required for template integration

### Template Asset Loading
- All Dashtrans assets served from public/assets/
- CSS files loaded in specific order for proper styling
- JavaScript files loaded after DOM ready for functionality
- Images and icons cached by browser for performance

### Component Rendering
- Blade template compilation caching (Laravel default)
- Dashtrans HTML structure cached for repeated use
- User data injected into cached template structure
- Minimal database queries for template population