// Module: eventListeners.js
import { buttonHandler } from "./buttonHandler.js";
import { globalVariables } from "./globalVariables.js";

export const initializeEventListeners = () => {
    $(document).ready(() => {
        console.debug("Document ready!");
        globalVariables.registerState = "home";
        console.debug("Register State:", globalVariables.registerState);
    });

    $(".penny-btn").on("touchend click", (event) => {
        event.preventDefault();
        const pressedButton = $(event.currentTarget);
        const pressedButtonId = pressedButton.attr("id");

        if (!pressedButtonId) {
            console.warn("Taste nicht belegt!");
            return;
        }

        console.debug("Pressed Button ID:", pressedButtonId);

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
                console.debug(`Matched Context: ${handler}`);
                buttonHandler(pressedButton, pressedButtonId, handler);
                return;
            }
        }

        console.error("Button does not belong to a known area.");
        buttonHandler(pressedButton, pressedButtonId, "unknown");
    });

    $("body").on("keydown", (event) => {
        const pressedKey = event.key;
        switch(pressedKey) {
            case "0":
                console.debug("0 pressed on keyboard");
                buttonHandler("numpad-" + pressedKey + "-btn", "numpad-" + pressedKey + "-btn", "numpadButtons");
                break;
            case "1":
                console.debug("1 pressed on keyboard");
                buttonHandler("numpad-" + pressedKey + "-btn", "numpad-" + pressedKey + "-btn", "numpadButtons");
                break;
            case "2":
                console.debug("2 pressed on keyboard");
                buttonHandler("numpad-" + pressedKey + "-btn", "numpad-" + pressedKey + "-btn", "numpadButtons");
                break;
            case "3":
                console.debug("3 pressed on keyboard");
                buttonHandler("numpad-" + pressedKey + "-btn", "numpad-" + pressedKey + "-btn", "numpadButtons");
                break;
            case "4":
                console.debug("4 pressed on keyboard");
                buttonHandler("numpad-" + pressedKey + "-btn", "numpad-" + pressedKey + "-btn", "numpadButtons");
                break;
            case "5":
                console.debug("5 pressed on keyboard");
                buttonHandler("numpad-" + pressedKey + "-btn", "numpad-" + pressedKey + "-btn", "numpadButtons");
                break;
            case "6":
                console.debug("6 pressed on keyboard");
                buttonHandler("numpad-" + pressedKey + "-btn", "numpad-" + pressedKey + "-btn", "numpadButtons");
                break;     
            case "7":
                console.debug("7 pressed on keyboard");
                buttonHandler("numpad-" + pressedKey + "-btn", "numpad-" + pressedKey + "-btn", "numpadButtons");
                break;
            case "8":
                console.debug("8 pressed on keyboard");
                buttonHandler("numpad-" + pressedKey + "-btn", "numpad-" + pressedKey + "-btn", "numpadButtons");
                break;
            case "9":
                console.debug("9 pressed on keyboard");
                buttonHandler("numpad-" + pressedKey + "-btn", "numpad-" + pressedKey + "-btn", "numpadButtons");
                break;
            case "Enter":
                console.debug("Enter pressed on keyboard");
                buttonHandler("numpad-eingabe-btn", "numpad-eingabe-btn", "numpadButtons");
                break;
            case "Backspace":
                console.debug("Backspace pressed on keyboard");
                buttonHandler("numpad-back-btn", "numpad-back-btn", "numpadButtons");
                break;
            case "Delete":
                console.debug("Delete pressed on keyboard");
                buttonHandler("numpad-delete-btn", "numpad-delete-btn", "numpadButtons");
                break;
            default:
                console.debug("irrelevant Key pressed on keyboard");
                break;
                                                                                                               
        }
    });
};