<?php
include 'conf.php';
session_start();

class Review {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function addReview($reviewDescription) {
        if (!isset($_SESSION['email'])) {
            return "User not logged in.";
        }

        // Get customer ID based on session email
        $email = $_SESSION['email'];
        $stmt = $this->conn->prepare("SELECT customerID FROM customers WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        if (!$row) {
            return "Customer not found.";
        }

        $customerID = $row['customerID'];
        $reviewDate = date("Y-m-d H:i:s");

        // Insert review into the database
        $stmt = $this->conn->prepare("INSERT INTO review (customerID, reviewDescription, reviewDate) VALUES (?, ?, ?)");
        $stmt->bind_param("iss", $customerID, $reviewDescription, $reviewDate);

        if ($stmt->execute()) {
            return "Review added successfully.";
        } else {
            return "Failed to add review.";
        }
    }
}
?>
