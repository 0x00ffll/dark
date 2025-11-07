<?php

namespace App\View\Components\Contracts;

/**
 * Sidebar Navigation Component Contract for Dashtrans Template
 * 
 * This contract defines the interface for the Dashtrans sidebar navigation
 * component that provides hierarchical menu navigation with MetisMenu integration.
 * 
 * Requirements:
 * - Must render Dashtrans sidebar HTML structure exactly
 * - Must integrate with MetisMenu JavaScript for collapsible navigation
 * - Must highlight active menu items based on current route
 * - Must handle responsive behavior (collapse on mobile)
 */
interface SidebarComponent
{
    /**
     * Initialize sidebar component with navigation data
     *
     * @param array $menuItems Hierarchical navigation structure
     * @param string $currentRoute Active route name for highlighting
     * @param bool $collapsed Whether sidebar starts collapsed
     * @param User|null $user Authenticated user for profile display
     */
    public function __construct(
        array $menuItems = [],
        string $currentRoute = '',
        bool $collapsed = false,
        ?object $user = null
    );

    /**
     * Render the Dashtrans sidebar HTML structure
     * 
     * Must include:
     * - sidebar-wrapper div with proper classes
     * - simplebar-wrapper for custom scrollbars
     * - metismenu for collapsible navigation
     * - User profile section at top
     * - Navigation menu items with icons and badges
     * 
     * @return \Illuminate\View\View
     */
    public function render();

    /**
     * Get default navigation menu structure for IPTV panel
     * 
     * Returns hierarchical array with:
     * - Dashboard section (Analytics, eCommerce)
     * - User Management (Admins, Customers)
     * - Content Management (Channels, VOD)
     * - System Settings (Configuration, Logs)
     * 
     * @return array Default menu structure
     */
    public function getDefaultMenuItems(): array;

    /**
     * Build navigation menu item HTML
     * 
     * Handles:
     * - Single menu items with icons and routes
     * - Parent items with collapsible children
     * - Active state highlighting
     * - Badge/counter display
     * 
     * @param array $item Menu item configuration
     * @param bool $isChild Whether item is a submenu child
     * @return string HTML for menu item
     */
    public function buildMenuItem(array $item, bool $isChild = false): string;

    /**
     * Determine if menu item should be active
     * 
     * Checks:
     * - Exact route match
     * - Parent route match for children
     * - Route pattern matching
     * 
     * @param array $item Menu item configuration
     * @return bool True if item should be highlighted as active
     */
    public function isActive(array $item): bool;

    /**
     * Generate CSS classes for menu item state
     * 
     * Returns classes for:
     * - Active items ('mm-active')
     * - Collapsed parents ('mm-collapsed')
     * - Badge styling ('badge badge-primary')
     * 
     * @param array $item Menu item configuration
     * @param bool $isChild Whether item is submenu child
     * @return string Space-separated CSS classes
     */
    public function getMenuItemClasses(array $item, bool $isChild = false): string;

    /**
     * Validate menu item structure
     * 
     * Ensures each menu item has:
     * - Required fields (title, route or children)
     * - Valid icon class (optional)
     * - Proper child structure (recursive)
     * 
     * @param array $menuItems Menu structure to validate
     * @throws \InvalidArgumentException If structure is invalid
     * @return bool True if valid
     */
    public function validateMenuStructure(array $menuItems): bool;

    /**
     * Get MetisMenu JavaScript configuration
     * 
     * Returns JavaScript object for MetisMenu initialization:
     * - Toggle animation settings
     * - Active class configuration
     * - Callback functions for events
     * 
     * @return string JavaScript configuration object
     */
    public function getMetisMenuConfig(): string;
}