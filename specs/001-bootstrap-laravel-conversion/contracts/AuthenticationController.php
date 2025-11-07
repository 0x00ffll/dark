<?php

namespace App\Http\Controllers\Contracts;

/**
 * Authentication Controller Contract for Laravel Integration
 * 
 * This contract defines the interface for authentication controllers
 * that handle login, logout, and session management for the IPTV panel.
 * 
 * Requirements:
 * - Must integrate with Laravel's Auth system
 * - Must render Dashtrans login template
 * - Must handle session-based authentication
 * - Must redirect properly after authentication state changes
 */
interface AuthenticationController
{
    /**
     * Display the login form
     * 
     * Renders Dashtrans login page with:
     * - Clean login form design
     * - Proper form validation display
     * - CSRF token protection
     * - Remember me functionality
     * 
     * @return \Illuminate\View\View
     */
    public function showLoginForm();

    /**
     * Handle user authentication attempt
     * 
     * Processes login request with:
     * - Email/password validation
     * - Laravel Auth::attempt() integration
     * - Remember me token handling
     * - Failed attempt rate limiting
     * 
     * @param \Illuminate\Http\Request $request Login form data
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(\Illuminate\Http\Request $request);

    /**
     * Log the user out of the application
     * 
     * Handles logout process:
     * - Session invalidation
     * - Remember token removal
     * - CSRF token regeneration
     * - Redirect to login page
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(\Illuminate\Http\Request $request);

    /**
     * Validate login request data
     * 
     * Validates:
     * - Email format and presence
     * - Password minimum requirements
     * - CSRF token validity
     * - Rate limiting compliance
     * 
     * @param \Illuminate\Http\Request $request
     * @return array Validated data
     * @throws \Illuminate\Validation\ValidationException
     */
    public function validateLogin(\Illuminate\Http\Request $request): array;

    /**
     * Handle successful authentication
     * 
     * Post-login actions:
     * - Session regeneration for security
     * - User activity logging
     * - Intended URL redirection
     * - Welcome flash message
     * 
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\User $user Authenticated user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function authenticated(\Illuminate\Http\Request $request, $user);

    /**
     * Handle failed authentication attempt
     * 
     * Failed login handling:
     * - Validation error display
     * - Rate limiting increment
     * - Security logging
     * - Form data preservation (except password)
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function sendFailedLoginResponse(\Illuminate\Http\Request $request);

    /**
     * Get redirect URL after successful login
     * 
     * Determines redirect target:
     * - Intended URL from session
     * - Default dashboard route
     * - User role-based routing
     * 
     * @return string Redirect URL
     */
    public function redirectTo(): string;

    /**
     * Check if user should be remembered
     * 
     * Handles remember me functionality:
     * - Form checkbox validation
     * - Remember token generation
     * - Cookie expiration settings
     * 
     * @param \Illuminate\Http\Request $request
     * @return bool True if user should be remembered
     */
    public function shouldRemember(\Illuminate\Http\Request $request): bool;

    /**
     * Apply rate limiting to login attempts
     * 
     * Prevents brute force attacks:
     * - Email-based rate limiting
     * - IP-based rate limiting
     * - Progressive delay increases
     * - Lockout duration management
     * 
     * @param \Illuminate\Http\Request $request
     * @return bool True if request is within limits
     */
    public function hasTooManyLoginAttempts(\Illuminate\Http\Request $request): bool;
}