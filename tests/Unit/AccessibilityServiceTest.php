<?php

namespace Tests\Unit;

use App\Services\AccessibilityService;
use Tests\TestCase;

class AccessibilityServiceTest extends TestCase
{
    protected AccessibilityService $accessibilityService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->accessibilityService = new AccessibilityService();
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

    public function test_form_accessibility_validation(): void
    {
        $validFormData = [
            'labels' => true,
            'aria_attributes' => true,
            'keyboard_support' => true,
        ];

        $issues = $this->accessibilityService->validateFormAccessibility($validFormData);
        $this->assertEmpty($issues, 'Form accessibility validation should pass with no issues');
    }

    public function test_form_accessibility_validation_fails_without_labels(): void
    {
        $invalidFormData = [
            'labels' => false,
            'aria_attributes' => true,
            'keyboard_support' => true,
        ];

        $issues = $this->accessibilityService->validateFormAccessibility($invalidFormData);
        $this->assertContains('Forms should have proper labels for all input fields', $issues);
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

    public function test_skip_links_recommendation(): void
    {
        $audit = $this->accessibilityService->generateAccessibilityAudit();
        
        // Check that skip links are recommended in keyboard navigation
        $this->assertContains('Add skip links for better keyboard navigation', $audit['keyboard_navigation']['issues']);
    }
}