<?php

namespace Tests\Feature;

use App\Models\User;
use App\Services\AssetService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DashtransIntegrationTest extends TestCase
{
    use RefreshDatabase;

    private User $user;
    private AssetService $assetService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->assetService = app(AssetService::class);
    }

    /**
     * Test Dashtrans template structure validation
     */
    public function test_dashtrans_template_structure(): void
    {
        $response = $this->actingAs($this->user)->get('/dashboard');
        
        // Test main wrapper structure
        $response->assertSee('<div class="wrapper">', false);
        $response->assertSee('<div class="sidebar-wrapper"', false);
        $response->assertSee('<div class="page-wrapper">', false);
        $response->assertSee('<div class="page-content">', false);
        
        // Test header structure
        $response->assertSee('<header>', false);
        $response->assertSee('<div class="topbar', false);
        $response->assertSee('<nav class="navbar', false);
        
        // Test theme classes
        $response->assertSee('bg-theme bg-theme9', false);
    }

    /**
     * Test required Dashtrans CSS assets
     */
    public function test_required_dashtrans_css_assets(): void
    {
        $cssAssets = $this->assetService->getAllCssAssets();
        
        $requiredAssets = [
            'bootstrap.min.css',
            'bootstrap-extended.css',
            'icons.css',
            'pace.min.css',
            'app.css'
        ];
        
        foreach ($requiredAssets as $asset) {
            $found = false;
            foreach ($cssAssets as $cssAsset) {
                if (str_contains($cssAsset, $asset)) {
                    $found = true;
                    break;
                }
            }
            $this->assertTrue($found, "Required CSS asset {$asset} not found");
        }
    }

    /**
     * Test required Dashtrans JavaScript assets
     */
    public function test_required_dashtrans_js_assets(): void
    {
        $jsAssets = $this->assetService->getAllJsAssets();
        
        $requiredAssets = [
            'jquery.min.js',
            'bootstrap.bundle.min.js',
            'simplebar.min.js',
            'metisMenu.min.js',
            'app.js'
        ];
        
        $allAssets = array_merge($jsAssets['head'], $jsAssets['body']);
        
        foreach ($requiredAssets as $asset) {
            $found = false;
            foreach ($allAssets as $jsAsset) {
                if (str_contains($jsAsset, $asset)) {
                    $found = true;
                    break;
                }
            }
            $this->assertTrue($found, "Required JS asset {$asset} not found");
        }
    }

    /**
     * Test asset loading order matches Dashtrans requirements
     */
    public function test_asset_loading_order(): void
    {
        $response = $this->actingAs($this->user)->get('/dashboard');
        $content = $response->getContent();
        
        // Find positions of key assets
        $jqueryPos = strpos($content, 'jquery.min.js');
        $bootstrapPos = strpos($content, 'bootstrap.bundle.min.js');
        $metisMenuPos = strpos($content, 'metisMenu.min.js');
        $simplebarPos = strpos($content, 'simplebar.min.js');
        $appPos = strpos($content, 'app.js');
        
        // Verify loading order: jQuery → Bootstrap → Plugins → App
        $this->assertLessThan($bootstrapPos, $jqueryPos, 'jQuery must load before Bootstrap');
        $this->assertLessThan($metisMenuPos, $bootstrapPos, 'Bootstrap must load before MetisMenu');
        $this->assertLessThan($simplebarPos, $bootstrapPos, 'Bootstrap must load before Simplebar');
        $this->assertLessThan($appPos, $metisMenuPos, 'MetisMenu must load before app.js');
        $this->assertLessThan($appPos, $simplebarPos, 'Simplebar must load before app.js');
    }

    /**
     * Test Dashtrans sidebar MetisMenu structure
     */
    public function test_dashtrans_sidebar_metismenu_structure(): void
    {
        $response = $this->actingAs($this->user)->get('/dashboard');
        
        // Test MetisMenu structure
        $response->assertSee('<ul class="metismenu" id="menu">', false);
        $response->assertSee('has-arrow');
        $response->assertSee('parent-icon');
        $response->assertSee('menu-title');
        $response->assertSee('menu-label');
        
        // Test navigation items
        $response->assertSee('Dashboard');
        $response->assertSee('IPTV Management');
        $response->assertSee('Users & Access');
        $response->assertSee('System');
    }

    /**
     * Test Dashtrans card components structure
     */
    public function test_dashtrans_card_structure(): void
    {
        $response = $this->actingAs($this->user)->get('/dashboard');
        
        // Test card structure
        $response->assertSee('card radius-10');
        $response->assertSee('card-body');
        $response->assertSee('widgets-icons-2');
        $response->assertSee('border-start border-0 border-4');
        
        // Test gradient classes
        $response->assertSee('bg-gradient-scooter');
        $response->assertSee('bg-gradient-bloody');
        $response->assertSee('bg-gradient-ohhappiness');
        $response->assertSee('bg-gradient-blooker');
    }

    /**
     * Test Dashtrans form structure
     */
    public function test_dashtrans_form_structure(): void
    {
        $response = $this->actingAs($this->user)->get('/profile');
        
        // Test Dashtrans user profile structure
        $response->assertSee('container');
        $response->assertSee('main-body');
        $response->assertSee('col-lg-4');
        $response->assertSee('col-lg-8');
        
        // Test profile card structure
        $response->assertSee('d-flex flex-column align-items-center text-center');
        $response->assertSee('rounded-circle p-1 bg-primary');
        $response->assertSee('list-group list-group-flush');
        
        // Test form row structure
        $response->assertSee('row mb-3');
        $response->assertSee('col-sm-3');
        $response->assertSee('col-sm-9');
    }

    /**
     * Test Dashtrans responsive grid system
     */
    public function test_dashtrans_responsive_grid(): void
    {
        $response = $this->actingAs($this->user)->get('/dashboard');
        
        // Test responsive grid classes
        $response->assertSee('row-cols-1');
        $response->assertSee('row-cols-lg-2');
        $response->assertSee('row-cols-xl-4');
        
        // Test column classes
        $response->assertSee('col-xl-3');
        $response->assertSee('col-lg-6');
        $response->assertSee('col-12');
    }

    /**
     * Test Dashtrans icon integration (BoxIcons)
     */
    public function test_dashtrans_boxicons_integration(): void
    {
        $response = $this->actingAs($this->user)->get('/dashboard');
        
        // Test BoxIcons usage
        $response->assertSee("bx bx-");
        $response->assertSee("bxs-group");
        $response->assertSee("bx-broadcast");
        $response->assertSee("bx-tv");
        $response->assertSee("bx-server");
        $response->assertSee("bx-home-alt");
        
        // Test icon in navigation
        $response = $this->actingAs($this->user)->get('/profile');
        $response->assertSee("bx bx-envelope");
        $response->assertSee("bx bx-time");
        $response->assertSee("bx-user-badge");
    }

    /**
     * Test Dashtrans JavaScript functionality
     */
    public function test_dashtrans_javascript_functionality(): void
    {
        $response = $this->actingAs($this->user)->get('/dashboard');
        
        // Test MetisMenu initialization
        $response->assertSee('$("#menu").metisMenu()', false);
        
        // Test Simplebar initialization
        $response->assertSee('new SimpleBar(', false);
        
        // Test Bootstrap dropdown initialization
        $response->assertSee('bootstrap.Dropdown', false);
        
        // Test mobile menu functionality
        $response->assertSee('mobile-toggle-menu', false);
        
        // Test back to top functionality
        $response->assertSee('back-to-top', false);
        
        // Test theme switcher
        $response->assertSee('switcher-wrapper', false);
    }

    /**
     * Test Dashtrans theme system
     */
    public function test_dashtrans_theme_system(): void
    {
        $response = $this->actingAs($this->user)->get('/dashboard');
        
        // Test theme classes
        $response->assertSee('bg-theme bg-theme9', false);
        
        // Test theme switcher functionality
        $response->assertSee('Theme Customizer');
        $response->assertSee('#theme1');
        $response->assertSee('#theme9');
        $response->assertSee('switcher-btn');
    }

    /**
     * Test Dashtrans component compatibility
     */
    public function test_component_compatibility(): void
    {
        // Test all main pages load without errors
        $pages = ['/dashboard', '/profile', '/settings'];
        
        foreach ($pages as $page) {
            $response = $this->actingAs($this->user)->get($page);
            $response->assertStatus(200);
            
            // Ensure Dashtrans structure is present
            $response->assertSee('wrapper');
            $response->assertSee('sidebar-wrapper');
            $response->assertSee('page-wrapper');
            $response->assertSee('topbar');
        }
    }

    /**
     * Test asset file existence
     */
    public function test_asset_file_existence(): void
    {
        $requiredAssets = [
            'assets/css/bootstrap.min.css',
            'assets/css/app.css',
            'assets/css/icons.css',
            'assets/js/jquery.min.js',
            'assets/js/bootstrap.bundle.min.js',
            'assets/js/app.js',
            'assets/plugins/metismenu/css/metisMenu.min.css',
            'assets/plugins/metismenu/js/metisMenu.min.js',
            'assets/plugins/simplebar/css/simplebar.css',
            'assets/plugins/simplebar/js/simplebar.min.js',
        ];
        
        foreach ($requiredAssets as $asset) {
            $this->assertFileExists(public_path($asset), "Required asset {$asset} not found");
        }
    }

    /**
     * Test Dashtrans breadcrumb structure
     */
    public function test_dashtrans_breadcrumb_structure(): void
    {
        $response = $this->actingAs($this->user)->get('/profile');
        
        // Test breadcrumb structure
        $response->assertSee('page-breadcrumb d-none d-sm-flex align-items-center mb-3', false);
        $response->assertSee('breadcrumb-title pe-3', false);
        $response->assertSee('<nav aria-label="breadcrumb">', false);
        $response->assertSee('breadcrumb mb-0 p-0', false);
        $response->assertSee('breadcrumb-item', false);
        $response->assertSee('bx bx-home-alt', false);
    }

    /**
     * Test performance characteristics
     */
    public function test_performance_characteristics(): void
    {
        $startTime = microtime(true);
        
        $response = $this->actingAs($this->user)->get('/dashboard');
        
        $endTime = microtime(true);
        $loadTime = ($endTime - $startTime) * 1000; // Convert to milliseconds
        
        $response->assertStatus(200);
        
        // Test that dashboard loads in under 1 second (1000ms)
        $this->assertLessThan(1000, $loadTime, 'Dashboard should load in under 1 second');
    }
}