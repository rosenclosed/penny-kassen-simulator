// Module: buttonHandler.js
import { appendToNumberLine, handleNumpadOperations, toggleEingabeButton } from "./numpad.js";

export const buttonHandler = (pressedButton, pressedButtonId, pressedButtonContext) => {
    console.debug("Button Element:", pressedButton);
    console.debug("Button ID:", pressedButtonId);
    console.debug("Button Context:", pressedButtonContext);

    if (pressedButtonContext === "numpadButtons") {
        const numberMatch = pressedButtonId.match(/^numpad-(\d+)-btn$/);
        if (numberMatch) {
            console.debug("Appending Number to Line:", numberMatch[1]);
            appendToNumberLine(numberMatch[1]);
        } else {
            console.debug("Handling Numpad Operation for ID:", pressedButtonId);
            handleNumpadOperations(pressedButtonId);
        }
        toggleEingabeButton();
    }
};