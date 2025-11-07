<?php

namespace App\View\Components\Contracts;

/**
 * Header Topbar Component Contract for Dashtrans Template
 * 
 * This contract defines the interface for the Dashtrans header topbar component
 * that provides search functionality, notifications, user menu, and responsive controls.
 * 
 * Requirements:
 * - Must render Dashtrans header HTML structure exactly
 * - Must display authenticated user information
 * - Must handle responsive toggle for mobile sidebar
 * - Must support notification and message dropdowns
 */
interface HeaderTopbarComponent
{
    /**
     * Initialize header topbar component with user and notification data
     *
     * @param User $user Authenticated user for profile display
     * @param int $notificationCount Unread notification count
     * @param int $messageCount Unread message count
     * @param array $notifications Recent notifications for dropdown
     * @param array $messages Recent messages for dropdown
     */
    public function __construct(
        object $user,
        int $notificationCount = 0,
        int $messageCount = 0,
        array $notifications = [],
        array $messages = []
    );

    /**
     * Render the Dashtrans header topbar HTML structure
     * 
     * Must include:
     * - Mobile toggle button for sidebar
     * - Search form with proper styling
     * - Notification dropdown with count badge
     * - Messages dropdown with count badge
     * - User profile dropdown with avatar and actions
     * 
     * @return \Illuminate\View\View
     */
    public function render();

    /**
     * Get user profile data for header display
     * 
     * Returns array with:
     * - Display name (formatted)
     * - Designation/job title
     * - Avatar URL (with fallback)
     * - Profile edit URL
     * - Logout URL
     * 
     * @return array User profile data
     */
    public function getUserProfileData(): array;

    /**
     * Format notification data for dropdown display
     * 
     * Processes raw notification data into:
     * - Formatted time stamps (2 min ago, 1 hour ago)
     * - Truncated message text
     * - Icon classes based on notification type
     * - Read/unread styling classes
     * 
     * @param array $notifications Raw notification data
     * @return array Formatted notification data
     */
    public function formatNotifications(array $notifications): array;

    /**
     * Format message data for dropdown display
     * 
     * Processes raw message data into:
     * - Sender avatar with fallback
     * - Truncated message preview
     * - Formatted timestamp
     * - Read/unread status classes
     * 
     * @param array $messages Raw message data
     * @return array Formatted message data
     */
    public function formatMessages(array $messages): array;

    /**
     * Generate notification badge HTML
     * 
     * Creates Bootstrap badge element with:
     * - Dynamic count display
     * - Proper color scheme (danger for high counts)
     * - Hidden state when count is zero
     * 
     * @param int $count Notification count
     * @param string $type Badge type (notification|message)
     * @return string HTML badge element
     */
    public function renderBadge(int $count, string $type = 'notification'): string;

    /**
     * Get search form configuration
     * 
     * Returns configuration for header search:
     * - Search action URL
     * - Placeholder text
     * - Autocomplete settings
     * - Search scope options
     * 
     * @return array Search form configuration
     */
    public function getSearchConfig(): array;

    /**
     * Generate responsive toggle button HTML
     * 
     * Creates mobile sidebar toggle with:
     * - Proper ARIA labels for accessibility
     * - Bootstrap responsive classes
     * - JavaScript event handlers
     * 
     * @return string HTML toggle button
     */
    public function renderMobileToggle(): string;

    /**
     * Get user avatar URL with fallback
     * 
     * Handles:
     * - User uploaded avatar
     * - Default avatar based on initials
     * - Gravatar integration (optional)
     * - Proper asset URL generation
     * 
     * @param User $user User object
     * @return string Avatar image URL
     */
    public function getUserAvatarUrl(object $user): string;

    /**
     * Validate notification structure
     * 
     * Ensures notifications have:
     * - Required fields (id, type, title, message, created_at)
     * - Valid notification types
     * - Proper timestamp format
     * 
     * @param array $notifications Notification data to validate
     * @throws \InvalidArgumentException If structure is invalid
     * @return bool True if valid
     */
    public function validateNotificationStructure(array $notifications): bool;
}