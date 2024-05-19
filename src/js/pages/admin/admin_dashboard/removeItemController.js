const BTNS_REMOVE = document.querySelectorAll(".btn_remove");
const REMOVE_DIALOG = document.getElementById("remove_item-dialog");
const DIALOG_BTN_CANCEL = document.getElementById("btnCancel");
const DIALOG_BTN_CONFIRM = document.getElementById("btnRemove");

BTNS_REMOVE.forEach(btn => {
   btn.addEventListener('click', () => {
      REMOVE_DIALOG.showModal();

      let titleDisplay = REMOVE_DIALOG.querySelector(".item-title");
      titleDisplay.innerHTML = btn.dataset.itemName;

      let itemId = btn.dataset.item;
      DIALOG_BTN_CONFIRM.addEventListener('click', () => {
         location.href = './misc/removeItem.php?id=' + itemId;
      });
   });
});

DIALOG_BTN_CANCEL.addEventListener('click', () => {
   REMOVE_DIALOG.close();
});