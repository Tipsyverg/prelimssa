<?php
session_start();

// Clear all session data on initial load
if (!isset($_SESSION['initialized'])) {
    $_SESSION['initialized'] = true;
    $_SESSION['showResults'] = false;
    $_SESSION['studentFirstName'] = '';
    $_SESSION['studentLastName'] = '';
    $_SESSION['studentAge'] = '';
    $_SESSION['studentGender'] = '';
    $_SESSION['studentCourse'] = '';
    $_SESSION['studentEmail'] = '';
    $_SESSION['gradePrelim'] = '';
    $_SESSION['gradeMidterm'] = '';
    $_SESSION['gradeFinals'] = '';
    $_SESSION['gradeAverage'] = '';
    $_SESSION['gradeStatus'] = '';
}

// Handle form submissions
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['submitStudent'])) {
        // Store student details in session variables
        $_SESSION['studentFirstName'] = htmlspecialchars(trim($_POST['studentFirstName']));
        $_SESSION['studentLastName'] = htmlspecialchars(trim($_POST['studentLastName']));
        $_SESSION['studentAge'] = htmlspecialchars(trim($_POST['studentAge']));
        $_SESSION['studentGender'] = htmlspecialchars(trim($_POST['studentGender']));
        $_SESSION['studentCourse'] = htmlspecialchars(trim($_POST['studentCourse']));
        $_SESSION['studentEmail'] = htmlspecialchars(trim($_POST['studentEmail']));

        // Hide results display and enable grade form
        $_SESSION['showResults'] = false;
        $_SESSION['showGradeForm'] = true;
    } elseif (isset($_POST['submitGrades'])) {
        // Retrieve grades
        $gradePrelim = isset($_POST['gradePrelim']) ? (float)$_POST['gradePrelim'] : 0;
        $gradeMidterm = isset($_POST['gradeMidterm']) ? (float)$_POST['gradeMidterm'] : 0;
        $gradeFinals = isset($_POST['gradeFinals']) ? (float)$_POST['gradeFinals'] : 0;

        // Calculate average
        $gradeAverage = round(($gradePrelim + $gradeMidterm + $gradeFinals) / 3, 2);
        $gradeStatus = $gradeAverage >= 75 ? "Passed" : "Failed";

        // Store grades and results
        $_SESSION['gradePrelim'] = $gradePrelim;
        $_SESSION['gradeMidterm'] = $gradeMidterm;
        $_SESSION['gradeFinals'] = $gradeFinals;
        $_SESSION['gradeAverage'] = $gradeAverage;
        $_SESSION['gradeStatus'] = $gradeStatus;

        // Show results display
        $_SESSION['showResults'] = true;

        // Reset the grade form flag
        unset($_SESSION['showGradeForm']);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Enrollment</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }
        .container {
            background: #ffffff;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-top: 50px;
        }
        h3, h2 {
            color: #343a40;
        }
        .nav-tabs .nav-link {
            border: none;
            color: #495057;
        }
        .nav-tabs .nav-link.active {
            background-color: #007bff;
            color: white;
        }
        .btn-primary {
            background-color: #007bff;
            border: none;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        .results {
            background: #e9ecef;
            padding: 15px;
            border-radius: 8px;
            margin-top: 20px;
        }
        .text-success {
            color: #28a745;
        }
        .text-danger {
            color: #dc3545;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="tab-content">
            <div class="tab-pane fade <?php echo !isset($_SESSION['showGradeForm']) ? 'show active' : ''; ?>" id="register">
                <h3>Student Enrollment Form</h3>
                <form method="POST">
                    <div class="mb-3">
                        <input type="text" name="studentFirstName" class="form-control" placeholder="First Name" required>
                    </div>
                    <div class="mb-3">
                        <input type="text" name="studentLastName" class="form-control" placeholder="Last Name" required>
                    </div>
                    <div class="mb-3">
                        <input type="number" name="studentAge" class="form-control" placeholder="Age" required>
                    </div>
                    <div class="mb-3">
                        <input type="text" name="studentCourse" class="form-control" placeholder="Course" required>
                    </div>
                    <div class="mb-3">
                        <input type="email" name="studentEmail" class="form-control" placeholder="Email" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Gender:</label>
                        <div>
                            <label class="me-3"><input type="radio" name="studentGender" value="male" checked> Male</label>
                            <label><input type="radio" name="studentGender" value="female"> Female</label>
                        </div>
                    </div>
                    <input type="submit" name="submitStudent" value="Next" class="btn btn-primary mt-2">
                </form>
            </div>

            <?php if (isset($_SESSION['showGradeForm'])): ?>
                <div class="tab-pane fade show active" id="grades">
                    <h3>Enter Grades for <?php echo $_SESSION['studentFirstName'] . ' ' . $_SESSION['studentLastName']; ?></h3>
                    <form method="POST">
                        <div class="mb-3">
                            <input type="number" name="gradePrelim" class="form-control" placeholder="Prelim" required>
                        </div>
                        <div class="mb-3">
                            <input type="number" name="gradeMidterm" class="form-control" placeholder="Midterm" required>
                        </div>
                        <div class="mb-3">
                            <input type="number" name="gradeFinals" class="form-control" placeholder="Final" required>
                        </div>
                        <input type="submit" name="submitGrades" value="Submit Grades" class="btn btn-primary mt-2">
                    </form>
                </div>
            <?php endif; ?>
        </div>

        <?php if ($_SESSION['showResults']): ?>
            <div class="results mt-4">
                <h2>Student</h2>
                <p>First Name: <?php echo $_SESSION['studentFirstName']; ?></p>
                <p>Last Name: <?php echo $_SESSION['studentLastName']; ?></p>
                <p>Age: <?php echo $_SESSION['studentAge']; ?></p>
                <p>Gender: <?php echo ucfirst($_SESSION['studentGender']); ?></p>
                <p>Course: <?php echo $_SESSION['studentCourse']; ?></p>
                <p>Email: <?php echo $_SESSION['studentEmail']; ?></p>

                <h2>Grades</h2>
                <p>Prelim: <?php echo $_SESSION['gradePrelim']; ?></p>
                <p>Midterm: <?php echo $_SESSION['gradeMidterm']; ?></p>
                <p>Finals: <?php echo $_SESSION['gradeFinals']; ?></p>
                <p><strong>Average:</strong> <?php echo $_SESSION['gradeAverage']; ?> 
                    <span class="<?php echo $_SESSION['gradeStatus'] == 'Passed' ? 'text-success' : 'text-danger'; ?>">
                        (<?php echo $_SESSION['gradeStatus']; ?>)
                    </span>
                </p>
            </div>
        <?php endif; ?>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>