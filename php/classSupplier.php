<?php
include 'conf.php';

class Supplier {
    private $supplierID;
    private $firstName;
    private $lastName;
    private $telNO;
    private $email;
    private $province;
    private $city;
    private $streetName;

    public function __construct($db) {
        $this->conn = $db;
    }


    public function getSupplierID() { return $this->supplierID; }
    public function setSupplierID($supplierID) { $this->supplierID = $supplierID; }

    public function getFirstName() { return $this->firstName; }
    public function setFirstName($firstName) { $this->firstName = $firstName; }

    public function getLastName() { return $this->lastName; }
    public function setLastName($lastName) { $this->lastName = $lastName; }

    public function getTelNO() { return $this->telNO; }
    public function setTelNO($telNO) { $this->telNO = $telNO; }

    public function getEmail() { return $this->email; }
    public function setEmail($email) { $this->email = $email; }

    public function getProvince() { return $this->province; }
    public function setProvince($province) { $this->province = $province; }

    public function getCity() { return $this->city; }
    public function setCity($city) { $this->city = $city; }

    public function getStreetName() { return $this->streetName; }
    public function setStreetName($streetName) { $this->streetName = $streetName; }


    public function viewSupplier() {
        $sql = "SELECT s.supplierID, s.firstName, s.lastName, s.email, s.province, s.city, s.streetName,  st.telNO,   
                GROUP_CONCAT(i.itemName SEPARATOR ', ') AS itemNames,
                (SELECT COUNT(*) FROM favorite_suppliers WHERE supplierID = s.supplierID) AS isFavorite
                FROM supplier s 
                INNER JOIN supplier_telno st ON s.supplierID = st.supplierID
                INNER JOIN item_supplier its ON s.supplierID = its.supplierID  
                JOIN item i ON i.itemID = its.itemID
                GROUP BY s.supplierID";
        
        $result = mysqli_query($this->conn, $sql);
        
        echo <<<HTML
        <html>
        <head>
            <title>Suppliers</title>
            <script>
                function toggleFavorite(supplierID) {
                    var xhr = new XMLHttpRequest();
                    xhr.open("POST", "supplier_action.php", true);
                    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

                    xhr.onreadystatechange = function () {
                        if (xhr.readyState === 4 && xhr.status === 200) {
                            location.reload();
                        }
                    };

                    xhr.send("action=toggle_favorite&supplierID=" + supplierID);
                }
            </script>
        </head>
        <body>
            <div class="container my-4">
                <table class="table table-bordered table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>Supplier ID</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Province</th>
                            <th>City</th>
                            <th>Street Name</th>
                            <th>Mobile</th>
                            <th>Items</th>
                            <th>Action</th>
                            <th>Favorite</th>
                        </tr>
                    </thead>
                    <tbody>
HTML;

        while ($row = mysqli_fetch_assoc($result)) {
            $heartIcon = $row['isFavorite'] ? "❤️" : "🤍"; 

            echo <<<HTML
                <tr>
                    <td>{$row['supplierID']}</td>
                    <td>{$row['firstName']}</td>
                    <td>{$row['lastName']}</td>
                    <td>{$row['email']}</td>
                    <td>{$row['province']}</td>
                    <td>{$row['city']}</td>
                    <td>{$row['streetName']}</td>
                    <td>{$row['telNO']}</td>
                    <td>{$row['itemNames']}</td>
                    <td>
                        <a href='mailto:{$row['email']}' class='btn btn-success btn-sm'>Contact</a>
                    </td>
                    <td>
                        <button onclick="toggleFavorite({$row['supplierID']})" class="btn btn-light">{$heartIcon}</button>
                    </td>
                </tr>
HTML;
        }

        echo <<<HTML
                    </tbody>
                </table>
            </div>
        </body>
        </html>
HTML;
    }


        public function setSupplierToFavourite($supplierID) {
            $query = "SELECT * FROM favorite_suppliers WHERE supplierID = ?";
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param("i", $supplierID);
            $stmt->execute();
            $result = $stmt->get_result();
    
            if ($result->num_rows > 0) {
                $sql = "DELETE FROM favorite_suppliers WHERE supplierID = ?";
                $stmt = $this->conn->prepare($sql);
                $stmt->bind_param("i", $supplierID);
                $stmt->execute();
                return "removed";
            } else {
                $sql = "INSERT INTO favorite_suppliers (supplierID) VALUES (?)";
                $stmt = $this->conn->prepare($sql);
                $stmt->bind_param("i", $supplierID);
                $stmt->execute();
                return "added";
            }
        }
    
        public function deleteSupplierFromFavourite($supplierID) {
            $sql = "DELETE FROM favorite_suppliers WHERE supplierID = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("i", $supplierID);
            $stmt->execute();
        }

        public function viewFavouriteSupplier() {
            $sql = "SELECT s.supplierID, s.firstName, s.lastName, s.email, s.province, s.city, s.streetName,  st.telNO,   
                    GROUP_CONCAT(i.itemName SEPARATOR ', ') AS itemNames 
                    FROM favorite_suppliers fs
                    INNER JOIN supplier s ON fs.supplierID = s.supplierID
                    INNER JOIN supplier_telno st ON s.supplierID = st.supplierID
                    INNER JOIN item_supplier its ON s.supplierID = its.supplierID  
                    JOIN item i ON i.itemID = its.itemID
                    GROUP BY s.supplierID";
    
            $result = mysqli_query($this->conn, $sql);
    
            echo <<<HTML
            <html>
            <head>
                <title>Favorite Suppliers</title>
            </head>
            <body>
                <div class="container my-4">
                    
                    <table class="table table-bordered table-striped">
                        <thead class="table-dark">
                            <tr>
                                <th>Supplier ID</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Email</th>
                                <th>Province</th>
                                <th>City</th>
                                <th>Street Name</th>
                                <th>Mobile</th>
                                <th>Items</th>
                                <th>Remove</th>
                            </tr>
                        </thead>
                        <tbody>
    HTML;
    
            while ($row = mysqli_fetch_assoc($result)) {
                echo <<<HTML
                    <tr>
                        <td>{$row['supplierID']}</td>
                        <td>{$row['firstName']}</td>
                        <td>{$row['lastName']}</td>
                        <td>{$row['email']}</td>
                        <td>{$row['province']}</td>
                        <td>{$row['city']}</td>
                        <td>{$row['streetName']}</td>
                        <td>{$row['telNO']}</td>
                        <td>{$row['itemNames']}</td>
                        <td>
                            <button onclick="removeFavorite({$row['supplierID']})" class="btn btn-danger btn-sm">Remove</button>
                        </td>
                    </tr>
    HTML;
            }
    
            echo <<<HTML
                        </tbody>
                    </table>
                </div>
                <script>
                    function removeFavorite(supplierID) {
                        var xhr = new XMLHttpRequest();
                        xhr.open("POST", "supplier_action.php", true);
                        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    
                        xhr.onreadystatechange = function () {
                            if (xhr.readyState === 4 && xhr.status === 200) {
                                location.reload();
                            }
                        };
    
                        xhr.send("action=remove_favorite&supplierID=" + supplierID);
                    }
                </script>
            </body>
            </html>
    HTML;
        }

    public function deleteSupplier() {}
    public function addSupplier() {}
    public function updateSupplier() {}
    
    
    public function selectSupplier() {}
}
?>
