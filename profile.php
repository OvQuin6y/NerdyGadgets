<?php
include __DIR__ . "/header.php";

if (!isset($_SESSION)) {
    session_start();
}

$databaseConnection = connectToDatabase();

$klant = getKlant($databaseConnection, $_SESSION["klantID"]);

foreach ($klant

as $user):
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Profile</title>
    <link rel="stylesheet" href="Public/CSS/profile.css">
</head>
<body>
<div class="bodyContainer">
    <div id="formPopup" class="formPopup">
        <form method="post" action="profile.php">
            <div class="topContainer">
                <h3 id="title">Edit Details Here</h3>
                <svg id="exit" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                     class="w-6 h-6"
                     onclick="closePopup()">
                    <path fill-rule="evenodd"
                          d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zm-1.72 6.97a.75.75 0 10-1.06 1.06L10.94 12l-1.72 1.72a.75.75 0 101.06 1.06L12 13.06l1.72 1.72a.75.75 0 101.06-1.06L13.06 12l1.72-1.72a.75.75 0 10-1.06-1.06L12 10.94l-1.72-1.72z"
                          clip-rule="evenodd"/>
                </svg>
            </div>
            <div class="formContainer">
                <form method="post" action="profile.php">
                    <div class="editForm">
                        <div class="flexContainer">
                            <label id="labelEdit">First Name:</label>
                            <input id="inputEdit" type="text" name="firstName" value="<?= $user["FirstName"] ?>">
                            <label id="labelEdit2">Last Name:</label>
                            <input id="inputEdit2" type="text" name="lastName" value="<?= $user["LastName"] ?>">
                            <label id="labelEdit3">Email:</label>
                            <input id="inputEdit3" type="text" name="email" value="<?= $user["Email"] ?>">
                            <label id="labelEdit4">Phone Number:</label>
                            <input id="inputEdit4" type="text" name="phoneNumber" value="<?= $user["PhoneNumber"] ?>">
                            <label id="labelEdit5">Postal Code:</label>
                            <input id="inputEdit5" type="text" name="postalCode" value="<?= $user["PostalCode"] ?>">
                            <label id="labelEdit6">House Number:</label>
                            <input id="inputEdit6" type="text" name="houseNumber" value="<?= $user["HouseNumber"] ?>">
                            <label id="labelEdit7">City:</label>
                            <input id="inputEdit7" type="text" name="city" value="<?= $user["City"] ?>">
                        </div>
                    </div>

            </div>
            <div class="bottomContainer">
                <input type="submit" name="submit" class="submitForm" value="Submit" id="submitForm">
            </div>
        </form>
    </div>
    <div class="mainContainer">
        <div class="userDetailsContainer">
            <div class="left">
                <h5>Welcome!</h5>
                <h4><?= $user["FirstName"]; ?> <?= $user["LastName"] ?></h4>
            </div>
            <div class="middle">
                <h5>Email: <?= $user["Email"] ?></h5>
                <h5>Phonenumber: <?= $user["PhoneNumber"] ?></h5>
                <h5>Postal code & Housenumber: <?= $user["PostalCode"] ?>, <?= $user["HouseNumber"] ?></h5>
                <h5>City: <?= $user["City"] ?></h5>
            </div>
            <div class="right">
                <h5 onclick="openPopup()">Edit Details</h5>
            </div>
        </div>
        <div class="optionsContainer">
            <h5>Account</h5>
            <div class="account">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                    <path fill-rule="evenodd"
                          d="M7.502 6h7.128A3.375 3.375 0 0118 9.375v9.375a3 3 0 003-3V6.108c0-1.505-1.125-2.811-2.664-2.94a48.972 48.972 0 00-.673-.05A3 3 0 0015 1.5h-1.5a3 3 0 00-2.663 1.618c-.225.015-.45.032-.673.05C8.662 3.295 7.554 4.542 7.502 6zM13.5 3A1.5 1.5 0 0012 4.5h4.5A1.5 1.5 0 0015 3h-1.5z"
                          clip-rule="evenodd"/>
                    <path fill-rule="evenodd"
                          d="M3 9.375C3 8.339 3.84 7.5 4.875 7.5h9.75c1.036 0 1.875.84 1.875 1.875v11.25c0 1.035-.84 1.875-1.875 1.875h-9.75A1.875 1.875 0 013 20.625V9.375zM6 12a.75.75 0 01.75-.75h.008a.75.75 0 01.75.75v.008a.75.75 0 01-.75.75H6.75a.75.75 0 01-.75-.75V12zm2.25 0a.75.75 0 01.75-.75h3.75a.75.75 0 010 1.5H9a.75.75 0 01-.75-.75zM6 15a.75.75 0 01.75-.75h.008a.75.75 0 01.75.75v.008a.75.75 0 01-.75.75H6.75a.75.75 0 01-.75-.75V15zm2.25 0a.75.75 0 01.75-.75h3.75a.75.75 0 010 1.5H9a.75.75 0 01-.75-.75zM6 18a.75.75 0 01.75-.75h.008a.75.75 0 01.75.75v.008a.75.75 0 01-.75.75H6.75a.75.75 0 01-.75-.75V18zm2.25 0a.75.75 0 01.75-.75h3.75a.75.75 0 010 1.5H9a.75.75 0 01-.75-.75z"
                          clip-rule="evenodd"/>
                </svg>
                <h6>My Orders</h6>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                    <path fill-rule="evenodd"
                          d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.007 5.404.433c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.433 2.082-5.006z"
                          clip-rule="evenodd"/>
                </svg>
                <h6>Favorites</h6>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                    <path d="M5.85 3.5a.75.75 0 00-1.117-1 9.719 9.719 0 00-2.348 4.876.75.75 0 001.479.248A8.219 8.219 0 015.85 3.5zM19.267 2.5a.75.75 0 10-1.118 1 8.22 8.22 0 011.987 4.124.75.75 0 001.48-.248A9.72 9.72 0 0019.266 2.5z"/>
                    <path fill-rule="evenodd"
                          d="M12 2.25A6.75 6.75 0 005.25 9v.75a8.217 8.217 0 01-2.119 5.52.75.75 0 00.298 1.206c1.544.57 3.16.99 4.831 1.243a3.75 3.75 0 107.48 0 24.583 24.583 0 004.83-1.244.75.75 0 00.298-1.205 8.217 8.217 0 01-2.118-5.52V9A6.75 6.75 0 0012 2.25zM9.75 18c0-.034 0-.067.002-.1a25.05 25.05 0 004.496 0l.002.1a2.25 2.25 0 11-4.5 0z"
                          clip-rule="evenodd"/>
                </svg>
                <h6>Notifications</h6>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                    <path d="M12 1.5a.75.75 0 01.75.75V7.5h-1.5V2.25A.75.75 0 0112 1.5zM11.25 7.5v5.69l-1.72-1.72a.75.75 0 00-1.06 1.06l3 3a.75.75 0 001.06 0l3-3a.75.75 0 10-1.06-1.06l-1.72 1.72V7.5h3.75a3 3 0 013 3v9a3 3 0 01-3 3h-9a3 3 0 01-3-3v-9a3 3 0 013-3h3.75z"/>
                </svg>
                <h6>Placeholder</h6>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                    <path d="M12 1.5a.75.75 0 01.75.75V7.5h-1.5V2.25A.75.75 0 0112 1.5zM11.25 7.5v5.69l-1.72-1.72a.75.75 0 00-1.06 1.06l3 3a.75.75 0 001.06 0l3-3a.75.75 0 10-1.06-1.06l-1.72 1.72V7.5h3.75a3 3 0 013 3v9a3 3 0 01-3 3h-9a3 3 0 01-3-3v-9a3 3 0 013-3h3.75z"/>
                </svg>
                <h6>Placeholder</h6>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                    <path fill-rule="evenodd"
                          d="M11.078 2.25c-.917 0-1.699.663-1.85 1.567L9.05 4.889c-.02.12-.115.26-.297.348a7.493 7.493 0 00-.986.57c-.166.115-.334.126-.45.083L6.3 5.508a1.875 1.875 0 00-2.282.819l-.922 1.597a1.875 1.875 0 00.432 2.385l.84.692c.095.078.17.229.154.43a7.598 7.598 0 000 1.139c.015.2-.059.352-.153.43l-.841.692a1.875 1.875 0 00-.432 2.385l.922 1.597a1.875 1.875 0 002.282.818l1.019-.382c.115-.043.283-.031.45.082.312.214.641.405.985.57.182.088.277.228.297.35l.178 1.071c.151.904.933 1.567 1.85 1.567h1.844c.916 0 1.699-.663 1.85-1.567l.178-1.072c.02-.12.114-.26.297-.349.344-.165.673-.356.985-.57.167-.114.335-.125.45-.082l1.02.382a1.875 1.875 0 002.28-.819l.923-1.597a1.875 1.875 0 00-.432-2.385l-.84-.692c-.095-.078-.17-.229-.154-.43a7.614 7.614 0 000-1.139c-.016-.2.059-.352.153-.43l.84-.692c.708-.582.891-1.59.433-2.385l-.922-1.597a1.875 1.875 0 00-2.282-.818l-1.02.382c-.114.043-.282.031-.449-.083a7.49 7.49 0 00-.985-.57c-.183-.087-.277-.227-.297-.348l-.179-1.072a1.875 1.875 0 00-1.85-1.567h-1.843zM12 15.75a3.75 3.75 0 100-7.5 3.75 3.75 0 000 7.5z"
                          clip-rule="evenodd"/>
                </svg>
                <h6>Settings</h6>
            </div>
        </div>
        <div class="testContainer"></div>
    </div>
