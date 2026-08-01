<?php

namespace App\Services;

class HtmlSanitizer
{
    /**
     * Sanitize HTML content to prevent XSS attacks.
     *
     * @param string|null $html
     * @return string
     */
    public static function clean(?string $html): string
    {
        if (empty($html)) {
            return '';
        }

        // 1. Allow only safe HTML tags for styling/formatting articles
        $allowedTags = '<p><h1><h2><h3><h4><h5><h6><strong><em><b><i><u><ul><ol><li><a><br><img><blockquote><pre><code><hr>';
        
        // Remove prohibited tags like <script>, <style>, <iframe>, etc.
        $cleaned = strip_tags($html, $allowedTags);

        // 2. Parse HTML using DOMDocument to remove dangerous inline event attributes and protocols
        libxml_use_internal_errors(true);
        $dom = new \DOMDocument();
        
        // Wrap with UTF-8 prefix to preserve special characters encoding
        $dom->loadHTML('<?xml encoding="utf-8" ?>' . $cleaned, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        
        $xpath = new \DOMXPath($dom);
        $elements = $xpath->query('//*');

        foreach ($elements as $element) {
            $attributesToRemove = [];
            
            foreach ($element->attributes as $attribute) {
                $name = strtolower($attribute->name);
                
                // Remove javascript event handlers (onload, onerror, onclick, etc.)
                if (str_starts_with($name, 'on')) {
                    $attributesToRemove[] = $attribute->name;
                }
                
                // Remove javascript: and data: protocols from dangerous attributes
                if (in_array($name, ['href', 'src', 'action'])) {
                    $value = strtolower(trim($attribute->value));
                    // Allow mailto: and tel: but strip javascript: and data:
                    if (str_contains($value, 'javascript:') || str_contains($value, 'data:')) {
                        $attributesToRemove[] = $attribute->name;
                    }
                }
            }
            
            foreach ($attributesToRemove as $attrName) {
                $element->removeAttribute($attrName);
            }
        }
        
        $result = $dom->saveHTML();
        libxml_clear_errors();

        // Remove XML prefix encoding
        return str_replace('<?xml encoding="utf-8" ?>', '', $result);
    }
}
