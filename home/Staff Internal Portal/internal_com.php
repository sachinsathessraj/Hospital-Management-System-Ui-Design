<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Internal Communication - Lifeline Medical Center</title>
    <link rel="stylesheet" href="internal.css">
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
.announcement-card {
    background: white;
    border-radius: 10px;
    padding: 20px;
    margin-bottom: 20px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}
.chat-box {
    background: white;
    border-radius: 10px;
    padding: 20px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    margin-bottom: 30px;
}
.chat-messages {
    max-height: 200px;
    overflow-y: auto;
    margin-bottom: 10px;
    border-bottom: 1px solid #ccc;
    padding-bottom: 10px;
}
.message {
    margin-bottom: 10px;
}
.chat-input {
    display: flex;
}
.chat-input input[type="text"] {
    flex-grow: 1;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px 0 0 5px;
}
.chat-input button {
    padding: 10px;
    background-color: #0288d1;
    color: white;
    border: none;
    border-radius: 0 5px 5px 0;
    cursor: pointer;
}
.chat-input button:hover {
    background-color: #005ea1;
}
.direct-message {
    background: white;
    border-radius: 10px;
    padding: 20px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}
.direct-message textarea {
    width: calc(100% - 20px);
    padding: 10px;
    margin-top: 10px;
    height: 80px;
    border: 1px solid #ccc;
    border-radius: 5px;
}
.direct-message button {
    padding: 10px 20px;
    margin-top: 15px;
    background-color: #0288d1;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}
.direct-message button:hover {
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
        <h1>Internal Communication</h1>
        <nav>
            <a href="index.html">Home</a>
            <a href="#announcements">Announcements</a>
            <a href="#group-chat">Group Chat</a>
            <a href="#direct-messages">Direct Messaging</a>
        </nav>
    </header>

    <div class="container">
        <section id="announcements">
            <h2>Announcements</h2>
            <div class="announcement-card">
                <h3>Staff Meeting Scheduled</h3>
                <p>A general staff meeting will be held on <strong>Monday, October 10th</strong>, at 10 AM in the conference room. Attendance is required for all departments.</p>
            </div>
            <div class="announcement-card">
                <h3>Health and Safety Updates</h3>
                <p>Please review the updated health and safety guidelines posted on the intranet. These include new procedures for COVID-19 prevention.</p>
            </div>
        </section>

        <section id="group-chat">
            <h2>Group Chat</h2>
            <div class="chat-box">
                <div class="chat-messages">
                    <div class="message">
                        <strong>John Doe:</strong> Hello everyone, please remember to complete your training for the new software.
                    </div>
                    <div class="message">
                        <strong>Jane Smith:</strong> Thanks, John! I’ve already started mine.
                    </div>
                </div>
                <div class="chat-input">
                    <input type="text" id="chatMessage" placeholder="Type your message...">
                    <button onclick="sendMessage()">Send</button>
                </div>
            </div>
        </section>

        <section id="direct-messages">
            <h2>Direct Messaging</h2>
            <div class="direct-message">
                <label for="recipient">To:</label>
                <select id="recipient">
                    <option value="jane_smith">Jane Smith</option>
                    <option value="john_doe">John Doe</option>
                    <option value="alice_brown">Alice Brown</option>
                </select>
                <textarea id="messageContent" placeholder="Write your message..."></textarea>
                <button onclick="sendDirectMessage()">Send Message</button>
            </div>
        </section>
    </div>



    <script>
        function sendMessage() {
            const messageInput = document.getElementById("chatMessage");
            const message = messageInput.value.trim();
            if (message) {
                const chatMessages = document.querySelector(".chat-messages");
                const newMessage = document.createElement("div");
                newMessage.classList.add("message");
                newMessage.innerHTML = `<strong>You:</strong> ${message}`;
                chatMessages.appendChild(newMessage);
                messageInput.value = "";
            }
        }

        function sendDirectMessage() {
            const recipient = document.getElementById("recipient").value;
            const messageContent = document.getElementById("messageContent").value.trim();
            if (messageContent) {
                alert(`Message sent to ${recipient}: ${messageContent}`);
                document.getElementById("messageContent").value = "";
            }
        }
    </script>
</body>
</html>
