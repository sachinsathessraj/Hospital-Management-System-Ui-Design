<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Work Schedules & Policies - Lifeline Medical Center</title>
    <link rel="stylesheet" href="work_schedules.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<style>body {
    font-family: 'Roboto', sans-serif;
    background-color: #f0f2f5;
    margin: 0;
}
header {
    background-color: #0288d1;
    color: white;
    padding: 20px;
    text-align: center;
    font-size: 1.8em;
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
}
nav {
    margin-top: 10px;
}
nav a {
    color: white;
    text-decoration: none;
    padding: 10px;
    font-weight: bold;
    transition: background 0.3s ease;
}
nav a:hover {
    background-color: #005ea1;
    border-radius: 5px;
}
.container {
    padding: 40px 20px;
}
h2 {
    color: #0288d1;
    margin-bottom: 20px;
}
.schedule-card, .policy-card {
    background: white;
    border-radius: 10px;
    padding: 20px;
    margin-bottom: 30px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}
table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 20px;
}
thead {
    background-color: #0288d1;
    color: white;
}
th, td {
    padding: 10px;
    text-align: left;
    border-bottom: 1px solid #ccc;
}
button {
    padding: 10px 20px;
    background-color: #0288d1;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}
button:hover {
    background-color: #005ea1;
}
footer {
    background-color: #0288d1;
    color: white;
    text-align: center;
    padding: 15px 0;
    margin-top: 40px;
}
</style>
<body>
    <header>
        <h1>Work Schedules & Policies</h1>
        <nav>
            <a href="index.html">Home</a>
            <a href="#work-schedules">Work Schedules</a>
            <a href="#hospital-policies">Hospital Policies</a>
        </nav>
    </header>

    <div class="container">
        <section id="work-schedules">
            <h2>Work Schedules</h2>
            <div class="schedule-card">
                <h3>Staff Work Schedule</h3>
                <table>
                    <thead>
                        <tr>
                            <th>Staff Member</th>
                            <th>Role</th>
                            <th>Shift Date</th>
                            <th>Shift Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Jane Smith</td>
                            <td>Nurse</td>
                            <td>Monday, October 9th</td>
                            <td>08:00 AM - 04:00 PM</td>
                        </tr>
                        <tr>
                            <td>John Doe</td>
                            <td>Doctor</td>
                            <td>Monday, October 9th</td>
                            <td>10:00 AM - 06:00 PM</td>
                        </tr>
                        <tr>
                            <td>Alice Brown</td>
                            <td>Surgeon</td>
                            <td>Tuesday, October 10th</td>
                            <td>12:00 PM - 08:00 PM</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>

        <section id="hospital-policies">
            <h2>Hospital Policies</h2>
            <div class="policy-card">
                <h3>Health & Safety Guidelines</h3>
                <p>Please follow the latest health and safety guidelines. Make sure to wear your protective gear and sanitize frequently.</p>
                
            </div>
            <div class="policy-card">
                <h3>Attendance Policy</h3>
                <p>All staff are expected to follow the attendance policy, including notifying the administration in case of emergency absences.</p>
                
            </div>
        </section>
    </div>

    <footer>
        &copy; 2024 Lifeline Medical Center - All Rights Reserved
    </footer>

    <script>
        function viewPolicyDetails(policyName) {
            alert('You are viewing details for: ' + policyName);
        }
    </script>
</body>
</html>
