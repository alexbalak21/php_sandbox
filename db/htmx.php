<!DOCTYPE html>
<html>

<head>
    <title>HTMX + PHP Example</title>
    <script src="https://unpkg.com/htmx.org@1.9.5"></script>
</head>

<body>
    <h1>Welcome!</h1>
    <button hx-get="controller/message.php" hx-target="#message" hx-swap="innerHTML">
        Get Message
    </button>
    <div style="margin-top: 16px;" id="message"></div>
</body>

</html>

<script>
    async function fetchMessage() {
        try {
            const response = await fetch("controller/message.php");
            if (!response.ok) {
                throw new Error(`Server error: ${response.status}`);
            }

            const text = await response.text();
            document.getElementById("message").innerHTML = text;
        } catch (error) {
            document.getElementById("message").innerHTML =
                `<p style="color:red;">Error fetching data: ${error.message}</p>`;
        }
    }

    // Optional: add this to your button if you want to use JS instead of HTMX
    // <button onclick="fetchMessage()">Get Message</button>
</script>