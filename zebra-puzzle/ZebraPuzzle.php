<?php

declare(strict_types=1);

class ZebraPuzzle
{
    const ITEMS = [
        "Nation" => ["Norwegian", "Spaniard", "Englishman", "Ukranian", "Japanese"],
        "Drink" => ["Tea", "Orange Juice", "Milk", "Water", "Coffee"],
        "Smoke" => ["Kools", "Old Gold", "Chesterfield", "Lucky Strike", "Parliament"],
        "Pet" => ["Dog", "Horse", "Snails", "Fox", "Zebra"]
    ];

    // Things that are known by working through the clues
    const KNOWNS = [
        // Since all colors are known, there's no need to include them
        // "Color" => ["Yellow", "Blue", "Red", "Ivory", "Green"],
        "Nation" => ["Norwegian", "", "Englishman", "", ""],
        "Drink" => ["", "", "Milk", "", "Coffee"],
        "Smoke" => ["Kools", "", "", "", ""],
        "Pet" => ["", "Horse", "", "", ""],
    ];

    // Combinations of pets and smokes that are known by working through the clues
    const KNOWN_COMBOS = [
        0 => [["Pet", "Fox"], ["Smoke", "Chesterfield"]],
        1 => [["Smoke", "Chesterfield"], ["Pet", "Fox"]],
        2 => [["Smoke", "Chesterfield"], ["Pet", "Fox"]],
        3 => [["Pet", "Fox"], ["Smoke", "Chesterfield"]],
    ];

    public function waterDrinker(): string
    {
        return $this->solve("Drink", "Water");
    }

    public function zebraOwner(): string
    {
        return $this->solve("Pet", "Zebra");
    }

    public function solve(string $category, string $target)
    {
        // Start with knowns and try known combinations
        foreach (self::KNOWN_COMBOS as $n => [[$category1, $item1], [$category2, $item2]]) {
            $solution = self::KNOWNS;
            [$solution[$category1][$n], $solution[$category2][$n + 1]] = [$item1, $item2];

            // Get candidate nations, drinks, smokes, and pets
            $candidates = array_combine(array_keys($solution), array_map(fn(array $items, array $row): array =>
                array_values(array_diff($items, $row)), self::ITEMS, $solution));
            $unknownIdxs = array_combine(array_keys($solution), array_map(fn(array $row): array =>
                array_keys(array_filter($row, fn(string $s): bool => !$s)), $solution));

            // Try out candidate nations
            foreach ($this->permutations($candidates["Nation"]) as $nations) {
                // Put this permutation of nations into the solution
                $this->setItems($solution["Nation"], $nations, $unknownIdxs["Nation"]);

                foreach ($this->permutations($candidates["Pet"]) as $pets) {
                    // Put this permutation of pets into the solution
                    $this->setItems($solution["Pet"], $pets, $unknownIdxs["Pet"]);

                    // If Spaniard doesn't have a dog, try another pet permutation
                    if (!$this->checkSolution($solution["Nation"], "Spaniard", $solution["Pet"], "Dog")) {
                        continue;
                    }

                    // Try out candidate smokes
                    foreach ($this->permutations($candidates["Smoke"]) as $smokes) {
                        // Put this permutation of smokes into the solution
                        $this->setItems($solution["Smoke"], $smokes, $unknownIdxs["Smoke"]);

                        // If the Japanese doesn't smoke Parliament or the owner of snails doesn't smoke Old Gold,
                        // try another smoke permutation
                        if (
                            !$this->checkSolution($solution["Nation"], "Japanese", $solution["Smoke"], "Parliament") ||
                            !$this->checkSolution($solution["Pet"], "Snails", $solution["Smoke"], "Old Gold")
                        ) {
                            continue;
                        }

                        // Try out candidate drinks
                        foreach ($this->permutations($candidates["Drink"]) as $drinks) {
                            // Put this permutation of drinks into the solution
                            $this->setItems($solution["Drink"], $drinks, $unknownIdxs["Drink"]);

                            // If the Ukranian drinks tea and the drinker of orange juice smokes Lucky Strike,
                            // return the solution
                            if (
                                $this->checkSolution($solution["Nation"], "Ukranian", $solution["Drink"], "Tea") &&
                                $this->checkSolution($solution["Drink"], "Orange Juice", $solution["Smoke"], "Lucky Strike")
                            ) {
                                return self::ITEMS["Nation"][array_search($target, $solution[$category])];
                            }
                        }
                    }
                }
            }
        }

        return "";
    }

    private function permutations(array $elements)
    {
        // Source: https://stackoverflow.com/questions/5506888/permutations-all-possible-sets-of-numbers
        if (count($elements) <= 1) {
            yield $elements;
        } else {
            foreach ($this->permutations(array_slice($elements, 1)) as $permutation) {
                foreach (range(0, count($elements) - 1) as $i) {
                    yield array_merge(
                        array_slice($permutation, 0, $i),
                        [$elements[0]],
                        array_slice($permutation, $i)
                    );
                }
            }
        }
    }

    private function setItems(array &$solution, array $items, array $indices): void
    {
        foreach (array_combine($indices, $items) as $index => $item) {
            $solution[$index] = $item;
        }
    }

    private function checkSolution(array $items1, string $item1, array $items2, string $item2): bool
    {
        return array_search($item1, $items1) == array_search($item2, $items2);
    }
}
