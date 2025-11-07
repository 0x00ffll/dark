<?php

namespace App\View\Components\Contracts;

/**
 * Layout Component Contract for Dashtrans Template Integration
 * 
 * This contract defines the interface for the main Dashtrans layout component
 * that wraps all admin panel pages with the template's HTML structure.
 * 
 * Requirements:
 * - Must render the complete Dashtrans HTML wrapper
 * - Must include proper CSS/JS asset loading order
 * - Must handle authentication state and user data injection
 * - Must support dynamic page titles and body classes
 */
interface LayoutComponent
{
    /**
     * Initialize layout component with required Dashtrans template data
     *
     * @param string $pageTitle Browser title and header content
     * @param array $breadcrumbs Navigation breadcrumb data
     * @param string $bodyClass Additional CSS classes for page-specific styling
     * @param User|null $user Authenticated user for header display
     */
    public function __construct(
        string $pageTitle = 'VENOM IPTV Panel',
        array $breadcrumbs = [],
        string $bodyClass = '',
        ?object $user = null
    );

    /**
     * Render the complete Dashtrans template HTML structure
     * 
     * Must include:
     * - DOCTYPE html with proper meta tags
     * - CSS assets in correct order (Bootstrap, Icons, App)
     * - JavaScript assets (Pace, Bootstrap, Metismenu, App)
     * - Template wrapper with sidebar, header, and content slots
     * 
     * @return \Illuminate\View\View
     */
    public function render();

    /**
     * Get CSS asset URLs for Dashtrans template
     * 
     * Returns array of CSS files in proper loading order:
     * - bootstrap.min.css
     * - bootstrap-extended.css  
     * - app.css
     * - icons.css
     * - pace.min.css
     * 
     * @return array Array of CSS asset URLs
     */
    public function getCssAssets(): array;

    /**
     * Get JavaScript asset URLs for Dashtrans template
     * 
     * Returns array of JS files in proper loading order:
     * - pace.min.js (head)
     * - bootstrap.min.js (body end)
     * - app.js (body end)
     * 
     * @return array Array of JS asset URLs with placement hints
     */
    public function getJsAssets(): array;

    /**
     * Validate that required Dashtrans assets exist
     * 
     * Checks public/assets/ directory for:
     * - CSS files (bootstrap.min.css, app.css, etc.)
     * - JS files (bootstrap.min.js, app.js, etc.) 
     * - Image assets (logos, avatars, etc.)
     * 
     * @throws \Exception If required assets are missing
     * @return bool True if all assets exist
     */
    public function validateAssets(): bool;

    /**
     * Generate dynamic CSS variables for template customization
     * 
     * Allows runtime customization of Dashtrans theme:
     * - Primary color scheme
     * - Sidebar width and behavior
     * - Header height and styling
     * 
     * @return string CSS custom properties as inline style
     */
    public function getCustomCss(): string;
}