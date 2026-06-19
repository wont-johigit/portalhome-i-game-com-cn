<?php
/**
 * Site Meta Information
 * 
 * This file contains site metadata and provides utility methods
 * for generating description text snippets.
 */

// Site metadata array
$siteMeta = [
    'site_name' => 'Portal Home I Game',
    'domain' => 'portalhome-i-game.com.cn',
    'url' => 'https://portalhome-i-game.com.cn',
    'keywords' => ['爱游戏', 'portal', 'home', 'game', 'online'],
    'description' => '爱游戏门户平台，提供丰富的在线游戏体验',
    'language' => 'zh-CN',
    'version' => '1.0.0',
    'author' => 'PortalHome Team',
    'created' => '2024-01-01',
    'last_updated' => '2024-12-01'
];

/**
 * Generate a short description text from the site metadata.
 *
 * @param array $meta The metadata array (optional, uses default if not provided)
 * @param int $maxLength Maximum length of the generated description
 * @return string Generated description text
 */
function generateDescriptionText(array $meta = [], int $maxLength = 120): string
{
    // Use default metadata if none provided
    if (empty($meta)) {
        global $siteMeta;
        $meta = $siteMeta;
    }

    // Build description parts
    $parts = [];

    // Add site name if available
    if (!empty($meta['site_name'])) {
        $parts[] = $meta['site_name'];
    }

    // Add keywords as a comma-separated string
    if (!empty($meta['keywords']) && is_array($meta['keywords'])) {
        $keywordStr = implode('、', $meta['keywords']);
        $parts[] = $keywordStr;
    }

    // Add description if available
    if (!empty($meta['description'])) {
        $parts[] = $meta['description'];
    }

    // Add URL if available
    if (!empty($meta['url'])) {
        $parts[] = $meta['url'];
    }

    // Join parts with separator
    $fullText = implode(' - ', $parts);

    // Trim to max length
    if (mb_strlen($fullText) > $maxLength) {
        $fullText = mb_substr($fullText, 0, $maxLength - 3) . '...';
    }

    return $fullText;
}

/**
 * Get a formatted meta tag string for HTML head.
 *
 * @param array $meta The metadata array (optional)
 * @return string HTML meta tags
 */
function getMetaTags(array $meta = []): string
{
    if (empty($meta)) {
        global $siteMeta;
        $meta = $siteMeta;
    }

    $tags = '';
    
    // Meta description
    if (!empty($meta['description'])) {
        $desc = htmlspecialchars($meta['description'], ENT_QUOTES, 'UTF-8');
        $tags .= "<meta name=\"description\" content=\"{$desc}\">\n";
    }

    // Meta keywords
    if (!empty($meta['keywords']) && is_array($meta['keywords'])) {
        $keywords = htmlspecialchars(implode(', ', $meta['keywords']), ENT_QUOTES, 'UTF-8');
        $tags .= "<meta name=\"keywords\" content=\"{$keywords}\">\n";
    }

    // Meta author
    if (!empty($meta['author'])) {
        $author = htmlspecialchars($meta['author'], ENT_QUOTES, 'UTF-8');
        $tags .= "<meta name=\"author\" content=\"{$author}\">\n";
    }

    // Canonical URL
    if (!empty($meta['url'])) {
        $url = htmlspecialchars($meta['url'], ENT_QUOTES, 'UTF-8');
        $tags .= "<link rel=\"canonical\" href=\"{$url}\">\n";
    }

    // Language
    if (!empty($meta['language'])) {
        $lang = htmlspecialchars($meta['language'], ENT_QUOTES, 'UTF-8');
        $tags .= "<meta http-equiv=\"Content-Language\" content=\"{$lang}\">\n";
    }

    return $tags;
}

/**
 * Generate a summary array from metadata.
 *
 * @param array $meta The metadata array (optional)
 * @return array Summary with key info
 */
function getMetaSummary(array $meta = []): array
{
    if (empty($meta)) {
        global $siteMeta;
        $meta = $siteMeta;
    }

    return [
        'name' => $meta['site_name'] ?? 'Unknown',
        'domain' => $meta['domain'] ?? '',
        'description' => generateDescriptionText($meta, 100),
        'keyword_count' => isset($meta['keywords']) ? count($meta['keywords']) : 0,
        'has_url' => !empty($meta['url']),
    ];
}

// Example usage (uncomment to test)
/*
$desc = generateDescriptionText();
echo $desc . "\n";

$tags = getMetaTags();
echo $tags;

$summary = getMetaSummary();
print_r($summary);
*/