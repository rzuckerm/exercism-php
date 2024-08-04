<?php

function language_list(...$languages): array
{
    return $languages;
}

function add_to_language_list(array $language_list, string $language): array
{
    return array_merge($language_list, [$language]);
}

function prune_language_list(array $language_list): array
{
    return array_slice($language_list, 1);
}

function current_language(array $language_list): string
{
    return $language_list[0];
}

function language_list_length(array $language_list): int
{
    return count($language_list);
}
