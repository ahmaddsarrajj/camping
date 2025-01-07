<!-- Back Button -->
<a href="javascript:history.back()" class="back-button">
    <span>&larr; Go Back</span>
</a>

<head>
    <style>
        .back-button {
    display: inline-flex;
    align-items: center;
    text-decoration: none;
    font-size: 16px;
    color: white;
    background-color: #ff8a00; /* Match your header */
    padding: 10px 20px;
    border-radius: 5px;
    transition: background-color 0.3s ease, color 0.3s ease;
    position: fixed; /* Keep it in a fixed position */
    top: 10px; /* Adjust as needed */
    left: 10px; /* Adjust as needed */
    z-index: 1000; /* Ensure it stays on top */
}

.back-button:hover {
    background-color: #555;
    color: #fff;
}

.back-button span {
    margin-left: 5px; /* Add spacing for the arrow */
}

    </style>
</head>


<script>
    const backButton = document.querySelector('.back-button');
backButton.addEventListener('click', () => {
    if (window.history.length > 1) {
        window.history.back();
    } else {
        window.location.href = './index.php'; // Fallback URL if no history
    }
});

</script>