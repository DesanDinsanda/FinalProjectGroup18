<?php
include 'conf.php';
class Review {
    private $description;
    private $reviewID;
    private $date;

    public function __construct($db) {
        $this->conn = $db;
    }
    public function getDescription() { return $this->description; }
    public function setDescription($description) { $this->description = $description; }

    public function getReviewID() { return $this->reviewID; }
    public function setReviewID($reviewID) { $this->reviewID = $reviewID; }

    public function getDate() { return $this->date; }
    public function setDate($date) { $this->date = $date; }


    public function addReviews() {}
    
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
