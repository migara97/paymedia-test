<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Member List</title>
</head>
<body>
    <div>
        <p>Full Name: {{ $dataModel->fullName }}</p>
        <p>Name with Initials: {{ $dataModel->formattedName }}</p>
        <p>Address: {{ $dataModel->address }}</p>
        <p>Reversed Address: {{ $dataModel->reorderedAddress }}</p>
        <p>Contact Number in Local Format: {{ $dataModel->contactNumber }}</p>
        <p>Contact Number in International Format: {{ $dataModel->internationalContactNumber }}</p>
        <p>Contact Number Type: {{ $dataModel->contactNumberType }}</p>
        <p>Gender: {{ $dataModel->gender }}</p>
        <p>Birthday: {{ $dataModel->birthday }}</p>
        <p>Age: {{ $dataModel->age }} years</p>
        <p>Membership Type: {{ $dataModel->membershipType }}</p>
        <p>Membership Value Before Tax: {{ $dataModel->membershipValueBeforeTax }}</p>
        <p>Final Amount after Tax: {{ $dataModel->finalAmountAfterTax }}</p>
    </div>
</body>
</html>