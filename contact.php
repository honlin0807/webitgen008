<?php
require 'db.php';

$sql_company = "SELECT content_value FROM site_content WHERE content_key='company_name'";
$result_company = $conn->query($sql_company);
$row_company = $result_company->fetch_assoc();
$company_name = $row_company['content_value'];

$sql_address = "SELECT content_value FROM site_content WHERE content_key='address'";
$result_address = $conn->query($sql_address);
$row_address = $result_address->fetch_assoc();
$address = $row_address['content_value'];

$sql_telephone = "SELECT content_value FROM site_content WHERE content_key='telephone'";
$result_telephone = $conn->query($sql_telephone);
$row_telephone = $result_telephone->fetch_assoc();
$telephone = $row_telephone['content_value'];

/* Read the extra company information for the Contact page. */
$sql_contact_about = "SELECT content_value FROM site_content WHERE content_key='contact_about'";
$result_contact_about = $conn->query($sql_contact_about);

if ($result_contact_about->num_rows > 0) {
    $row_contact_about = $result_contact_about->fetch_assoc();
    $contact_about = $row_contact_about['content_value'];
} else {
    $contact_about = 'NEIVCE Trading PLT provides e-commerce, computer programming services and computer training.';
}

$page_title = 'Contact | NEIVCE Trading PLT';
include 'header.php';
?>

<section class="page-banner">
    <p class="eyebrow">CONTACT US</p>
    <h1>Let's start a conversation.</h1>
    <p>Contact us for an enquiry or to learn more about our services.</p>
</section>

<section class="section contact-grid">
    <div class="enquiry-form">
        <h2>Company Information</h2>
        <div class="contact-detail">
            <strong>About Company</strong>
            <p><?php echo $contact_about; ?></p>
        </div>
        <div class="contact-detail">
            <strong>Address</strong>
            <p><?php echo $address; ?></p>
        </div>
        <div class="contact-detail">
            <strong>Telephone</strong>
            <p><?php echo $telephone; ?></p>
        </div>
    </div>
    <div class="map">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15937.731468116284!2d101.77326778715822!3d2.9772895000000004!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31cdcb8b8d2adf13%3A0xc20c0ed01b1bf4a5!2z5paw57qq5YWD5oqA6IGM5LiO5o6o5bm_5pWZ6IKy5a2m6Zmi!5e0!3m2!1szh-CN!2smy!4v1767338414655!5m2!1szh-CN!2smy" width="100%" height="600" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
</section>

<?php include 'footer.php'; ?>
