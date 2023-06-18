// Assuming you have a "Modify" button with id "modifyButton" and a form with id "modifyForm"

// Add an event listener to the "Modify" button
document.getElementById("modifyButton").addEventListener("click", function() {
  // Retrieve the current data from the server
  fetch("/api/data") // Replace "/api/data" with your actual API endpoint
    .then(response => response.json())
    .then(data => {
      // Populate the form fields with the retrieved data
      document.getElementById("nameInput").value = data.name; // Replace "nameInput" with the actual input field ID for the name
      document.getElementById("emailInput").value = data.email; // Replace "emailInput" with the actual input field ID for the email
      // ...
      
      // Display the current image
      document.getElementById("currentImage").src = data.image; // Replace "currentImage" with the actual image element ID

      // Show the form with the current data
      document.getElementById("modifyForm").style.display = "block"; // Replace "modifyForm" with the actual form ID
    })
    .catch(error => {
      console.error("Error retrieving data:", error);
    });
});

// Example code for handling the form submission
document.getElementById("modifyForm").addEventListener("submit", function(event) {
  event.preventDefault(); // Prevent the default form submission

  // Get the modified data from the form
  const modifiedData = {
    name: document.getElementById("nameInput").value, // Replace "nameInput" with the actual input field ID for the name
    email: document.getElementById("emailInput").value, // Replace "emailInput" with the actual input field ID for the email
    // ...
    // Add additional form fields as needed
  };

  // Send the modified data to the server for update
  fetch("/api/update", {
    method: "POST",
    headers: {
      "Content-Type": "application/json"
    },
    body: JSON.stringify(modifiedData)
  })
  .then(response => response.json())
  .then(updatedData => {
    // Display the updated data on the website
    document.getElementById("currentImage").src = updatedData.image; // Replace "currentImage" with the actual image element ID
    // ...
    
    // Hide the form
    document.getElementById("modifyForm").style.display = "none"; // Replace "modifyForm" with the actual form ID
  })
  .catch(error => {
    console.error("Error updating data:", error);
  });
});
