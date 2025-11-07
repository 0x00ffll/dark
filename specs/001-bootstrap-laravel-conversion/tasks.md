# Tasks: Bootstrap Laravel Conversion

**Input**: Design documents from `/specs/001-bootstrap-laravel-conversion/`  
**Prerequisites**: plan.md, spec.md, research.md, data-model.md, contracts/  

**Organization**: Tasks are grouped by user story to enable independent implementation and testing of each story.

## Format: `[ID] [P?] [Story] Description`

- **[P]**: Can run in parallel (different files, no dependencies)
- **[Story]**: Which user story this task belongs to (e.g., US1, US2, US3)
- Include exact file paths in descriptions

## Implementation Strategy

**MVP Scope**: User Story 1 (Session-Based Authentication) delivers a working authentication system with Dashtrans login template.  
**Incremental Delivery**: Each user story builds upon the previous while remaining independently testable.  
**Parallel Opportunities**: Asset setup, component creation, and view development can run in parallel within each phase.

## Dependencies

**User Story Completion Order**:
1. **US1** (P1): Session-Based Authentication - Foundation for all admin access
2. **US2** (P2): Bootstrap UI Framework Integration - Builds on authenticated routes  
3. **US3** (P3): Reusable Page Components - Completes full admin panel experience

**Cross-Story Dependencies**: US2 and US3 require US1 authentication to be functional for testing protected routes.

## Phase 1: Setup (Shared Infrastructure)

**Purpose**: Project initialization and Dashtrans template asset integration

- [X] T001 Extract Dashtrans vertical template assets to public/assets/ directory preserving exact structure
- [X] T002 [P] Configure Laravel session driver to database in config/session.php for reliability
- [X] T003 [P] Create session table migration using php artisan session:table command
- [X] T004 [P] Update User model in app/Models/User.php to include avatar and designation fields for Dashtrans header
- [X] T005 [P] Create AssetService in app/Services/AssetService.php for Dashtrans asset URL generation and validation
- [X] T006 Run database migrations including session table and User model updates

## Phase 2: Foundational (Blocking Prerequisites)

**Purpose**: Core infrastructure needed by all user stories

- [X] T007 [P] Create authentication middleware in app/Http/Middleware/RedirectBasedOnAuth.php for root URL routing
- [X] T008 [P] Create base Blade layout component in app/View/Components/DashtransLayout.php
- [X] T009 [P] Create layout template in resources/views/components/dashtrans-layout.blade.php with complete Dashtrans HTML structure
- [X] T010 Register middleware alias in bootstrap/app.php for auth-based routing
- [X] T011 Configure authentication guards in config/auth.php for session-based authentication
- [X] T012 Validate Dashtrans asset structure using AssetService validateAssetStructure method

## Phase 3: User Story 1 - Session-Based Authentication (P1)

**Story Goal**: IPTV panel administrators can securely access the management system with automatic redirect based on session status

**Independent Test**: Visit root URL and verify redirect behavior, test login/logout flows, confirm session management works correctly

**Key Components**: Authentication controller, login view, session management, route protection

- [X] T013 [US1] Create LoginController in app/Http/Controllers/Auth/LoginController.php implementing AuthenticationController contract
- [X] T014 [P] [US1] Create login view in resources/views/auth/login.blade.php using Dashtrans login template structure  
- [X] T015 [P] [US1] Create dashboard controller in app/Http/Controllers/DashboardController.php for post-login redirect target
- [X] T016 [P] [US1] Create dashboard view in resources/views/dashboard.blade.php using DashtransLayout component
- [X] T017 [US1] Configure authentication routes in routes/web.php including login, logout, and dashboard routes
- [X] T018 [US1] Create exact replica of auth-basic-signin.html as Laravel Blade template with authentication integration  
- [X] T019 [US1] Implement login form validation and session creation in LoginController authenticate method
- [X] T020 [US1] Implement logout functionality with session destruction in LoginController logout method
- [X] T021 [US1] Configure authentication middleware protection for dashboard and admin routes
- [X] T022 [US1] Test authentication flow: unauthenticated root access, valid login, authenticated root access, logout

## Phase 4: User Story 2 - Bootstrap UI Framework Integration (P2)

**Story Goal**: Administrators have a modern, responsive interface using Dashtrans template without build tools

**Independent Test**: Access pages and verify Dashtrans styling, test responsive behavior, confirm no build process required

**Key Components**: Complete template integration, responsive layout, asset serving optimization

