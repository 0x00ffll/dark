<?php

namespace Tests\Feature;

use App\Models\User;
use App\Services\AccessibilityService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AccessibilityComplianceTest extends TestCase
{
    use RefreshDatabase;

    protected AccessibilityService $accessibilityService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->accessibilityService = app(AccessibilityService::class);
    }

    public function test_login_form_accessibility_compliance(): void
    {
        $response = $this->get('/login');

        $response->assertStatus(200);

        // Check for proper form structure
        $response->assertSee('fieldset', false);
        $response->assertSee('legend', false);
        
        // Check for proper labels
        $response->assertSee('for="inputEmailAddress"', false);
        $response->assertSee('for="inputChoosePassword"', false);
        $response->assertSee('for="flexSwitchCheckChecked"', false);
        
        // Check for required field indicators
        $response->assertSee('aria-label="required"', false);
        
        // Check for ARIA live regions on alerts
        $response->assertSee('role="alert"', false);
        $response->assertSee('aria-live="polite"', false);
        
        // Check for proper form validation attributes
        $response->assertSee('aria-describedby', false);
        $response->assertSee('autocomplete="email"', false);
        $response->assertSee('autocomplete="current-password"', false);
    }

    public function test_navigation_accessibility_compliance(): void
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/dashboard');

        $response->assertStatus(200);

        // Check for proper navigation structure
        $response->assertSee('role="navigation"', false);
        $response->assertSee('aria-label="Main navigation"', false);
        
        // Check for current page indicators
        $response->assertSee('aria-current="page"', false);
        
        // Check for proper button accessibility
        $response->assertSee('aria-label="Toggle', false);
        $response->assertSee('aria-expanded', false);
        
        // Check for proper landmark roles
        $response->assertSee('role="banner"', false);
        $response->assertSee('role="main"', false);
    }

    public function test_form_accessibility_guidelines(): void
    {
        $formData = [
            'labels' => true,
            'aria_attributes' => true,
            'keyboard_support' => true,
        ];

        $issues = $this->accessibilityService->validateFormAccessibility($formData);

        $this->assertEmpty($issues, 'Form accessibility validation should pass with no issues');
    }

    public function test_form_accessibility_validation_fails_without_labels(): void
    {
        $formData = [
            'labels' => false,
            'aria_attributes' => true,
            'keyboard_support' => true,
        ];

        $issues = $this->accessibilityService->validateFormAccessibility($formData);

        $this->assertContains('Forms should have proper labels for all input fields', $issues);
    }

    public function test_accessibility_audit_generation(): void
    {
        $audit = $this->accessibilityService->generateAccessibilityAudit();

        $this->assertArrayHasKey('semantic_html', $audit);
        $this->assertArrayHasKey('keyboard_navigation', $audit);
        $this->assertArrayHasKey('screen_reader_support', $audit);
        $this->assertArrayHasKey('color_contrast', $audit);
        $this->assertArrayHasKey('form_accessibility', $audit);

        // Verify semantic HTML compliance
        $this->assertEquals('compliant', $audit['semantic_html']['status']);
        $this->assertArrayHasKey('header', $audit['semantic_html']['elements']);
        $this->assertArrayHasKey('nav', $audit['semantic_html']['elements']);
        $this->assertArrayHasKey('main', $audit['semantic_html']['elements']);

        // Verify keyboard navigation compliance
        $this->assertEquals('compliant', $audit['keyboard_navigation']['status']);
        $this->assertArrayHasKey('tab_order', $audit['keyboard_navigation']['features']);
        $this->assertArrayHasKey('focus_indicators', $audit['keyboard_navigation']['features']);

        // Verify screen reader support
        $this->assertEquals('compliant', $audit['screen_reader_support']['status']);
        $this->assertArrayHasKey('aria_labels', $audit['screen_reader_support']['features']);
        $this->assertArrayHasKey('alt_text', $audit['screen_reader_support']['features']);

        // Verify color contrast compliance
        $this->assertEquals('compliant', $audit['color_contrast']['status']);
        $this->assertArrayHasKey('results', $audit['color_contrast']);

        // Verify form accessibility
        $this->assertEquals('compliant', $audit['form_accessibility']['status']);
        $this->assertArrayHasKey('labels', $audit['form_accessibility']['features']);
        $this->assertArrayHasKey('required_indicators', $audit['form_accessibility']['features']);
    }

    public function test_color_contrast_calculation(): void
    {
        // Test high contrast (white text on dark background)
        $result = $this->accessibilityService->checkColorContrast('#ffffff', '#1e1e2e');
        
        $this->assertTrue($result['aa_normal'], 'White on dark should pass AA normal text requirements');
        $this->assertTrue($result['aa_large'], 'White on dark should pass AA large text requirements');
        $this->assertGreaterThan(4.5, $result['ratio'], 'Contrast ratio should be greater than 4.5:1');

        // Test medium contrast (link color on dark background)
        $linkResult = $this->accessibilityService->checkColorContrast('#00d4ff', '#1e1e2e');
        
        $this->assertTrue($linkResult['aa_normal'], 'Link color should pass AA normal text requirements');
        $this->assertGreaterThan(4.5, $linkResult['ratio'], 'Link contrast ratio should be greater than 4.5:1');
    }

    public function test_accessibility_guidelines_structure(): void
    {
        $guidelines = $this->accessibilityService->getAccessibilityGuidelines();

        $this->assertArrayHasKey('forms', $guidelines);
        $this->assertArrayHasKey('navigation', $guidelines);
        $this->assertArrayHasKey('content', $guidelines);
        $this->assertArrayHasKey('interactive', $guidelines);

        // Verify form guidelines
        $this->assertIsArray($guidelines['forms']);
        $this->assertContains('All form controls must have associated labels', $guidelines['forms']);
        $this->assertContains('Error messages must be announced to screen readers', $guidelines['forms']);

        // Verify navigation guidelines
        $this->assertIsArray($guidelines['navigation']);
        $this->assertContains('Navigation should be marked with proper semantic HTML', $guidelines['navigation']);
        $this->assertContains('Current page should be indicated in navigation', $guidelines['navigation']);

        // Verify content guidelines
        $this->assertIsArray($guidelines['content']);
        $this->assertContains('Heading levels should follow logical hierarchy (h1, h2, h3, etc.)', $guidelines['content']);
        $this->assertContains('Images should have meaningful alt text', $guidelines['content']);

        // Verify interactive guidelines
        $this->assertIsArray($guidelines['interactive']);
        $this->assertContains('All interactive elements should be keyboard accessible', $guidelines['interactive']);
        $this->assertContains('Focus should be managed properly in dynamic content', $guidelines['interactive']);
    }

    public function test_dashboard_page_accessibility(): void
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/dashboard');

        $response->assertStatus(200);

        // Check for proper heading hierarchy
        $response->assertSee('<h1', false); // Should have main page heading
        
        // Check for proper landmarks
        $response->assertSee('role="main"', false);
        $response->assertSee('role="navigation"', false);
        $response->assertSee('role="banner"', false);
        
        // Check for accessible images
        $response->assertSee('alt="', false);
        
        // Check for keyboard navigation support
        $response->assertSee('tabindex', false);
    }

    public function test_profile_page_accessibility(): void
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/profile');

        $response->assertStatus(200);

        // Check for proper form structure
        $response->assertSee('for=', false); // Form labels
        $response->assertSee('aria-label', false); // ARIA labels
        
        // Check for proper validation feedback
        $response->assertSee('role="alert"', false);
    }

    public function test_settings_page_accessibility(): void
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/settings');

        $response->assertStatus(200);

        // Check for accessible form controls
        $response->assertSee('for=', false);
        $response->assertSee('aria-', false);
    }

    public function test_skip_links_recommendation(): void
    {
        $audit = $this->accessibilityService->generateAccessibilityAudit();
        
        // Check that skip links are recommended in keyboard navigation
        $this->assertContains('Add skip links for better keyboard navigation', $audit['keyboard_navigation']['issues']);
    }
}