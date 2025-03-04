<?php
class FAQ {
    private $conn;
    private $faqID;
    private $question;
    private $answer;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getFaqID() { return $this->faqID; }
    public function setFaqID($faqID) { $this->faqID = $faqID; }

    public function getQuestion() { return $this->question; }
    public function setQuestion($question) { $this->question = $question; }

    public function getAnswer() { return $this->answer; }
    public function setAnswer($answer) { $this->answer = $answer; }
    

public function addFAQ($question, $answer) {
    // Escape special characters in the question and answer
    $question = mysqli_real_escape_string($this->conn, $question);
    $answer = mysqli_real_escape_string($this->conn, $answer);

    $sql = "INSERT INTO faq (question, answer) 
            VALUES ('$question', '$answer')";

    if (mysqli_query($this->conn, $sql)) {
        return "FAQ added successfully!";
    } else {
        return "Error adding FAQ!";
    }
}



    public function deleteFAQ($faqID) {
    $faqID = mysqli_real_escape_string($this->conn, $faqID);  // Escape the faqID

    $sql = "DELETE FROM faq WHERE faqID = '$faqID'";

    if (mysqli_query($this->conn, $sql)) {
        return "FAQ deleted successfully!";
    } else {
        return "Error deleting FAQ!";
    }
}



    public function getFAQDetails($faqID) {
    $faqID = mysqli_real_escape_string($this->conn, $faqID);  // Escape the faqID to prevent SQL injection

    $sql = "SELECT question, answer FROM faq WHERE faqID = '$faqID'";

    $result = mysqli_query($this->conn, $sql);
    if ($result) {
        return mysqli_fetch_assoc($result);
    } else {
        return null;
    }
}


    public function editFAQ($faqID, $question, $answer) {
    $faqID = mysqli_real_escape_string($this->conn, $faqID);  // Escape faqID
    $question = mysqli_real_escape_string($this->conn, $question);  // Escape question
    $answer = mysqli_real_escape_string($this->conn, $answer);  // Escape answer

    $sql = "UPDATE faq SET question = '$question', answer = '$answer' WHERE faqID = '$faqID'";

    if (mysqli_query($this->conn, $sql)) {
        return "FAQ updated successfully!";
    } else {
        return "Error updating FAQ!";
    }
}


    public function viewFAQ() {
        $sql = "SELECT * FROM faq";
        $result = mysqli_query($this->conn, $sql);
    
        $faqs = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $faqs[] = $row;
        }
        return $faqs;
    }
    
}
?>
