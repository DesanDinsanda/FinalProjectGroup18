<?php
include 'conf.php';
require_once('../tcpdf/tcpdf.php');

class Invoice {

    public function __construct($db) {
        $this->conn = $db;
    }

    public function viewInvoice($orderID) {
        // Fetch order details
        $query = "SELECT o.orderDate, o.eventDate, o.eventLocation, u.firstName, u.lastName, p.packageName, p.price, p.eventType 
                  FROM orders o 
                  JOIN user u ON o.customerID = u.ID 
                  JOIN package p ON o.pre_define_packageID = p.packageID OR o.custom_packageID = p.packageID
                  WHERE o.orderID = $orderID";
        
        $orderResult = mysqli_query($this->conn, $query);

        if (!$orderResult) {
            die("Invalid Order ID: " . mysqli_error($this->conn));
        }

        $order = mysqli_fetch_assoc($orderResult);

        if (!$order) {
            die("No order found with ID: $orderID");
        }


        // Generate Invoice No
        $year = date("Y");
        $invoiceNo = "DF-$year-$orderID";

        // Create PDF
        $pdf = new TCPDF();
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Dreams Flora');
        $pdf->SetTitle('Invoice');
        $pdf->SetMargins(10, 10, 10);
        $pdf->AddPage();

        // Invoice Header
        $html = "
    <h1>Dreams Flora & Dreams Event</h1>
    <p>G4HP+PPV, Agalawatta-Matugama Rd, Matugama.<br>
    Phone: +94 719058047 | Email: info@dreamsflora.com</p>
    <h2>Invoice</h2>
    <table border=\"0\">
        <tr><td><strong>Invoice No:</strong> $invoiceNo</td></tr>
        <tr><td><strong>Order ID:</strong> $orderID</td></tr>
        <tr><td><strong>Order Date:</strong> {$order['orderDate']}</td></tr>
    </table>

    <h3>Bill To:</h3>
    <table border=\"0\">
    <tr><td><strong>Customer Name:</strong> {$order['firstName']} {$order['lastName']}</td></tr>
    <tr><td><strong>Event Type:</strong> {$order['eventType']}</td></tr>
    <tr><td><strong>Event Date:</strong> {$order['eventDate']}</td></tr>
    <tr><td><strong>Location:</strong> {$order['eventLocation']}</td></tr>
    </table>

    <h3>Package Details:</h3>
    <table border=\"0\">
    <tr><td><strong>Package Name:</strong> {$order['packageName']}</td></tr>
    <tr><td><strong>Total Amount:</strong> LKR " . number_format($order['price'], 2) . "</td></tr>
    </table>
    <br>

    <h1><strong>Thank you for choosing Dreams Flora!</strong></h1>
";

        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('invoice.pdf', 'I');
    }
}
?>