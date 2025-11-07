<?php

namespace Tests\Feature;

use App\Models\User;
use App\Services\AssetService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ComponentRenderingTest extends TestCase
{
    use RefreshDatabase;

    private User $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'designation' => 'Administrator'
        ]);
    }

    /**
     * Test DashtransLayout component renders correctly
     */
    public function test_dashtrans_layout_component_renders(): void
    {
        $response = $this->actingAs($this->user)->get('/dashboard');
        
        $response->assertStatus(200);
        $response->assertSee('<!doctype html>', false);
        $response->assertSee('class="wrapper"', false);
        $response->assertSee('VENOM IPTV');
        $response->assertSee($this->user->name);
    }

    /**
     * Test Sidebar component renders with correct navigation
     */
    public function test_sidebar_component_renders(): void
    {
        $response = $this->actingAs($this->user)->get('/dashboard');
        
        $response->assertSee('sidebar-wrapper', false);
        $response->assertSee('VENOM IPTV');
        $response->assertSee('Dashboard');
        $response->assertSee('IPTV Management');
        $response->assertSee('Users & Access');
        $response->assertSee('System');
        $response->assertSee('Profile');
        $response->assertSee('Settings');
    }

    /**
     * Test HeaderTopbar component renders with user data
     */
    public function test_header_topbar_component_renders(): void
    {
        $response = $this->actingAs($this->user)->get('/dashboard');
        
        $response->assertSee('topbar', false);
        $response->assertSee('mobile-toggle-menu', false);
        $response->assertSee('search-bar', false);
        $response->assertSee($this->user->name);
        $response->assertSee($this->user->designation);
        $response->assertSee('Logout');
    }

    /**
     * Test PageWrapper component renders with breadcrumbs
     */
    public function test_page_wrapper_component_with_breadcrumbs(): void
    {
        $response = $this->actingAs($this->user)->get('/profile');
        
        $response->assertSee('page-wrapper', false);
        $response->assertSee('page-content', false);
        $response->assertSee('page-breadcrumb', false);
        $response->assertSee('User Profile');
        $response->assertSee('Home');
    }

    /**
     * Test PageWrapper component without breadcrumbs (dashboard)
     */
    public function test_page_wrapper_component_without_breadcrumbs(): void
    {
        $response = $this->actingAs($this->user)->get('/dashboard');
        
        $response->assertSee('page-wrapper', false);
        $response->assertSee('page-content', false);
        $response->assertDontSee('page-breadcrumb', false);
    }

    /**
     * Test asset loading in layout
     */
    public function test_asset_loading_in_layout(): void
    {
        $response = $this->actingAs($this->user)->get('/dashboard');
        
        // Test CSS assets
        $response->assertSee('bootstrap.min.css');
        $response->assertSee('app.css');
        $response->assertSee('icons.css');
        $response->assertSee('metisMenu.min.css');
        $response->assertSee('simplebar.css');
        
        // Test JS assets
        $response->assertSee('jquery.min.js');
        $response->assertSee('bootstrap.bundle.min.js');
        $response->assertSee('simplebar.min.js');
        $response->assertSee('metisMenu.min.js');
        $response->assertSee('app.js');
    }

    /**
     * Test active route highlighting in sidebar
     */
    public function test_sidebar_active_route_highlighting(): void
    {
        // Test dashboard active
        $response = $this->actingAs($this->user)->get('/dashboard');
        $response->assertSee('mm-active', false);

        // Test profile active
        $response = $this->actingAs($this->user)->get('/profile');
        $response->assertSee('Profile');
        
        // Test settings active
        $response = $this->actingAs($this->user)->get('/settings');
        $response->assertSee('Settings');
    }

    /**
     * Test responsive classes and Bootstrap components
     */
    public function test_responsive_classes_and_bootstrap_components(): void
    {
        $response = $this->actingAs($this->user)->get('/dashboard');
        
        // Test responsive grid classes
        $response->assertSee('row');
        $response->assertSee('col');
        $response->assertSee('row-cols-1');
        $response->assertSee('row-cols-lg-2');
        $response->assertSee('row-cols-xl-4');
        
        // Test Bootstrap card components
        $response->assertSee('card');
        $response->assertSee('card-body');
        $response->assertSee('radius-10');
        
        // Test Bootstrap utilities
        $response->assertSee('d-flex');
        $response->assertSee('align-items-center');
        $response->assertSee('justify-content-between');
        $response->assertSee('ms-auto');
    }

    /**
     * Test icon rendering
     */
    public function test_icon_rendering(): void
    {
        $response = $this->actingAs($this->user)->get('/dashboard');
        
        // Test BoxIcons usage
        $response->assertSee('bx bx-');
        $response->assertSee('bxs-group');
        $response->assertSee('bx-broadcast');
        $response->assertSee('bx-tv');
        $response->assertSee('bx-server');
    }

    /**
     * Test form components rendering
     */
    public function test_form_components_rendering(): void
    {
        $response = $this->actingAs($this->user)->get('/profile');
        
        // Test form structure
        $response->assertSee('form-control');
        $response->assertSee('btn btn-light');
        $response->assertSee('form method="POST"', false);
        $response->assertSee('@csrf', false);
        
        // Test Dashtrans form layout
        $response->assertSee('container');
        $response->assertSee('main-body');
        $response->assertSee('col-lg-4');
        $response->assertSee('col-lg-8');
    }

    /**
     * Test JavaScript initialization
     */
    public function test_javascript_initialization(): void
    {
        $response = $this->actingAs($this->user)->get('/dashboard');
        
        // Test script tags and initialization
        $response->assertSee('$(document).ready(function() {', false);
        $response->assertSee('metisMenu', false);
        $response->assertSee('SimpleBar', false);
        $response->assertSee('bootstrap.Dropdown', false);
    }

    /**
     * Test component props and data binding
     */
    public function test_component_props_and_data_binding(): void
    {
        $response = $this->actingAs($this->user)->get('/profile');
        
        // Test user data binding
        $response->assertSee($this->user->name);
        $response->assertSee($this->user->email);
        $response->assertSee($this->user->designation);
        
        // Test form value binding
        $response->assertSee('value="' . $this->user->name . '"', false);
        $response->assertSee('value="' . $this->user->email . '"', false);
    }

    /**
     * Test error handling in components
     */
    public function test_component_error_handling(): void
    {
        // Create user without designation
        $userWithoutDesignation = User::factory()->create([
            'designation' => null
        ]);
        
        $response = $this->actingAs($userWithoutDesignation)->get('/dashboard');
        
        $response->assertStatus(200);
        $response->assertSee('Administrator'); // Default value should be shown
    }

    /**
     * Test AssetService integration
     */
    public function test_asset_service_integration(): void
    {
        $assetService = app(AssetService::class);
        
        // Test CSS assets
        $cssAssets = $assetService->getAllCssAssets();
        $this->assertNotEmpty($cssAssets);
        
        // Test JS assets
        $jsAssets = $assetService->getAllJsAssets();
        $this->assertArrayHasKey('head', $jsAssets);
        $this->assertArrayHasKey('body', $jsAssets);
        
        // Test specific asset loading
        $response = $this->actingAs($this->user)->get('/dashboard');
        
        foreach ($cssAssets as $cssAsset) {
            $response->assertSee(basename($cssAsset));
        }
    }
}