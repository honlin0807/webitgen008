<?php
require 'db.php';

/* Read the fixed company name. */
$sql_company = "SELECT content_value FROM site_content WHERE content_key='company_name'";
$result_company = $conn->query($sql_company);
$row_company = $result_company->fetch_assoc();
$company_name = $row_company['content_value'];

/* Read all Home page information in one SQL query. */
$sql_home = "SELECT * FROM home_content WHERE id=1";
$result_home = $conn->query($sql_home);
$row_home = $result_home->fetch_assoc();

$introduction = $row_home['introduction'];
$announcement = $row_home['announcement'];
$ecommerce = $row_home['ecommerce'];
$programming = $row_home['programming'];
$training = $row_home['training'];

$page_title = 'Home | NEIVCE Trading PLT';
include 'header.php';
?>

<section class="hero">
    <div class="hero-copy">
        <p class="eyebrow">DIGITAL SOLUTIONS - KAJANG</p>
        <h1>Grow with practical digital support.</h1>
        <p><?php echo $introduction; ?></p>
        <a class="button" href="services.php">Explore Our Services</a>
    </div>
    <div class="hero-card">
        <p class="small-label">LATEST ANNOUNCEMENT</p>
        <p><?php echo $announcement; ?></p>
    </div>
</section>

<section class="section">
    <div class="section-heading">
        <p class="eyebrow">WHAT WE DO</p>
        <h2>Business highlights</h2>
        <p>Simple services with real value for your business and your skills.</p>
    </div>
    <div class="cards">
        <article class="card">
            <div class="icon">01</div>
            <h3>E-commerce</h3>
            <p><?php echo $ecommerce; ?></p>
        </article>
        <article class="card">
            <div class="icon">02</div>
            <h3>Programming</h3>
            <p><?php echo $programming; ?></p>
        </article>
        <article class="card">
            <div class="icon">03</div>
            <h3>Computer Training</h3>
            <p><?php echo $training; ?></p>
        </article>
    </div>
</section>
<?php include 'footer.php'; ?>
