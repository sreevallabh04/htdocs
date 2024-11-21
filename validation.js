function validateForm() {
    const errors = [];
    const title = document.getElementById("title").value.trim();
    const author = document.getElementById("author").value.trim();
    const price = document.getElementById("price").value.trim();
    const quantity = document.getElementById("quantity").value.trim();
    const errorList = document.getElementById("errorList");

    // Clear previous errors
    errorList.innerHTML = "";

    // Validate Title
    if (!title) {
        errors.push("Book title is required.");
    }

    // Validate Author
    if (!author) {
        errors.push("Author name is required.");
    }

    // Validate Price
    if (!price || isNaN(price) || parseFloat(price) <= 0) {
        errors.push("Price must be a valid number greater than 0.");
    }

    // Validate Quantity
    if (!quantity || isNaN(quantity) || parseInt(quantity) <= 0) {
        errors.push("Quantity must be a valid number greater than 0.");
    }

    // Display Errors
    if (errors.length > 0) {
        errors.forEach(error => {
            const li = document.createElement("li");
            li.textContent = error;
            errorList.appendChild(li);
        });
        return false; // Prevent form submission
    }

    alert("Form is valid. Submitting...");
    return true; // Allow form submission
}
