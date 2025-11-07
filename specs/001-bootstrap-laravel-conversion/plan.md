# Implementation Plan: Bootstrap Laravel Conversion

**Branch**: `001-bootstrap-laravel-conversion` | **Date**: 2025-11-07 | **Spec**: [spec.md](./spec.md)
**Input**: Feature specification from `/specs/001-bootstrap-laravel-conversion/spec.md`

**Note**: This template is filled in by the `/speckit.plan` command. See `.specify/templates/commands/plan.md` for the execution workflow.

## Summary

Convert Dashtrans vertical Bootstrap template to Laravel with session-based authentication and reusable Blade components. Implementation includes exact template structure replication with wrapper/sidebar/header/page-content components, Laravel Auth integration for session management, and asset serving from public/assets/ directory without build tools.

## Technical Context

**Language/Version**: PHP 8.2+ with Laravel 11.x  
**Primary Dependencies**: Laravel Sanctum (auth), Bootstrap 5.3 (template integration), MySQL 8.0 (database)  
**Template Framework**: Dashtrans vertical admin template with MetisMenu navigation, SimpleBars scrolling  
**Storage**: MySQL for relational data and sessions, file storage for template assets and logs  
**Testing**: PHPUnit with Laravel feature tests, Pest for modern testing syntax  
**Target Platform**: Linux server (Ubuntu/CentOS) with Apache/Nginx + PHP-FPM  
**Project Type**: Web application with session-based admin panel for IPTV streaming management  
**Performance Goals**: <100ms authentication, <500ms page loads, <1s dashboard initialization  
**Constraints**: Exact Dashtrans template replication, no build tools, direct asset serving  
**Asset Management**: Serve CSS/JS/images from public/assets/ maintaining template directory structure  
**Component Architecture**: 4 main Blade components (Layout, Sidebar, HeaderTopbar, PageWrapper)  
**Authentication**: Laravel session-based with middleware protection, user profile integration  
**Template Integration**: MetisMenu collapsible navigation, SimpleBars custom scrolling, header dropdowns

## Constitution Check

*GATE: Must pass before Phase 0 research. Re-check after Phase 1 design.*

✅ **Security-First Development**: 
- Session-based authentication with Laravel Auth
- CSRF protection on all forms  
- Input validation in controllers
- Protected routes with auth middleware
- User credential validation and hashing

✅ **Real-Time Performance**: 
- <100ms authentication with session lookup
- <500ms page loads with template asset optimization
- <1s dashboard initialization with minimal database queries
- Efficient asset serving from public/assets/
- Template CSS/JS optimized and minified

✅ **Data Integrity**: 
- Database sessions for reliability
- User model with proper validation rules
- Session table for authentication state
- Password hashing and remember token security
- Referential integrity maintained

✅ **Laravel Best Practices**: 
- Blade component architecture for template integration
- Eloquent User model with authentication
- Controller-based authentication flow
- Middleware for route protection
- Feature tests for authentication flow and component rendering

✅ **Monitoring & Observability**: 
- User activity logging through Laravel logs
- Authentication attempt tracking
- Session management monitoring
- Error logging for debugging
- Structured logging with user context

**Post-Design Validation**: All constitutional requirements satisfied with Dashtrans template integration. No violations detected.

## Project Structure

### Documentation (this feature)

```text
specs/[###-feature]/
├── plan.md              # This file (/speckit.plan command output)
├── research.md          # Phase 0 output (/speckit.plan command)
├── data-model.md        # Phase 1 output (/speckit.plan command)
├── quickstart.md        # Phase 1 output (/speckit.plan command)
├── contracts/           # Phase 1 output (/speckit.plan command)
└── tasks.md             # Phase 2 output (/speckit.tasks command - NOT created by /speckit.plan)
```

### Source Code (repository root)

```text
app/
├── Http/Controllers/
│   ├── Auth/LoginController.php      # Session-based authentication
│   └── DashboardController.php       # Main admin dashboard
├── View/Components/
│   ├── DashtransLayout.php          # Main template wrapper component
│   ├── Sidebar.php                  # MetisMenu navigation component  
│   ├── HeaderTopbar.php             # Header with search/notifications/user menu
│   └── PageWrapper.php              # Page content wrapper component
├── Services/AssetService.php        # Dashtrans asset management service
└── Models/User.php                  # Extended for profile data (avatar, designation)

resources/views/
├── auth/login.blade.php             # Dashtrans login page template
├── dashboard.blade.php              # Main dashboard using components
└── components/
    ├── dashtrans-layout.blade.php   # Complete HTML wrapper
    ├── sidebar.blade.php            # Sidebar navigation with MetisMenu
    ├── header-topbar.blade.php      # Header topbar with dropdowns
    └── page-wrapper.blade.php       # Page content area

public/assets/                       # Dashtrans template assets
├── css/
│   ├── bootstrap.min.css           # Template's Bootstrap version
│   ├── bootstrap-extended.css      # Dashtrans extensions
│   ├── app.css                     # Main template styles
│   └── icons.css                   # Icon fonts
├── js/
│   ├── bootstrap.min.js            # Bootstrap functionality
│   ├── app.js                      # Main template JavaScript
│   └── pace.min.js                 # Loading progress bar
├── plugins/
│   ├── metismenu/                  # Collapsible navigation
│   ├── simplebar/                  # Custom scrollbars
│   └── perfect-scrollbar/          # Scroll enhancement
└── images/
    ├── logo-icon.png               # Sidebar logo
    └── avatars/                    # User profile images

tests/Feature/
├── AuthenticationFlowTest.php       # Login/logout/session flow tests
├── ComponentRenderingTest.php       # Blade component output tests
└── DashtransIntegrationTest.php     # Template structure validation tests
```

**Structure Decision**: Web application structure selected for Laravel-based IPTV admin panel. Uses standard Laravel MVC with Blade component architecture for Dashtrans template integration. Asset management through public/assets/ directory maintains exact template structure without build process.

## Complexity Tracking

> **Fill ONLY if Constitution Check has violations that must be justified**

| Violation | Why Needed | Simpler Alternative Rejected Because |
|-----------|------------|-------------------------------------|
| [e.g., 4th project] | [current need] | [why 3 projects insufficient] |
| [e.g., Repository pattern] | [specific problem] | [why direct DB access insufficient] |
