<?php
namespace App;

use DateTime;

class MemberProcessor
{
    public $fullName;
    public $formattedName;
    public $address;
    public $reorderedAddress;
    public $contactNumber;
    public $internationalContactNumber;
    public $gender;
    public $birthday;
    public $age;
    public $membershipType;
    public $membershipCost;

    public function __construct($data)
    {
        $this->fullName = $data['full_name'];
        $this->formattedName = $this->formatName($data['full_name']);
        $this->address = $data['address'];
        $this->reorderedAddress = $this->reorderAddress($data['address']);
        $this->contactNumber = $data['contact_number'];
        $this->internationalContactNumber = $this->formatInternationalContact($data['contact_number']);
        $this->gender = strtoupper($data['gender']);
        $this->birthday = $data['birthday'];
        $this->age = $this->calculateAge($data['birthday']);
        $this->membershipType = $data['membership_type'];
        $this->membershipCost = $this->calculateMembershipCost($data['membership_type']);
    }

    private function formatName($fullName)
    {
        $nameParts = explode(' ', $fullName);
        $initials = [];
    
        foreach ($nameParts as $part) {
            $initials[] = strtoupper($part[0]) . '.';
        }
    
        $formattedName = implode(' ', array_slice($initials, 0, -1)) . ' ' . end($nameParts);
    
        return $formattedName;
        
    }

    private function reorderAddress($address)
    {
        $addressSections = explode(', ', $address);
        $reorderedAddress = implode(', ', array_reverse($addressSections));

        return $reorderedAddress;
    }

    private function formatInternationalContact($contactNumber)
    {

        $cleanedNumber = preg_replace('/[^0-9]/', '', $contactNumber);

        if (strlen($cleanedNumber) === 10 && substr($cleanedNumber, 0, 1) === '0') {
            $formattedNumber = '+94' . substr($cleanedNumber, 1);
        } else {
            $formattedNumber = $cleanedNumber;
        }

        return $formattedNumber;
    }

    private function calculateAge($birthday)
    {
        $birthDate = new DateTime($birthday);
        $currentDate = new DateTime();
        $ageInterval = $birthDate->diff($currentDate);
        $age = $ageInterval->y;

        return $age;
    }

    private function calculateMembershipCost($membershipType)
    {
        $membershipCosts = [
            'VIP' => 5000,
            'Gold' => 3000,
            'General' => 1000,
        ];
    
        $taxRate = 0.12;
    
        if (array_key_exists($membershipType, $membershipCosts)) {
            $baseCost = $membershipCosts[$membershipType];
            $taxAmount = $baseCost * $taxRate;
            $finalCost = $baseCost + $taxAmount;
    
            return $finalCost;
        } else {
            return 0; 
        }
    }
}
