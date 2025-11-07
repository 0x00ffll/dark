<?php

namespace App\View\Components\Contracts;

/**
 * Page Wrapper Component Contract for Dashtrans Template
 * 
 * This contract defines the interface for the Dashtrans page wrapper component
 * that contains the main content area within the template layout.
 * 
 * Requirements:
 * - Must render page-wrapper div with proper Dashtrans structure
 * - Must handle page titles and breadcrumbs
 * - Must support dynamic content injection
 * - Must maintain responsive behavior for different screen sizes
 */
interface PageWrapperComponent
{
    /**
     * Initialize page wrapper component with content data
     *
     * @param string $pageTitle Page heading for breadcrumbs and header
     * @param array $breadcrumbs Navigation breadcrumb trail
     * @param string $contentClass Additional CSS classes for content area
     * @param bool $showBreadcrumbs Whether to display breadcrumb navigation
     * @param array $pageActions Optional action buttons for page header
     */
    public function __construct(
        string $pageTitle = '',
        array $breadcrumbs = [],
        string $contentClass = '',
        bool $showBreadcrumbs = true,
        array $pageActions = []
    );

    /**
     * Render the Dashtrans page wrapper HTML structure
     * 
     * Must include:
     * - page-wrapper div with proper classes
     * - page-content-wrapper for main content
     * - breadcrumb navigation (if enabled)
     * - page header with title and actions
     * - content slot for child components
     * 
     * @return \Illuminate\View\View
     */
    public function render();

    /**
     * Build breadcrumb navigation HTML
     * 
     * Creates Bootstrap breadcrumb with:
     * - Home link as first item
     * - Parent page links (if any)
     * - Current page as active item
     * - Proper ARIA labels for accessibility
     * 
     * @param array $breadcrumbs Breadcrumb data array
     * @return string HTML breadcrumb navigation
     */
    public function renderBreadcrumbs(array $breadcrumbs): string;

    /**
     * Generate page header HTML
     * 
     * Creates page header section with:
     * - Page title with proper typography
     * - Optional subtitle or description
     * - Action buttons aligned to right
     * - Responsive layout for mobile
     * 
     * @param string $title Page title
     * @param array $actions Action button configurations
     * @return string HTML page header
     */
    public function renderPageHeader(string $title, array $actions = []): string;

    /**
     * Build action button HTML
     * 
     * Creates Bootstrap button with:
     * - Proper button styling classes
     * - Icon support (optional)
     * - Dropdown support for multiple actions
     * - Accessibility attributes
     * 
     * @param array $action Action button configuration
     * @return string HTML action button
     */
    public function renderActionButton(array $action): string;

    /**
     * Get default breadcrumb structure
     * 
     * Returns base breadcrumb with:
     * - Home/Dashboard link
     * - Current section (if applicable)
     * - Current page
     * 
     * @param string $currentPage Current page title
     * @param string|null $section Optional section name
     * @return array Default breadcrumb structure
     */
    public function getDefaultBreadcrumbs(string $currentPage, ?string $section = null): array;

    /**
     * Validate page action structure
     * 
     * Ensures actions have:
     * - Required fields (label, url or onclick)
     * - Valid button types and styles
     * - Proper permission checks
     * 
     * @param array $actions Action configurations to validate
     * @throws \InvalidArgumentException If structure is invalid
     * @return bool True if valid
     */
    public function validateActionStructure(array $actions): bool;

    /**
     * Generate CSS classes for content area
     * 
     * Returns classes for:
     * - Content padding and margins
     * - Responsive behavior
     * - Custom styling overrides
     * 
     * @param string $additionalClasses Additional classes from props
     * @return string Space-separated CSS classes
     */
    public function getContentClasses(string $additionalClasses = ''): string;

    /**
     * Determine if breadcrumbs should be shown
     * 
     * Checks:
     * - Component showBreadcrumbs setting
     * - Page-specific breadcrumb configuration
     * - User preference settings
     * 
     * @return bool True if breadcrumbs should be displayed
     */
    public function shouldShowBreadcrumbs(): bool;

    /**
     * Generate structured data for breadcrumbs
     * 
     * Creates JSON-LD structured data for SEO:
     * - BreadcrumbList schema
     * - Proper URL structure
     * - Position metadata
     * 
     * @param array $breadcrumbs Breadcrumb data
     * @return string JSON-LD structured data
     */
    public function generateBreadcrumbSchema(array $breadcrumbs): string;
}