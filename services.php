<?php
require 'db.php';

$sql_company = "SELECT content_value FROM site_content WHERE content_key='company_name'";
$result_company = $conn->query($sql_company);
$row_company = $result_company->fetch_assoc();
$company_name = $row_company['content_value'];

/* Read all service descriptions from the Home table. */
$sql_home = "SELECT * FROM home_content WHERE id=1";
$result_home = $conn->query($sql_home);
$row_home = $result_home->fetch_assoc();

$ecommerce = $row_home['ecommerce'];
$programming = $row_home['programming'];
$training = $row_home['training'];

$page_title = 'Services | NEIVCE Trading PLT';
include 'header.php';
?>

<section class="page-banner">
    <p class="eyebrow">OUR SERVICES</p>
    <h1>Useful digital services.</h1>
    <p>We provide simple digital support and computer learning.</p>
</section>

<section class="section service-list">
    <article>
        <span>01</span>
        <div>
            <h2>E-commerce</h2>
            <p><?php echo $ecommerce; ?></p>
        </div>
    </article>
    <article>
        <span>02</span>
        <div>
            <h2>Computer programming services</h2>
            <p><?php echo $programming; ?></p>
        </div>
    </article>
    <article>
        <span>03</span>
        <div>
            <h2>Computer training</h2>
            <p><?php echo $training; ?></p>
        </div>
    </article>
</section>

<?php include 'footer.php'; ?>