</div>
</body>
<script>
    var container = document.getElementById("formPopup")
    var containerExit = document.getElementById("exit")
    var title = document.getElementById("title")
    var firstName = document.getElementById("inputEdit")
    var lastName = document.getElementById("inputEdit2")
    var email = document.getElementById("inputEdit3")
    var phoneNumber = document.getElementById("inputEdit4")
    var postalCode = document.getElementById("inputEdit5")
    var houseNumber = document.getElementById("inputEdit6")
    var city = document.getElementById("inputEdit7")
    var label1 = document.getElementById("labelEdit")
    var label2 = document.getElementById("labelEdit2")
    var label3 = document.getElementById("labelEdit3")
    var label4 = document.getElementById("labelEdit4")
    var label5 = document.getElementById("labelEdit5")
    var label6 = document.getElementById("labelEdit6")
    var label7 = document.getElementById("labelEdit7")
    var submit = document.getElementById("submitForm")

    function openPopup() {
        container.style.transform = "translateY(-10vh)"
        container.style.zIndex = "1"
        container.style.position = "absolute"
        container.style.width = "75%"
        container.style.height = "100%"
        container.style.backgroundColor = "#444459"
        container.style.transition = "all 0.5s"
        container.style.display = "block"
        containerExit.style.display = "block"
        containerExit.style.width = "35px"
        containerExit.style.height = "auto"
        containerExit.style.cursor = "pointer"
        title.style.display = "block"
        title.style.fontSize = "22pt"
        firstName.style.display = "block"
        firstName.style.width = "40vh"
        firstName.style.height = "5vh"
        lastName.style.display = "block"
        lastName.style.width = "40vh"
        lastName.style.height = "5vh"
        email.style.display = "block"
        email.style.width = "40vh"
        email.style.height = "5vh"
        phoneNumber.style.display = "block"
        phoneNumber.style.width = "40vh"
        phoneNumber.style.height = "5vh"
        postalCode.style.display = "block"
        postalCode.style.width = "40vh"
        postalCode.style.height = "5vh"
        houseNumber.style.display = "block"
        houseNumber.style.width = "40vh"
        houseNumber.style.height = "5vh"
        city.style.display = "block"
        city.style.width = "40vh"
        city.style.height = "5vh"
        label1.style.display = "block"
        label2.style.display = "block"
        label3.style.display = "block"
        label4.style.display = "block"
        label5.style.display = "block"
        label6.style.display = "block"
        label7.style.display = "block"
        submit.style.display = "block"
        submit.style.width = "15vh"
        submit.style.height = "5vh"
    }

    function closePopup() {
        container.style.display = "hidden";
        container.style.width = "0%"
        container.style.transition = "all 0.5s"
        containerExit.style.display = "hidden"
        containerExit.style.width = "0px"
        title.style.display = "hidden"
        title.style.fontSize = "0"
        firstName.style.display = "none"
        firstName.style.width = "0%"
        firstName.style.height = "0vh"
        lastName.style.display = "none"
        lastName.style.width = "0%"
        lastName.style.height = "0vh"
        email.style.display = "none"
        email.style.width = "0%"
        email.style.height = "0vh"
        phoneNumber.style.display = "none"
        phoneNumber.style.width = "0%"
        phoneNumber.style.height = "0vh"
        postalCode.style.display = "none"
        postalCode.style.width = "0%"
        postalCode.style.height = "0vh"
        houseNumber.style.display = "none"
        houseNumber.style.width = "0%"
        houseNumber.style.height = "0vh"
        city.style.display = "none"
        city.style.width = "0%"
        city.style.height = "0vh"
        label1.style.display = "none"
        label2.style.display = "none"
        label3.style.display = "none"
        label4.style.display = "none"
        label5.style.display = "none"
        label6.style.display = "none"
        label7.style.display = "none"
        submit.style.display = "none"
        submit.style.width = "0vh"
        submit.style.height = "0vh"
    }
</script>
<?php endforeach;
if (!empty($_POST["firstName"]) && !empty($_POST["lastName"]) && !empty($_POST["email"]) && !empty($_POST["phoneNumber"]) && !empty($_POST["postalCode"]) && !empty($_POST["houseNumber"]) && !empty($_POST["city"])) {
    $firstName = $_POST["firstName"];
    $lastName = $_POST["lastName"];
    $email = $_POST["email"];
    $phoneNumber = $_POST["phoneNumber"];
    $postalCode = $_POST["postalCode"];
    $houseNumber = $_POST["houseNumber"];
    $city = $_POST["city"];

    if (preg_match('/^[0-9]{1,2}[0-9][0-9]? [A-Z]{2}$/', $postalCode)){
        updateKlant($databaseConnection, $_SESSION["klantID"], $firstName, $lastName, $email, $phoneNumber, $postalCode, $houseNumber, $city);
        ?>
        <script>
            window.location = 'profile.php'
        </script>
        <?php
    } else {
        ?>
        <script>
        alert("Postal code is incorrect. Type it like this 0000 AA");
        window.location = 'profile.php'
        </script>
        <?php
    }
}
?>
