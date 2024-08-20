<?php
include_once("./php/database.php");

// Query to fetch participant data
$sql = "SELECT * FROM registration";
$result = $conn->query($sql);

// Check if data exists
if ($result->num_rows > 0) {
    $participants = $result->fetch_all(MYSQLI_ASSOC);
} else {
    $participants = [];
}

// Close connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Review Committee</title>
    <link rel="stylesheet" href="./CSS/reviewcomitte.css" />
</head>
<body>
    <div id="button">
        <form action="">
            <button type="button" onclick="toggleTable()">Show Participants</button>
            <button type="button" onclick="qualifyDocx()">Qualify Docx</button>
            <button type="button" onclick="examResult()">Exam Result</button>
            <button type="button" onclick="interviewResult()">Interview Result</button>
        </form>
    </div>

    <!-- Table Data -->
    <div id="show_table" style="display:none;">
        <div class="data-table">
            <h2>Participant Details</h2>
            <table border="1">
                <thead>
                    <tr>
                        <th>First Name</th>
                        <th>Middle Name</th>
                        <th>Last Name</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>File</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($participants)): ?>
                        <?php foreach ($participants as $participant): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($participant['firstname']); ?></td>
                                <td><?php echo htmlspecialchars($participant['middlename']); ?></td>
                                <td><?php echo htmlspecialchars($participant['lastname']); ?></td>
                                <td><?php echo htmlspecialchars($participant['phone']); ?></td>
                                <td><?php echo htmlspecialchars($participant['email']); ?></td>
                                <td><?php echo htmlspecialchars($participant['file']); ?></td>
                                <td>
                                    <button onclick="showpdf('./php/upload/<?php echo htmlspecialchars($participant['file']); ?>')">View</button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7">No participants found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="post">
        <!-- Initially empty PDF viewer -->
        <embed id="pdf" src="" type="application/pdf" height="1000" width="1300" />
    </div>

    <script>
        function showpdf(value) {
            document.getElementById("pdf").src = value;
        }

        function toggleTable() {
            var tableDiv = document.getElementById('show_table');
            // Toggle visibility of the table
            if (tableDiv.style.display === "none") {
                tableDiv.style.display = "block";
            } else {
                tableDiv.style.display = "none";
            }
        }

        // Placeholder functions for other button actions
        function qualifyDocx() {
            alert("Qualify Docx functionality not implemented.");
        }

        function examResult() {
            alert("Exam Result functionality not implemented.");
        }

        function interviewResult() {
            alert("Interview Result functionality not implemented.");
        }
    </script>
</body>
</html>
