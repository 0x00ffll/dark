<?php

namespace Tests\Performance;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PerformanceTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test authentication response time < 100ms
     */
    public function test_authentication_performance(): void
    {
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => bcrypt('password123'),
        ]);

        $startTime = microtime(true);
        
        $response = $this->post('/login', [
            'email' => 'test@example.com',
            'password' => 'password123',
        ]);
        
        $endTime = microtime(true);
        $responseTime = ($endTime - $startTime) * 1000; // Convert to milliseconds
        
        $response->assertRedirect('/dashboard');
        $this->assertLessThan(100, $responseTime, "Authentication took {$responseTime}ms, should be < 100ms");
    }

    /**
     * Test page load performance < 500ms
     */
    public function test_page_load_performance(): void
    {
        $user = User::factory()->create();
        
        $pages = [
            '/dashboard',
            '/profile', 
            '/settings',
            '/placeholder'
        ];
        
        foreach ($pages as $page) {
            $startTime = microtime(true);
            
            $response = $this->actingAs($user)->get($page);
            
            $endTime = microtime(true);
            $responseTime = ($endTime - $startTime) * 1000;
            
            $response->assertStatus(200);
            $this->assertLessThan(500, $responseTime, "Page {$page} took {$responseTime}ms, should be < 500ms");
        }
    }

    /**
     * Test dashboard initialization < 1s
     */
    public function test_dashboard_initialization_performance(): void
    {
        $user = User::factory()->create();
        
        $startTime = microtime(true);
        
        // Test dashboard with all components
        $response = $this->actingAs($user)->get('/dashboard');
        
        $endTime = microtime(true);
        $responseTime = ($endTime - $startTime) * 1000;
        
        $response->assertStatus(200);
        
        // Check that dashboard contains all necessary components
        $response->assertSee('Dashboard', false);
        $response->assertSee('card', false);
        $response->assertSee('sidebar-wrapper', false);
        $response->assertSee('topbar', false);
        
        $this->assertLessThan(1000, $responseTime, "Dashboard initialization took {$responseTime}ms, should be < 1000ms");
    }

    /**
     * Test asset loading performance
     */
    public function test_asset_loading_performance(): void
    {
        $user = User::factory()->create();
        
        $startTime = microtime(true);
        
        $response = $this->actingAs($user)->get('/dashboard');
        
        $endTime = microtime(true);
        $responseTime = ($endTime - $startTime) * 1000;
        
        // Verify assets are being served correctly
        $content = $response->getContent();
        $this->assertStringContains('bootstrap.min.css', $content, 'Bootstrap CSS should be included');
        $this->assertStringContains('app.css', $content, 'App CSS should be included');
        $this->assertStringContains('jquery.min.js', $content, 'jQuery should be included');
        $this->assertStringContains('bootstrap.min.js', $content, 'Bootstrap JS should be included');
        
        $response->assertStatus(200);
        $this->assertLessThan(500, $responseTime, "Asset loading took {$responseTime}ms, should be < 500ms");
    }

    /**
     * Test login form performance
     */
    public function test_login_form_performance(): void
    {
        $startTime = microtime(true);
        
        $response = $this->get('/login');
        
        $endTime = microtime(true);
        $responseTime = ($endTime - $startTime) * 1000;
        
        $response->assertStatus(200);
        $response->assertSee('login', false);
        $response->assertSee('form', false);
        
        $this->assertLessThan(300, $responseTime, "Login form load took {$responseTime}ms, should be < 300ms");
    }

    /**
     * Test component rendering performance
     */
    public function test_component_rendering_performance(): void
    {
        $user = User::factory()->create();
        
        $startTime = microtime(true);
        
        $response = $this->actingAs($user)->get('/dashboard');
        
        $endTime = microtime(true);
        $responseTime = ($endTime - $startTime) * 1000;
        
        // Verify all major components are rendered
        $content = $response->getContent();
        $this->assertStringContains('sidebar-wrapper', $content, 'Sidebar component should render');
        $this->assertStringContains('topbar', $content, 'Header topbar should render');
        $this->assertStringContains('page-wrapper', $content, 'Page wrapper should render');
        
        $this->assertLessThan(400, $responseTime, "Component rendering took {$responseTime}ms, should be < 400ms");
    }

    /**
     * Test memory usage during page rendering
     */
    public function test_memory_usage_performance(): void
    {
        $user = User::factory()->create();
        
        $memoryBefore = memory_get_usage(true);
        
        $response = $this->actingAs($user)->get('/dashboard');
        
        $memoryAfter = memory_get_usage(true);
        $memoryUsed = ($memoryAfter - $memoryBefore) / 1024 / 1024; // Convert to MB
        
        $response->assertStatus(200);
        $this->assertLessThan(10, $memoryUsed, "Page rendering used {$memoryUsed}MB, should be < 10MB");
    }

    /**
     * Test multiple concurrent requests performance
     */
    public function test_concurrent_requests_performance(): void
    {
        $user = User::factory()->create();
        
        $startTime = microtime(true);
        
        // Simulate multiple concurrent requests
        for ($i = 0; $i < 5; $i++) {
            $response = $this->actingAs($user)->get('/dashboard');
            $response->assertStatus(200);
        }
        
        $endTime = microtime(true);
        $totalTime = ($endTime - $startTime) * 1000;
        $averageTime = $totalTime / 5;
        
        $this->assertLessThan(500, $averageTime, "Average response time {$averageTime}ms should be < 500ms");
        $this->assertLessThan(2000, $totalTime, "Total time for 5 requests {$totalTime}ms should be < 2000ms");
    }

    /**
     * Test database query performance
     */
    public function test_database_query_performance(): void
    {
        $user = User::factory()->create();
        
        $startTime = microtime(true);
        
        // Test user lookup performance
        $foundUser = User::where('email', $user->email)->first();
        
        $endTime = microtime(true);
        $queryTime = ($endTime - $startTime) * 1000;
        
        $this->assertNotNull($foundUser);
        $this->assertLessThan(50, $queryTime, "Database query took {$queryTime}ms, should be < 50ms");
    }
}