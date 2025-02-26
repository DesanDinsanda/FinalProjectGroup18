<?php
class Package {
    protected $packageID;
    protected $packageName;
    protected $price;
    protected $eventType;
    protected $discount;

    // Constructor
    public function __construct($packageID, $packageName, $price, $eventType, $discount) {
        $this->packageID = $packageID;
        $this->packageName = $packageName;
        $this->price = $price;
        $this->eventType = $eventType;
        $this->discount = $discount;
    }

    // Getters and Setters
    public function getPackageID() {
        return $this->packageID;
    }

    public function setPackageID($packageID) {
        $this->packageID = $packageID;
    }

    public function getPackageName() {
        return $this->packageName;
    }

    public function setPackageName($packageName) {
        $this->packageName = $packageName;
    }

    public function getPrice() {
        return $this->price;
    }

    public function setPrice($price) {
        $this->price = $price;
    }

    public function getEventType() {
        return $this->eventType;
    }

    public function setEventType($eventType) {
        $this->eventType = $eventType;
    }

    public function getDiscount() {
        return $this->discount;
    }

    public function setDiscount($discount) {
        $this->discount = $discount;
    }
}
?>
