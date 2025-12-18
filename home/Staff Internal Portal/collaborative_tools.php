<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Collaborative Tools - Lifeline Medical Center</title>
    <link rel="stylesheet" href="collaborative_tools.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<style>
    body {
    font-family: 'Roboto', sans-serif;
    background-color: #f0f2f5;
    margin: 0;
}
header {
    background-color: #00796b;
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
    background-color: #004d40;
    border-radius: 5px;
}
.container {
    padding: 40px 20px;
}
h2 {
    color: #00796b;
    margin-bottom: 20px;
}
.chat-box, .document-upload, .task-list {
    background: white;
    border-radius: 10px;
    padding: 20px;
    margin-bottom: 30px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}
.chat-box p {
    margin: 10px 0;
}
.chat-box input, .document-upload input, .task-list input {
    padding: 10px;
    margin-top: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    width: calc(100% - 100px);
}
button {
    padding: 10px 20px;
    background-color: #00796b;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    margin-left: 10px;
}
button:hover {
    background-color: #004d40;
}
footer {
    background-color: #00796b;
    color: white;
    text-align: center;
    padding: 15px 0;
    margin-top: 40px;
}

</style>
<body>
    <header>
        <h1>Collaborative Tools</h1>
        <nav>
            <a href="index.html">Home</a>
            <a href="#team-chat">Team Chat</a>
            <a href="#document-sharing">Document Sharing</a>
            <a href="#task-assignments">Task Assignments</a>
        </nav>
    </header>

    <div class="container">
        <section id="team-chat">
            <h2>Team Chat</h2>
            <div class="chat-box">
                <p><strong>Dr. John:</strong> Please make sure to update me on patient 342 later today.</p>
                <p><strong>Nurse Alice:</strong> Will do, Dr. John. Also, I need to discuss something about today's surgery schedule.</p>
                <input type="text" placeholder="Type a message..." id="chat-input">
                <button onclick="sendMessage()">Send</button>
            </div>
        </section>

        <section id="document-sharing">
            <h2>Document Sharing</h2>
            <div class="document-upload">
                <p>Upload and share important documents with your team.</p>
                <input type="file" id="file-upload">
                <button onclick="uploadDocument()">Upload Document</button>
            </div>
        </section>

        <section id="task-assignments">
            <h2>Task Assignments</h2>
            <div class="task-list">
                <ul id="task-ul">
                    <li>Update the patient records by 4 PM</li>
                    <li>Prepare the surgery room for tomorrow</li>
                </ul>
                <input type="text" id="task-input" placeholder="Add new task...">
                <button onclick="addTask()">Add Task</button>
            </div>
        </section>
    </div>

    <footer>
        &copy; 2024 Lifeline Medical Center - All Rights Reserved
    </footer>

    <script>
        function sendMessage() {
            const input = document.getElementById('chat-input');
            if (input.value.trim() !== '') {
                alert('Message sent: ' + input.value);
                input.value = '';
            }
        }

        function uploadDocument() {
            const fileInput = document.getElementById('file-upload');
            if (fileInput.files.length > 0) {
                alert('Document "' + fileInput.files[0].name + '" uploaded successfully.');
                fileInput.value = '';
            }
        }

        function addTask() {
            const taskInput = document.getElementById('task-input');
            const taskList = document.getElementById('task-ul');
            if (taskInput.value.trim() !== '') {
                const newTask = document.createElement('li');
                newTask.textContent = taskInput.value;
                taskList.appendChild(newTask);
                taskInput.value = '';
            }
        }
    </script>
</body>
</html>
