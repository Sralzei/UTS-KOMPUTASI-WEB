<?php
include 'config.php';

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM about LIMIT 1"; 
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $about = $result->fetch_assoc();
} else {
    echo "0 results";
    exit; 
}

$sql_hobbies = "SELECT * FROM hobbies WHERE about_id = 1"; 
$result_hobbies = $conn->query($sql_hobbies);

$hobbies = [];
if ($result_hobbies->num_rows > 0) {
    while($row = $result_hobbies->fetch_assoc()) {
        $hobbies[] = $row; 
    }
} else {
    echo "0 hobbies found";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portofolio</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="aboutstyle.css"> 
</head>
<body>

 <!-- Navigation Bar -->
 <nav class="navbar navbar-expand-lg">
        <a class="navbar-brand" href="home.php">Portofolio</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item"><a class="nav-link" href="home.php">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="about.php">About Me</a></li>
                <li class="nav-item"><a class="nav-link" href="projects.php">Projects</a></li>
                <li class="nav-item"><a class="nav-link" href="certificate.php">Certificates</a></li>
                <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
            </ul>
        </div>
    </nav>

<!-- About Me Section -->
<div class="content container">
    <div class="section">
        <h2>Nama: <?php echo $about['name']; ?></h2>
        <h3>Program Studi: <?php echo $about['program_study']; ?></h3>
        
        <!-- Introduction Box -->
        <div class="introduction">
            <?php echo $about['introduction']; ?>
        </div>
    </div>

    <div class="section">
        <h4>Hobi:</h4>
        <div class="hobbies">
            <?php foreach ($hobbies as $hobby): ?>
                <div class="hobby-box">
                    <h5><?php echo $hobby['name']; ?></h5>
                    <p><?php echo $hobby['description']; ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<!-- JavaScript untuk animasi -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const sections = document.querySelectorAll('.section');
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
            }
        });
    }, { threshold: 0.1 });

    sections.forEach(section => {
        observer.observe(section);
    });
});
</script>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