- [X] T023 [P] [US2] Create Sidebar component in app/View/Components/Sidebar.php implementing SidebarComponent contract
- [X] T024 [P] [US2] Create sidebar template in resources/views/components/sidebar.blade.php with MetisMenu navigation structure
- [X] T025 [P] [US2] Create HeaderTopbar component in app/View/Components/HeaderTopbar.php implementing HeaderTopbarComponent contract  
- [X] T026 [P] [US2] Create header template in resources/views/components/header-topbar.blade.php with search, notifications, user menu
- [X] T027 [P] [US2] Create PageWrapper component in app/View/Components/PageWrapper.php implementing PageWrapperComponent contract
- [X] T028 [P] [US2] Create page wrapper template in resources/views/components/page-wrapper.blade.php with breadcrumbs and content area
- [X] T029 [US2] Update DashtransLayout component to integrate Sidebar, HeaderTopbar, and PageWrapper components
- [X] T030 [US2] Update dashboard view to use PageWrapper component with proper page title and breadcrumbs
- [X] T031 [US2] Configure asset URLs in templates using AssetService for proper Dashtrans CSS/JS loading
- [X] T032 [US2] Test template integration: verify exact Dashtrans appearance, responsive behavior, MetisMenu navigation
- [X] T033 [US2] Validate asset serving: all CSS/JS loads correctly, no 404 errors, proper MIME types

## Phase 5: User Story 3 - Reusable Page Components (P3)

**Story Goal**: Administrators have consistent navigation and layout across dashboard, profile, and settings pages

**Independent Test**: Navigate between admin pages to verify shared navigation and consistent layout elements

**Key Components**: Multiple admin pages, shared navigation state, consistent component usage

- [X] T034 [P] [US3] Create ProfileController in app/Http/Controllers/ProfileController.php for user profile management
- [X] T035 [P] [US3] Create SettingsController in app/Http/Controllers/SettingsController.php for application settings
- [X] T036 [P] [US3] Create profile view in resources/views/profile.blade.php using PageWrapper component
- [X] T037 [P] [US3] Create settings view in resources/views/settings.blade.php using PageWrapper component
- [X] T038 [US3] Configure profile and settings routes in routes/web.php with authentication middleware
- [X] T039 [US3] Implement navigation menu in Sidebar component with dashboard, profile, and settings links
- [X] T040 [US3] Add active route highlighting in Sidebar component based on current request route
- [X] T041 [US3] Update HeaderTopbar component with user profile data from authenticated user
- [X] T042 [US3] Implement user profile dropdown in HeaderTopbar with profile and logout links  
- [X] T043 [US3] Test navigation consistency: verify shared elements across pages, active state highlighting, profile data display
- [X] T044 [US3] Test page transitions: dashboard → profile → settings → dashboard, verify layout consistency

## Phase 6: Polish & Cross-Cutting Concerns

**Purpose**: Final optimizations and production readiness

- [X] T045 [P] Create feature tests in tests/Feature/AuthenticationFlowTest.php for complete login/logout/session flow
- [X] T046 [P] Create feature tests in tests/Feature/ComponentRenderingTest.php for Blade component output validation
- [X] T047 [P] Create feature tests in tests/Feature/DashtransIntegrationTest.php for template structure validation
- [X] T048 [P] Optimize asset loading order in DashtransLayout template for performance
- [X] T049 [P] Add CSRF token validation to all forms in login and admin views  
- [X] T050 [P] Configure session timeout handling and graceful logout for expired sessions
- [X] T051 [P] Add error handling for asset loading failures with fallback messaging
- [X] T052 [P] Validate accessibility compliance in Dashtrans template integration
- [X] T053 Run complete test suite and verify all success criteria are met
- [X] T054 Performance testing: verify <100ms auth, <500ms page loads, <1s dashboard initialization

## Parallel Execution Examples

### User Story 1 Tasks (Can Run in Parallel):
- T014 (login view), T015 (dashboard controller), T016 (dashboard view) - Different files, no dependencies

### User Story 2 Tasks (Can Run in Parallel):  
- T023-T028 (all component creation) - Different component files, independent implementation

### User Story 3 Tasks (Can Run in Parallel):
- T034-T037 (controller and view creation) - Different files, no shared dependencies

## Testing Strategy

Each user story includes integrated testing as part of the final task in each phase:
- **US1**: Authentication flow testing (T022)
- **US2**: Template integration and responsive testing (T032-T033)  
- **US3**: Navigation consistency and page transition testing (T043-T044)

Final testing phase includes comprehensive feature tests for regression prevention and production readiness validation.

## Success Metrics per Story

**US1 Success**: Users complete login in <30s, authenticated users reach dashboard in <2s, session management reliable for 8 hours
**US2 Success**: Pages load in <3s, interface displays correctly 320px-2560px, components render identically across browsers  
**US3 Success**: 95% navigation actions complete successfully, consistent layout across dashboard/profile/settings pages

**Total Tasks**: 54  
**US1 Tasks**: 10 (T013-T022)  
**US2 Tasks**: 11 (T023-T033)  
**US3 Tasks**: 11 (T034-T044)  
**Setup/Foundation**: 12 (T001-T012)  
**Polish**: 10 (T045-T054)

**Suggested MVP**: Complete Phase 3 (US1) for functional authentication system with Dashtrans login template.