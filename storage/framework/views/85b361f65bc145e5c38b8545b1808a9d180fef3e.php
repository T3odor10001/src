<div id="delete-account-modal" class="modal-box">

  <div class="modal">
    <span class="close-modal"><i class="bi bi-x"></i></span>
    <p>Naozaj si želáte zmazať tento účet?</p>
      <form id="delete-account-form">
        <div>
            <button class="proceed" type="submit" data-csrf="<?php echo e(csrf_token()); ?>"  id="delete-account-button">Áno</button>
            <button class="cancel" type="button">Nie</button>
        </div>
      </form>
  </div>

</div><?php /**PATH C:\Users\teodo\personalaccount\src\resources\views/finances/modals/delete_account.blade.php ENDPATH**/ ?>