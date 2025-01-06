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
};