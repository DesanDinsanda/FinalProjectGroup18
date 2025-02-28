<?php
include 'conf.php';
class Review {
    private $reviewDiscription;
    private $reviewID;
    private $reviewDate;

    public function __construct($db) {
        $this->conn = $db;
    }
    public function getDescription() { return $this->reviewDiscription; }
    public function setDescription($reviewDiscription) { $this->reviewDiscription = $reviewDiscription; }

    public function getReviewID() { return $this->reviewID; }
    public function setReviewID($reviewID) { $this->reviewID = $reviewID; }

    public function getDate() { return $this->reviewDate; }
    public function setDate($reviewDate) { $this->reviewDate = $reviewDate; }


    public function addReview($reviewDescription) {
        if (!isset($_SESSION['email'])) {
            return "User not logged in.";
        }

        // Get customer ID based on session email
        $email = $_SESSION['email'];
        $stmt = $this->conn->prepare("SELECT ID FROM user WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        if (!$row) {
            return "Customer not found.";
        }

        $customerID = $row['ID'];
        $reviewDate = date("Y-m-d H:i:s");

        // Insert review into the database
        $stmt = $this->conn->prepare("INSERT INTO review (customerID, reviewDiscription, reviewDate) VALUES (?, ?, ?)");
        $stmt->bind_param("iss", $customerID, $reviewDescription, $reviewDate);

        if ($stmt->execute()) {
            return "Review added successfully.";
        } else {
            return "Failed to add review.";
        }
    }
    
    public function viewCustomerReviews() {
        $sql = "SELECT r.reviewID, r.reviewDate, r.reviewDiscription, u.firstName, u.email 
        FROM review r INNER JOIN user u ON r.customerID = u.ID ";
        $result = mysqli_query($this->conn, $sql);
        echo <<<HTML

        <html>
        <head>
        <title>Review</title>
        </head>
        <body>
            <div class="container my-4">
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Review ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Review Date</th>
                    <th>Review </th>
                    <th>Contact</th>
                </tr>
            </thead>
            <tbody>
HTML;

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo <<<HTML
            <tr>
                <td>{$row['reviewID']}</td>
                <td>{$row['firstName']}</td>
                <td>{$row['email']}</td>
                <td>{$row['reviewDate']}</td>
                <td>{$row['reviewDiscription']}</td>
                <td>
                    <a href='mailto:{$row['email']}' class='btn btn-success btn-sm'>Contact</a>
                </td>

                
            </tr>
HTML;
    }
}

echo <<<HTML
            </tbody>
        </table>
    </div> 
        </body>
        </html>
HTML;
    }
}
?>
