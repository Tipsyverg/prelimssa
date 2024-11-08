<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Enrollment Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
<div class="container mt-5">
    <?php
    // Initialize variables to store first name and last name
    $firstName = '';
    $lastName = '';

    // Check if the enrollment form has been submitted
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['Enroll-Btn'])) {
        // Retrieve first name and last name from the POST request
        $firstName = htmlspecialchars($_POST['firstName']);
        $lastName = htmlspecialchars($_POST['lastName']);
        // Show the Grade Form
    ?>
        <h2>Enter Grades <?php echo $firstName . ' ' . $lastName; ?></h2>
        <form method="POST">
            <div class="mb-3">
                <label for="prelim" class="form-label">Prelim</label>
                <input type="number" class="form-control" id="prelim" name="prelim" placeholder="Enter Prelim Grade" required>
            </div>
            <div class="mb-3">
                <label for="midterm" class="form-label">Midterm</label>
                <input type="number" class="form-control" id="midterm" name="midterm" placeholder="Enter Midterm Grade" required>
            </div>
            <div class="mb-3">
                <label for="finals" class="form-label">Finals</label>
                <input type="number" class="form-control" id="finals" name="finals" placeholder="Enter Finals Grade" required>
            </div>
            <button type="submit" class="btn btn-success" name="submitGrades">Submit Grades</button>
        </form>
    <?php
    } else {
    ?>
        <h2>Student Enrollment Form</h2>
        <form method="POST">
            <div class="mb-3">
                <label for="firstName" class="form-label">First Name</label>
                <input type="text" class="form-control" id="firstName" name="firstName" placeholder="Enter First Name" required>
            </div>
            <div class="mb-3">
                <label for="lastName" class="form-label">Last Name</label>
                <input type="text" class="form-control" id="lastName" name="lastName" placeholder="Enter Last Name" required>
            </div>
            <div class="mb-3">
                <label for="age" class="form-label">Age</label>
                <input type="number" class="form-control" id="age" name="age" placeholder="Enter Age" required>
            </div>
            <div class="mb-3">
                <label for="course" class="form-label">Course</label>
                <input type="text" class="form-control" id="course" name="course" placeholder="Enter Course" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Gender</label><br>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="gender" id="male" value="male" required>
                    <label class="form-check-label" for="male">Male</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="gender" id="female" value="female" required>
                    <label class="form-check-label " for="female">Female</label>
                </div>
            </div>
            <button type="submit" class="btn btn-primary" name="Enroll-Btn">Enroll</button>
        </form>
    <?php
    }
    ?>
</div>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-1n0g0g0g0g0g0g0g0g0g0g0g0g0g0g0g0g0g0g0g0g0g0g0g0g0g0g0g0g0g0g0" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-1n0g0g0g0g0g0g0g0g0g0g0g0g0g0g0g0g0g0g0g0g0g0g0g0g0g0g0g0g0g0g0" crossorigin="anonymous"></script>
</body>
</html>