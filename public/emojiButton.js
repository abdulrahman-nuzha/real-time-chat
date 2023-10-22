//Not Working Yet

import { EmojiButton } from "@joeattardi/emoji-button";
window.EmojiButton = new EmojiButton();

const emojiInput = document.getElementById("emoji-input");
const emojiButton = document.getElementById("emoji-button");
const emojiPicker = EmojiButton;

// Handle the click event on the emoji button
emojiButton.addEventListener("click", () => {
    emojiPicker.togglePicker(emojiButton);
});

// Handle emoji selection and insertion
emojiPicker.on("emoji", (selection) => {
    const emoji = selection.emoji;
    insertEmoji(emoji);
});

// Function to insert emoji into the input field
function insertEmoji(emoji) {
    const cursorPos = emojiInput.selectionStart;
    const inputValue = emojiInput.value;
    const newValue =
        inputValue.slice(0, cursorPos) + emoji + inputValue.slice(cursorPos);
    emojiInput.value = newValue;
    emojiInput.setSelectionRange(
        cursorPos + emoji.length,
        cursorPos + emoji.length
    );
    emojiInput.focus();
}
