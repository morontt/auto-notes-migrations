<?php

$finder = (new PhpCsFixer\Finder())
    ->in(__DIR__);

return (new PhpCsFixer\Config())
    ->setRules([
        '@PSR12' => true,
        'array_syntax' => ['syntax' => 'short'],
        'concat_space' => ['spacing' => 'one'],
        'ordered_imports' => [
            'imports_order' => ['class', 'function', 'const'],
            'sort_algorithm' => 'alpha'
        ],
        'single_quote' => true,
        'no_extra_blank_lines' => [
            'tokens' => ['attribute', 'case', 'continue', 'curly_brace_block', 'default', 'extra',
                'parenthesis_brace_block', 'square_brace_block', 'switch', 'throw', 'use']
        ],
        'blank_line_before_statement' => ['statements' => ['return']],
    ])
    ->setFinder($finder);
