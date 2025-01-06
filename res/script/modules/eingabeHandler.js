// Module: eingabeHandler.js
import { domElements } from "./domElements.js";
import { pushNumpadEntry } from "./numpadEntry.js";

export const eingabeHandler = () => {
    console.debug("Eingabe Operation triggered");
    pushNumpadEntry(domElements.numberLine.text());
    domElements.numberLine.text("");
};