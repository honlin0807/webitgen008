<?php
session_start();
if (!isset($_SESSION['admin_username'])) {
    header('Location: admin_login.php');
    exit();
}

require 'db.php';
$message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    /* Get the form values and use real_escape_string before SQL update. */
    $announcement = $conn->real_escape_string($_POST['announcement']);
    $introduction = $conn->real_escape_string($_POST['introduction']);
    $about = $conn->real_escape_string($_POST['about']);
    $mission = $conn->real_escape_string($_POST['mission']);
    $vision = $conn->real_escape_string($_POST['vision']);
    $values = $conn->real_escape_string($_POST['values']);
    $ecommerce = $conn->real_escape_string($_POST['service_ecommerce']);
    $programming = $conn->real_escape_string($_POST['service_programming']);
    $training = $conn->real_escape_string($_POST['service_training']);
    $address = $conn->real_escape_string($_POST['address']);
    $telephone = $conn->real_escape_string($_POST['telephone']);
    $contact_about = $conn->real_escape_string($_POST['contact_about']);

    /* Update each selected website content in MySQL. */
    $sql_home = "UPDATE home_content SET announcement='$announcement', introduction='$introduction', ecommerce='$ecommerce', programming='$programming', training='$training' WHERE id=1";
    $conn->query($sql_home);

    $sql_about = "UPDATE site_content SET content_value='$about' WHERE content_key='about'";
    $conn->query($sql_about);

    $sql_mission = "UPDATE site_content SET content_value='$mission' WHERE content_key='mission'";
    $conn->query($sql_mission);

    $sql_vision = "UPDATE site_content SET content_value='$vision' WHERE content_key='vision'";
    $conn->query($sql_vision);

    $sql_values = "UPDATE site_content SET content_value='$values' WHERE content_key='values'";
    $conn->query($sql_values);

    $sql_address = "UPDATE site_content SET content_value='$address' WHERE content_key='address'";
    $conn->query($sql_address);

    $sql_telephone = "UPDATE site_content SET content_value='$telephone' WHERE content_key='telephone'";
    $conn->query($sql_telephone);

    /* Add the new Contact page information if it does not exist yet. */
    $check_sql = "SELECT content_key FROM site_content WHERE content_key='contact_about'";
    $check_result = $conn->query($check_sql);

    if ($check_result->num_rows > 0) {
        $sql_contact_about = "UPDATE site_content SET content_value='$contact_about' WHERE content_key='contact_about'";
        $conn->query($sql_contact_about);
    } else {
        $sql_contact_about = "INSERT INTO site_content (content_key, content_value) VALUES ('contact_about', '$contact_about')";
        $conn->query($sql_contact_about);
    }

    $message = '<p class="success">Website content updated successfully.</p>';
}

/* Read each value from MySQL to show inside the form. */
$sql_company = "SELECT content_value FROM site_content WHERE content_key='company_name'";
$result_company = $conn->query($sql_company);
$row_company = $result_company->fetch_assoc();
$company_name = $row_company['content_value'];

$sql_home = "SELECT * FROM home_content WHERE id=1";
$result_home = $conn->query($sql_home);
$row_home = $result_home->fetch_assoc();

$announcement = $row_home['announcement'];
$introduction = $row_home['introduction'];
$ecommerce = $row_home['ecommerce'];
$programming = $row_home['programming'];
$training = $row_home['training'];

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

$sql_address = "SELECT content_value FROM site_content WHERE content_key='address'";
$result_address = $conn->query($sql_address);
$row_address = $result_address->fetch_assoc();
$address = $row_address['content_value'];

$sql_telephone = "SELECT content_value FROM site_content WHERE content_key='telephone'";
$result_telephone = $conn->query($sql_telephone);
$row_telephone = $result_telephone->fetch_assoc();
$telephone = $row_telephone['content_value'];

$sql_contact_about = "SELECT content_value FROM site_content WHERE content_key='contact_about'";
$result_contact_about = $conn->query($sql_contact_about);

if ($result_contact_about->num_rows > 0) {
    $row_contact_about = $result_contact_about->fetch_assoc();
    $contact_about = $row_contact_about['content_value'];
} else {
    $contact_about = 'NEIVCE Trading PLT provides e-commerce, computer programming services and computer training.';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="styles/styles.css">
</head>
<body class="dashboard-body">
    <header class="admin-header">
        <a href="index.php">NEIVCE Trading PLT</a>
        <div>
            Welcome, <?php echo $_SESSION['admin_username']; ?> |
            <a href="admin_logout.php">Log out</a>
        </div>
    </header>

    <main class="dashboard">
        <h1>Admin Dashboard</h1>
        <p>Change the information below and click Save Changes.</p>
        <?php echo $message; ?>

        <form action="admin_dashboard.php" method="post" class="editor-form">
            <section>
                <h2>Home Page</h2>
                <p><strong>Company Name:</strong> <?php echo $company_name; ?> (fixed)</p>
                <label>Homepage Announcement</label>
                <textarea name="announcement" rows="3"><?php echo $announcement; ?></textarea>
                <label>Company Introduction</label>
                <textarea name="introduction" rows="4"><?php echo $introduction; ?></textarea>
            </section>

            <section>
                <h2>About Us</h2>
                <label>Company Background</label>
                <textarea name="about" rows="4"><?php echo $about; ?></textarea>
                <label>Mission</label>
                <textarea name="mission" rows="2"><?php echo $mission; ?></textarea>
                <label>Vision</label>
                <textarea name="vision" rows="2"><?php echo $vision; ?></textarea>
                <label>Values</label>
                <textarea name="values" rows="2"><?php echo $values; ?></textarea>
            </section>

            <section>
                <h2>Services</h2>
                <label>E-commerce Description</label>
                <textarea name="service_ecommerce" rows="3"><?php echo $ecommerce; ?></textarea>
                <label>Programming Description</label>
                <textarea name="service_programming" rows="3"><?php echo $programming; ?></textarea>
                <label>Computer Training Description</label>
                <textarea name="service_training" rows="3"><?php echo $training; ?></textarea>
            </section>

            <section>
                <h2>Contact Details</h2>
                <label>Address</label>
                <textarea name="address" rows="3"><?php echo $address; ?></textarea>
                <label>Telephone Number</label>
                <input type="text" name="telephone" value="<?php echo $telephone; ?>">
                <label>About Company</label>
                <textarea name="contact_about" rows="4"><?php echo $contact_about; ?></textarea>
            </section>

            <input type="submit" class="save-button" value="Save Changes">
        </form>
    </main>
</body>
</html>
