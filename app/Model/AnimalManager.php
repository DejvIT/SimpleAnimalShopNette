<?php

namespace App\Model;

use Nette\Utils\ArrayHash;
use SimpleXMLElement;

class AnimalManager
{
    /**
     * @param string $xmlFilePath
     */
    public function __construct(private readonly string $xmlFilePath) {}

    /**
     * @return array
     */
    public function loadAnimals(): array
    {
        if (!file_exists($this->xmlFilePath)) {
            return [];
        }

        // Load the XML file
        $xml = simplexml_load_file($this->xmlFilePath);

        // Convert XML to array
        $json = json_encode($xml);
        $array = json_decode($json, true);

        if (isset($array['animal'])) {
            if (isset($array['animal']['id'])) {
                return $array;
            } else {
                return $array['animal'];
            }
        }

        return [];
    }

    /**
     * Note: If you want to add more information about the animal (age, weight) you need to update
     * XML child architecture in this method. Do not forget update form latte, where HTML inputs are stored
     *
     * @param array $animals
     * @return void
     */
    public function saveAnimals(array $animals): void
    {
        $xml = new SimpleXMLElement('<animals/>');

        foreach ($animals as $animal) {
            $animalElement = $xml->addChild('animal');
            $animalElement->addChild('id', $animal['id']);
            $animalElement->addChild('name', $animal['name']);
            $animalElement->addChild('category', $animal['category']);
            $animalElement->addChild('image', $animal['image']);
            $animalElement->addChild('status', $animal['status']);
        }

        $xml->asXML($this->xmlFilePath);
    }

    public function addAnimal(ArrayHash $animal): void
    {
        $animalArray = [];
        foreach ($animal as $key => $value) {
            $animalArray[$key] = $value;
        }
        $animalArray['id'] = $this->getNextId($this->loadAnimals());
        $animals = $this->loadAnimals();
        $animals[] = $animalArray;
        $this->saveAnimals($animals);
    }

    public function updateAnimal(int $id, ArrayHash $updatedAnimal): void
    {
        $updatedAnimalArray = [];
        foreach ($updatedAnimal as $key => $value) {
            $updatedAnimalArray[$key] = $value;
        }
        $animals = $this->loadAnimals();
        foreach ($animals as &$animal) {
            if ($animal['id'] == $id) {
                $animal = array_merge($animal, $updatedAnimalArray);
                break;
            }
        }
        $this->saveAnimals($animals);
    }

    public function deleteAnimal(int $id): void
    {
        $animals = $this->loadAnimals();
        $animals = array_filter($animals, fn($animal) => $animal['id'] != $id);
        $this->saveAnimals($animals);
    }

    public function getAnimalById(int $id): ?array
    {
        $animals = $this->loadAnimals();
        foreach ($animals as $animal) {
            if ($animal['id'] == $id) {
                return $animal;
            }
        }
        return null;
    }

    public function getAnimalsByStatus(string $status): array
    {
        $animals = $this->loadAnimals();
        return array_filter($animals, fn($animal) => $animal['status'] == $status);
    }

    private function getNextId(array $animals): int
    {
        $ids = array_map(fn($animal) => $animal['id'], $animals);
        return $ids ? max($ids) + 1 : 1;
    }
}
