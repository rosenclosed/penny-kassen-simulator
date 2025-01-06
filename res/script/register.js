// Define all globally important elements
// These are the elements in the DOM that are frequently accessed and manipulated
// by the code.
const numberLine = $("#numpad-number-line"); // The number display for numpad inputs
const bigInfoLine1Front = $("#big-info-area-line1-text1"); // Front part of the upper red info line
const bigInfoLine1Back = $("#big-info-area-line1-text2"); // Back part of the upper red info line
const bigInfoLine2Front = $("#big-info-area-line2-text1"); // Front part of the lower red info line
const bigInfoLine2Back = $("#big-info-area-line2-text2"); // Back part of the lower red info line

// Define all important global variables
// These variables track the current state and temporary data for the register
let registerState; // Stores the current state of the register (e.g., home, sum)
let lastEnteredNumber; // Keeps track of the last entered number for re-entry purposes
let isMengeActive = false; // Tracks if the 'Menge' (quantity) button is active
let isKisteActive = false; // Tracks if the 'Kiste' (crate) button is active
let currentMengeMultiplicator; // Stores the current multiplier for 'Menge' operations

// Initialize the register state when the document is fully loaded
$(document).ready(() => {
    console.debug("Document ready!"); // Debugging message to confirm the document is loaded
    registerState = "home"; // Set the initial state of the register to "home"
    console.debug("Register State:", registerState); // Log the initial state for debugging
});

// Attach event listeners to all buttons with the class "penny-btn"
// This ensures all button presses are handled centrally
$(".penny-btn").on("touchend click", (event) => {
    event.preventDefault(); // Prevent duplicate events (e.g., from touch and click)

    const pressedButton = $(event.currentTarget); // Get the button that was pressed
    const pressedButtonId = pressedButton.attr("id"); // Get the ID of the pressed button

    // If the button has no ID, log a warning and return early
    if (!pressedButtonId) {
        console.warn("Taste nicht belegt!"); // "Button not assigned!"
        return;
    }

    // Determine the button's context based on its ID prefix and call the appropriate handler
    const contexts = [
        { prefix: "numpad-", handler: "numpadButtons" },
        { prefix: "op-home-", handler: "operatorHomeButtons" },
        { prefix: "op-sum-", handler: "operatorSumButtons" },
        { prefix: "mod-", handler: "modalButtons" },
        { prefix: "info-", handler: "smallInfoButtons" },
        { prefix: "digital-receipt-", handler: "digitalReceiptButtons" }
    ];

    for (const { prefix, handler } of contexts) {
        if (pressedButtonId.startsWith(prefix)) {
            buttonHandler(pressedButton, pressedButtonId, handler);
            return;
        }
    }

    // Log an error if the button's ID doesn't match any known prefix
    console.error("Button does not belong to a known area.");
    buttonHandler(pressedButton, pressedButtonId, "unknown");
});

// Centralized button handler function
// Calls specific handlers based on the button context
const buttonHandler = (pressedButton, pressedButtonId, pressedButtonContext) => {
    console.debug("Button Element:", pressedButton); // Log the button element
    console.debug("Button ID:", pressedButtonId); // Log the button's ID
    console.debug("Button Context:", pressedButtonContext); // Log the button's context

    // Handle buttons in the numpad context
    if (pressedButtonContext === "numpadButtons") {
        const numberMatch = pressedButtonId.match(/^numpad-(\d+)-btn$/); // Match numeric buttons
        if (numberMatch) {
            appendToNumberLine(numberMatch[1]); // Append the number to the number line
        } else {
            handleNumpadOperations(pressedButtonId); // Handle special numpad operations
        }
        toggleEingabeButton(); // Update the state of the "EINGABE" button
    }
};

// Append a number to the number line
// Ensures the input does not exceed the maximum length
const appendToNumberLine = (number) => {
    const currentText = numberLine.text(); // Get the current text in the number line
    if (currentText.length < 16) { // Limit input length to 16 characters
        numberLine.text(currentText + number); // Append the new number
    } else {
        console.warn("Eingabe zu lang!"); // "Input too long!"
        numberLine.text(""); // Clear the input if it exceeds the limit
    }
};

// Toggle the state of the "EINGABE" button
// Disables the button if the number line is empty
const toggleEingabeButton = () => {
    const isEmpty = numberLine.text() === ""; // Check if the number line is empty
    $("#numpad-eingabe-btn").toggleClass("disabled", isEmpty); // Toggle the disabled class
};

