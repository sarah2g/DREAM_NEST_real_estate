
let slideIndex = 1;
showSlides(slideIndex);

// Function to increment or decrement the slide index
function plusSlides(n) {
  showSlides(slideIndex += n);
}

// Function to set the current slide index
function currentSlide(n) {
  showSlides(slideIndex = n);
}

// Function to display the slides
function showSlides(n) {
  // Initialize variables
let i; // Counter variable
let slides = document.getElementsByClassName("mySlides"); // Get elements with class "mySlides" (presumed to be image slides)
let dots = document.getElementsByClassName("demo"); // Get elements with class "demo" (presumed to be slide navigation dots)
let captionText = document.getElementById("caption"); // Get element with ID "caption" (presumed to be a caption for the slides)

// Check if the provided slide index (n) is greater than the total number of slides
if (n > slides.length) {
  slideIndex = 1; // If so, set slideIndex to the first slide
}

// Check if the provided slide index (n) is less than 1
if (n < 1) {
  slideIndex = slides.length; // If so, set slideIndex to the last slide
}

// Hide all slides
for (i = 0; i < slides.length; i++) {
  slides[i].style.display = "none";
}

// Remove "active" class from all dots
for (i = 0; i < dots.length; i++) {
  dots[i].className = dots[i].className.replace(" active", "");
}

// Display the current slide
slides[slideIndex - 1].style.display = "block";

// Add "active" class to the dot corresponding to the current slide
dots[slideIndex - 1].className += " active";

// Set the caption text to the alt text of the current slide's dot (if a caption element exists)
if (captionText) {
  captionText.innerHTML = dots[slideIndex - 1].alt;
}
}
 // Declare an empty array to store favorite properties
const favoritesList = [];

// Function to add a property to the favorites list
function addToFavorites(name, type, price) {
    // Create an object with property details
    const propertyDetails = { name, type, price };

    // Check if the property is not already in the favorites list
    if (!isPropertyInFavorites(propertyDetails)) {
        // Add the property to the favorites list
        favoritesList.push(propertyDetails);
        // Update the display of the favorites list
        updateFavoritesList();
    } else {
        // Display an alert if the property is already in the favorites list
        alert("This property is already in your favorites list.");
    }
}

// Function to remove a property from the favorites list
function removeFromFavorites(property) {
    // Find the index of the property in the favorites list
    const index = favoritesList.findIndex(item => arePropertiesEqual(item, property));
    
    // Check if the property was found in the favorites list
    if (index !== -1) {
        // Remove the property from the favorites list
        favoritesList.splice(index, 1);
        // Update the display of the favorites list
        updateFavoritesList();
    }
}
// Function to clear the favorites list
function clearFavorites() {
    // Set the length of the favoritesList array to 0, effectively clearing it
    favoritesList.length = 0;
    // Call the updateFavoritesList function to reflect the changes in the UI
    updateFavoritesList();
}

// Function to update the favorites list in the UI
function updateFavoritesList() {
    // Get the HTML element with the ID 'favorites-list'
    const favoritesListElement = document.getElementById('favorites-list');
    // Clear the inner HTML of the favorites list element
    favoritesListElement.innerHTML = '';

    // Iterate through each property in the favoritesList array
    favoritesList.forEach(property => {
        // Create a new list item element
        const listItem = document.createElement('li');
        // Set the text content of the list item with property details
        listItem.textContent = `${property.name} - ${property.type} - ${property.price}`;
        // Set the 'onclick' attribute to call the removeFromFavorites function with the property as an argument
        listItem.setAttribute('onclick', `removeFromFavorites(${JSON.stringify(property)})`);
        // Append the list item to the favorites list element
        favoritesListElement.appendChild(listItem);
    });
}

// Function to check if a property is already in the favorites list
function isPropertyInFavorites(property) {
    // Use the some method to check if there is any item in favoritesList equal to the given property
    return favoritesList.some(item => arePropertiesEqual(item, property));
}

// Function to check if two properties are equal
function arePropertiesEqual(property1, property2) {
    // Compare name, type, and price of two properties
    return (
        property1.name === property2.name &&
        property1.type === property2.type &&
        property1.price === property2.price
    );
}
// Function to update the favorites list on the search page
function updateFavoritesListSearchPage() {
    // Get the favorites list element on the search page
    const favoritesListElement = document.getElementById('favorites-list-search');
    // Clear the existing content of the favorites list
    favoritesListElement.innerHTML = '';

    // Iterate through each property in the favorites list
    favoritesList.forEach(property => {
        // Create a list item element for each property
        const listItem = document.createElement('li');
        // Set the text content of the list item with property details
        listItem.textContent = `${property.name} - ${property.type} - ${property.price}`;
        // Set an onclick attribute to call the removeFromFavorites function with the property as an argument
        listItem.setAttribute('onclick', `removeFromFavorites(${JSON.stringify(property)})`);
        // Append the list item to the favorites list on the search page
        favoritesListElement.appendChild(listItem);
    });
}

// Function to update the main favorites list
function updateFavoritesList() {
    // Get the main favorites list element
    const favoritesListElement = document.getElementById('favorites-list');
    // Clear the existing content of the main favorites list
    favoritesListElement.innerHTML = '';

    // Iterate through each property in the favorites list
    favoritesList.forEach(property => {
        // Create a list item element for each property
        const listItem = document.createElement('li');
        // Set the text content of the list item with property details
        listItem.textContent = `${property.name} - ${property.type} - ${property.price}`;
        // Set an onclick attribute to call the removeFromFavorites function with the property as an argument
        listItem.setAttribute('onclick', `removeFromFavorites(${JSON.stringify(property)})`);
        // Append the list item to the main favorites list
        favoritesListElement.appendChild(listItem);
    });

    // Update the favorites list on the search page
    updateFavoritesListSearchPage();
}


 