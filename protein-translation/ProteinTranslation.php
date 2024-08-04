<?php

declare(strict_types=1);

class ProteinTranslation
{
    public function getProteins(string $codons): array
    {
        $proteins = [];
        [$codons, $numCodons] = [str_split($codons, 3), intdiv(strlen($codons) + 2, 3)];
        for ($i = 0; $i < $numCodons && !in_array($codons[$i], ["UAA", "UAG", "UGA"]); $i++) {
            $proteins[] = match ($codons[$i]) {
                "AUG" => "Methionine",
                "UUU", "UUC" => "Phenylalanine",
                "UUA", "UUG" => "Leucine",
                "UCU", "UCC", "UCA", "UCG" => "Serine",
                "UAU", "UAC" => "Tyrosine",
                "UGU", "UGC" => "Cysteine",
                "UGG" => "Tryptophan",
                default => throw new \InvalidArgumentException("Invalid codon"),
            };
        }

        return $proteins;
    }
}
