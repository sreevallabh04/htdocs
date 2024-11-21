<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $errors = [];

    // Get form values
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Validate username
    if (empty($username)) {
        $errors['username'] = "Username is required";
    }

    // Validate email
    if (empty($email)) {
        $errors['email'] = "Email is required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Enter a valid email";
    } elseif (!preg_match("/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/", $email)) {
        $errors['email'] = "Email does not match the required format";
    }

    // Validate password
    if (empty($password)) {
        $errors['password'] = "Password is required";
    } elseif (strlen($password) < 8) {
        $errors['password'] = "Password must be at least 8 characters";
    }

    // If there are errors, display them
    if (!empty($errors)) {
        echo "<h3>Form Errors:</h3><ul>";
        foreach ($errors as $field => $error) {
            echo "<li><strong>" . ucfirst($field) . ":</strong> $error</li>";
        }
        echo "</ul>";
        echo '<a href="javascript:history.back()">Go Back</a>';
    } else {
        // Insert data into database
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT); // Secure password
        $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $email, $hashedPassword);

        if ($stmt->execute()) {
            echo "<h3>Form submitted successfully!</h3>";
            echo "<p>Username: $username</p>";
            echo "<p>Email: $email</p>";
        } else {
            echo "<h3>Error saving data:</h3>" . $stmt->error;
        }
        $stmt->close();
    }
}

$conn->close();
?>
