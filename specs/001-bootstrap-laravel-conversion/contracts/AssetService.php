<?php

namespace App\Services\Contracts;

/**
 * Asset Service Contract for Dashtrans Template Integration
 * 
 * This contract defines the interface for managing Dashtrans template assets
 * including CSS, JavaScript, images, and fonts with proper Laravel integration.
 * 
 * Requirements:
 * - Must serve assets from public/assets/ directory
 * - Must maintain original Dashtrans file structure
 * - Must provide asset versioning for cache busting
 * - Must validate asset existence before serving
 */
interface AssetService
{
    /**
     * Get CSS asset URL with proper versioning
     * 
     * Generates URL for CSS files:
     * - Checks file existence in public/assets/css/
     * - Adds version parameter for cache busting
     * - Returns absolute URL for template inclusion
     * 
     * @param string $filename CSS filename (e.g., 'bootstrap.min.css')
     * @return string Versioned asset URL
     * @throws \Exception If asset file does not exist
     */
    public function css(string $filename): string;

    /**
     * Get JavaScript asset URL with proper versioning
     * 
     * Generates URL for JS files:
     * - Checks file existence in public/assets/js/
     * - Adds version parameter for cache busting
     * - Returns absolute URL for template inclusion
     * 
     * @param string $filename JavaScript filename (e.g., 'app.js')
     * @return string Versioned asset URL
     * @throws \Exception If asset file does not exist
     */
    public function js(string $filename): string;

    /**
     * Get image asset URL with proper versioning
     * 
     * Generates URL for image files:
     * - Checks file existence in public/assets/images/
     * - Supports multiple subdirectories
     * - Returns absolute URL for template usage
     * 
     * @param string $path Image path relative to assets/images/
     * @return string Versioned asset URL
     * @throws \Exception If asset file does not exist
     */
    public function image(string $path): string;

    /**
     * Get plugin asset URL for third-party libraries
     * 
     * Generates URL for plugin files:
     * - Checks file existence in public/assets/plugins/
     * - Handles nested plugin directory structure
     * - Returns absolute URL for plugin inclusion
     * 
     * @param string $plugin Plugin name (e.g., 'metismenu')
     * @param string $filename File within plugin directory
     * @return string Versioned asset URL
     * @throws \Exception If asset file does not exist
     */
    public function plugin(string $plugin, string $filename): string;

    /**
     * Validate Dashtrans asset structure
     * 
     * Checks for required asset directories:
     * - public/assets/css/ (with bootstrap.min.css, app.css)
     * - public/assets/js/ (with bootstrap.min.js, app.js)
     * - public/assets/images/ (with logos and icons)
     * - public/assets/plugins/ (with metismenu, simplebar, etc.)
     * 
     * @return array Missing asset files or empty array if all present
     */
    public function validateAssetStructure(): array;

    /**
     * Get all CSS assets in proper loading order
     * 
     * Returns ordered array of CSS files:
     * 1. bootstrap.min.css (Bootstrap framework)
     * 2. bootstrap-extended.css (Dashtrans extensions)
     * 3. app.css (Main template styles)
     * 4. icons.css (Icon fonts)
     * 5. pace.min.css (Loading progress bar)
     * 
     * @return array Ordered CSS asset URLs
     */
    public function getAllCssAssets(): array;

    /**
     * Get all JavaScript assets in proper loading order
     * 
     * Returns categorized JS assets:
     * - 'head': Files to load in <head> (pace.min.js)
     * - 'body': Files to load before </body> (bootstrap, app, plugins)
     * 
     * @return array Categorized JavaScript asset URLs
     */
    public function getAllJsAssets(): array;

    /**
     * Generate asset manifest for cache busting
     * 
     * Creates manifest file with:
     * - Asset file paths and versions
     * - File modification timestamps
     * - Content hash for integrity checks
     * 
     * @return array Asset manifest data
     */
    public function generateManifest(): array;

    /**
     * Get asset version for cache busting
     * 
     * Generates version string based on:
     * - File modification time
     * - Application version
     * - Custom versioning scheme
     * 
     * @param string $assetPath Path to asset file
     * @return string Version string for URL parameter
     */
    public function getAssetVersion(string $assetPath): string;

    /**
     * Check if asset file exists
     * 
     * Validates asset existence:
     * - Checks file in public/assets/ hierarchy
     * - Follows security restrictions (no path traversal)
     * - Returns boolean existence status
     * 
     * @param string $assetPath Relative path within assets directory
     * @return bool True if asset exists
     */
    public function assetExists(string $assetPath): bool;

    /**
     * Get asset MIME type for proper serving
     * 
     * Determines MIME type for:
     * - CSS files (text/css)
     * - JavaScript files (application/javascript)
     * - Image files (image/png, image/jpeg, etc.)
     * - Font files (font/woff, font/woff2, etc.)
     * 
     * @param string $assetPath Path to asset file
     * @return string MIME type string
     */
    public function getAssetMimeType(string $assetPath): string;
}