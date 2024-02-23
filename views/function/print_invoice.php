<?php
session_start();
require("../../assets/fpdf186/fpdf.php");
include './../../database/db.php';
date_default_timezone_set("Asia/Jakarta");

function format_money($angka)
{
    $new_price = "$" . number_format($angka, 2, ',', '.');
    return $new_price;
}

$id_user = $_SESSION['id_user'];
$id_rents = $_GET['id_rents'];

$query = mysqli_query($conn, "SELECT * FROM user WHERE id_user='$id_user'");
while ($data = mysqli_fetch_array($query)) {
    $name = $data['name'];
    $email = $data['email'];
    $phone = $data['phone'];
}

$query1 = mysqli_query($conn, "SELECT vehicles.vehicle_name, vehicles.price, rents.total_date, rents.amount FROM rents 
INNER JOIN vehicles ON rents.id_vehicle = vehicles.id_vehicle WHERE id_rents='$id_rents'");
while ($data = mysqli_fetch_array($query1)) {
    $vehicle_name = $data['vehicle_name'];
    $amount = format_money($data['amount']);
    $total_date = $data['total_date'];
    $amount = format_money($data['amount']);
}

//customer and invoice details
$info = [
    "customer" => "$name",
    "email" => "$email",
    "phone" => "$phone"
];


//invoice Products
$products_info = [
    [
        "name" => "$vehicle_name",
        "price" => "$amount",
        "qty" => $total_date,
        "total" => "$amount"
    ]
];

class PDF extends FPDF
{
    function Header()
    {

        //Display Company Info
        $this->SetFont('Arial', 'B', 14);
        $this->Cell(50, 10, "RENTALYUK", 0, 1);
        $this->SetFont('Arial', '', 14);
        $this->Cell(50, 7, "New York,", 0, 1);
        $this->Cell(50, 7, "US.", 0, 1);
        $this->Cell(50, 7, "Phone. +974 6671 5538", 0, 1);

        //Display INVOICE text
        $this->SetY(15);
        $this->SetX(-40);
        $this->SetFont('Arial', 'B', 18);
        $this->Cell(50, 10, "INVOICE", 0, 1);

        //Display Horizontal line
        $this->Line(0, 48, 210, 48);
    }

    function body($info, $products_info)
    {

        //Billing Details
        $this->SetY(55);
        $this->SetX(10);
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(50, 10, "To: ", 0, 1);
        $this->SetFont('Arial', '', 12);
        $this->Cell(50, 7, $info["customer"], 0, 1);
        $this->Cell(50, 7, $info["email"], 0, 1);
        $this->Cell(50, 7, $info["phone"], 0, 1);

        //Display Invoice no
        $this->SetY(55);
        $this->SetX(-60);
        $this->Cell(50, 7, "Invoice Date: " . date("d-m-Y"));


        //Display Invoice date
        // $this->SetY(63);
        // $this->SetX(-60);
        // $this->Cell(50, 7, "Invoice No : " . $info["invoice_no"]);

        //Display Table headings
        $this->SetY(95);
        $this->SetX(10);
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(50, 9, "Vehicle Name", 1, 0);
        $this->Cell(50, 9, "Price (per day)", 1, 0, "C");
        $this->Cell(40, 9, "Total day", 1, 0, "C");
        $this->Cell(50, 9, "TOTAL", 1, 1, "C");
        $this->SetFont('Arial', '', 12);

        //Display table product rows
        foreach ($products_info as $row) {
            $this->Cell(50, 9, $row["name"], "LR", 0);
            $this->Cell(50, 9, $row["price"], "R", 0, "R");
            $this->Cell(40, 9, $row["qty"], "R", 0, "C");
            $this->Cell(50, 9, $row["total"], "R", 1, "R");
        }
        //Display table empty rows
        for ($i = 0; $i < 12 - count($products_info); $i++) {
            $this->Cell(50, 9, "", "LR", 0);
            $this->Cell(50, 9, "", "R", 0, "R");
            $this->Cell(40, 9, "", "R", 0, "C");
            $this->Cell(50, 9, "", "R", 1, "R");
        }
        // Display table total row
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(140, 9, "TOTAL", 1, 0, "R");
        $this->Cell(50, 9, $row["total"], 1, 1, "R");

        // //Display amount in words
        // $this->SetY(225);
        // $this->SetX(10);
        // $this->SetFont('Arial', 'B', 12);
        // $this->Cell(0, 9, "Amount in Words ", 0, 1);
        // $this->SetFont('Arial', '', 12);
        // $this->Cell(0, 9, $info["words"], 0, 1);
    }
    function Footer()
    {

        //set footer position
        $this->SetY(-50);
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(0, 10, "Admin RentalYuk", 0, 1, "R");
        $this->Ln(15);
        $this->SetFont('Arial', '', 12);
        $this->Cell(0, 10, "Signature", 0, 1, "R");
        $this->SetFont('Arial', '', 10);

        //Display Footer Text
        $this->Cell(0, 10, "Bring this invoice on the day you rent!", 0, 1, "C");
    }
}
//Create A4 Page with Portrait 
$pdf = new PDF("P", "mm", "A4");
$pdf->AddPage();
$pdf->body($info, $products_info);
$pdf->Output('D', "Invoice" . '.pdf');