// Handle operations for numpad buttons other than numeric input
const handleNumpadOperations = (buttonId) => {
    const operations = {
        "numpad-back-btn": () => {
            console.debug("Backspace Operation triggered");
            numberLine.text(numberLine.text().slice(0, -1)); // Remove the last character
        },
        "numpad-delete-btn": () => {
            console.debug("Delete Operation triggered");
            numberLine.text(""); // Clear the number line
            if (isMengeActive) {
                cancelMengeOperation(); // Cancel the Menge operation if active
            }
        },
        "numpad-eingabe-btn": eingabeHandler, // Handle the "EINGABE" operation
        "numpad-menge-btn": () => handleMengeOperation(numberLine.text()) // Handle Menge input
    };

    // Call the operation if it exists in the map
    operations[buttonId]?.();
};

// Cancel an active Menge operation
// Resets related variables and UI elements
const cancelMengeOperation = () => {
    isMengeActive = false; // Deactivate Menge
    bigInfoLine1Front.text(""); // Clear the big info line
    currentMengeMultiplicator = ""; // Reset the multiplier
    console.warn("Mengen-Operation abgebrochen!"); // "Quantity operation canceled!"
};

// Finish an active Menge operation
// Resets related variables and UI elements
const finishMengeOperation = () => {
    isMengeActive = false; // Deactivate Menge
    bigInfoLine1Front.text(""); // Clear the big info line
    currentMengeMultiplicator = ""; // Reset the multiplier
    console.warn("Mengen-Operation beendet!"); // "Quantity operation finished!"
};

// Handle the "EINGABE" button press
const eingabeHandler = () => {
    console.debug("Eingabe Operation triggered"); // Log the operation
    pushNumpadEntry(numberLine.text()); // Process the current number line input
    numberLine.text(""); // Clear the number line
};

// Process the numpad entry
// Validates the input and sends it to the backend if valid
const pushNumpadEntry = (numpadEntry) => {
    console.debug("Numpad Entry:", numpadEntry); // Log the entered number

    if (isMengeActive) {
        console.debug(`Now entered ${currentMengeMultiplicator}x Item No. ${numpadEntry}`);
        finishMengeOperation(); // Complete the Menge operation
    }

    const { isValid, type } = validateEAN(numpadEntry); // Validate the input
    if (isValid) {
        console.log(`Valid ${type} detected: ${numpadEntry}`); // Log the valid input
        queryBackend(numpadEntry, type); // Simulate a backend query
    } else {
        displayError(`Invalid EAN entered: ${numpadEntry}`); // Show an error for invalid input
    }
};

// Display an error message to the user
const displayError = (message) => {
    $("body").append(`<div class="error">${message}</div>`); // Add the error message to the DOM
    $(".error").fadeOut(3000, () => $(this).remove()); // Remove the message after 3 seconds
};

// Simulate a backend query
// Placeholder function for future AJAX calls
const queryBackend = (ean, eanType) => {
    console.log(`Querying backend for ${eanType} with EAN: ${ean}`); // Log the query
    // Replace with actual AJAX logic
    $.ajax({
        url: "/backend/test.php",
        method: "GET",
        data: { ean, eanType },
        success: (response) => {
            console.log("Backend response:", response);
        },
        error: (xhr, status, error) => {
            console.error("Backend query failed:", error);
        }
    });
};

// Validate an EAN (European Article Number)
// Checks if the input is valid and determines its type (EAN-8 or EAN-13)
const validateEAN = (ean) => {
    if (!/^\d+$/.test(ean)) return { isValid: false, type: null }; // Ensure input is numeric

    const length = ean.length; // Get the length of the EAN
    if (![8, 13].includes(length)) return { isValid: false, type: null }; // Check for valid lengths

    // Calculate the checksum for validation
    const checksum = Array.from(ean)
        .slice(0, -1)
        .reduce((sum, char, i) => sum + parseInt(char, 10) * (length === 13 ? (i % 2 === 0 ? 1 : 3) : (i % 2 === 0 ? 3 : 1)), 0);

    return {
        isValid: (10 - (checksum % 10)) % 10 === parseInt(ean[length - 1], 10), // Validate the checksum
        type: length === 13 ? "ean13" : "ean8" // Determine the type
    };
};

// Handle a Menge (quantity) operation
// Validates and processes the input amount
const handleMengeOperation = (amount) => {
    if (isMengeActive) {
        console.warn("Menge already active!"); // Log a warning if already active
        return;
    }
    if (Number(amount) >= 100) {
        console.warn("Menge zu groß!"); // "Quantity too large!"
        numberLine.text(""); // Clear the input
    } else if (Number(amount) > 0) {
        isMengeActive = true; // Activate Menge
        currentMengeMultiplicator = amount; // Set the multiplier
        console.debug("Multiplicator is now:", amount); // Log the multiplier
        bigInfoLine1Front.text(`MENGE:\t\t${amount}`); // Update the info line
        numberLine.text(""); // Clear the number line
    } else {
        console.warn("Menge kleiner/gleich 0!"); // "Quantity less than or equal to 0!"
        numberLine.text(""); // Clear the input
    }
};
