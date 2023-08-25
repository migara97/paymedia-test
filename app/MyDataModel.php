<?php
namespace App;

class MyDataModel
{
    public $fullName;
    public $formattedName;
    public $address;
    public $reorderedAddress;
    public $contactNumber;
    public $internationalContactNumber;
    public $contactNumberType;
    public $gender;
    public $birthday;
    public $age;
    public $membershipType;
    public $membershipValueBeforeTax;
    public $finalAmountAfterTax;

    public function __construct(MemberProcessor $memberProcessor)
    {
        $this->fullName = $memberProcessor->fullName;
        $this->formattedName = $memberProcessor->formattedName;
        $this->address = $memberProcessor->address;
        $this->reorderedAddress = $memberProcessor->reorderedAddress;
        $this->contactNumber = $memberProcessor->contactNumber;
        $this->internationalContactNumber = $memberProcessor->internationalContactNumber;
        $this->contactNumberType = $this->getContactNumberType($memberProcessor->contactNumber);
        $this->gender = $memberProcessor->gender;
        $this->birthday = $memberProcessor->birthday;
        $this->age = $memberProcessor->age;
        $this->membershipType = $memberProcessor->membershipType;
        $this->membershipValueBeforeTax = $memberProcessor->membershipCost - ($memberProcessor->membershipCost * 0.12);
        $this->finalAmountAfterTax = $memberProcessor->membershipCost;
    }

    private function getContactNumberType($contactNumber)
    {
        $cleanedNumber = preg_replace('/[^0-9]/', '', $contactNumber);

        if (strlen($cleanedNumber) == 10 && in_array(substr($cleanedNumber, 0, 2), ['07', '08'])) {
            return 'Mobile Number';
        } elseif (strlen($cleanedNumber) == 10 && substr($cleanedNumber, 0, 2) == '01') {
            return 'Landline';
        } else {
            return 'Unknown';
        }
    }
}
