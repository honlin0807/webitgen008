<?php
require 'db.php';

$sql_company = "SELECT content_value FROM site_content WHERE content_key='company_name'";
$result_company = $conn->query($sql_company);
$row_company = $result_company->fetch_assoc();
$company_name = $row_company['content_value'];

$sql_about = "SELECT content_value FROM site_content WHERE content_key='about'";
$result_about = $conn->query($sql_about);
$row_about = $result_about->fetch_assoc();
$about = $row_about['content_value'];

$sql_mission = "SELECT content_value FROM site_content WHERE content_key='mission'";
$result_mission = $conn->query($sql_mission);
$row_mission = $result_mission->fetch_assoc();
$mission = $row_mission['content_value'];

$sql_vision = "SELECT content_value FROM site_content WHERE content_key='vision'";
$result_vision = $conn->query($sql_vision);
$row_vision = $result_vision->fetch_assoc();
$vision = $row_vision['content_value'];

$sql_values = "SELECT content_value FROM site_content WHERE content_key='values'";
$result_values = $conn->query($sql_values);
$row_values = $result_values->fetch_assoc();
$values = $row_values['content_value'];

$page_title = 'About Us | NEIVCE Trading PLT';
include 'header.php';
?>

<section class="page-banner">
    <p class="eyebrow">ABOUT NEIVCE</p>
    <h1>Local support for a digital future.</h1>
    <p>We make technology easier to understand and use.</p>
</section>

<section class="section two-col">
    <div>
        <h2>Our background</h2>
        <p><?php echo $about; ?></p>
        <h3>Business nature</h3>
        <p>NEIVCE Trading PLT operates in e-commerce, computer programming services and computer training.</p>
    </div>
    <aside class="info-box">
        <p class="small-label">OUR MISSION</p>
        <p><?php echo $mission; ?></p>
        <p class="small-label">OUR VISION</p>
        <p><?php echo $vision; ?></p>
    </aside>
</section>

<section class="values">
    <p class="eyebrow">OUR VALUES</p>
    <h2><?php echo $values; ?></h2>
</section>

<?php include 'footer.php'; ?>
