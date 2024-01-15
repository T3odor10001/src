<div id="delete-operation-modal" class="modal-box">

  <div class="modal">
    <form id="delete-operation-form">
      <span class="close-modal"><i class="bi bi-x"></i></span>
      <p>Naozaj si želáte zmazať túto položku?</p>
      <div>
          <button class="proceed" data-csrf="<?php echo e(csrf_token()); ?>" type="submit" id="delete-operation-button">Áno</button>
          <button class="cancel" type="button">Nie</button>
      </div>
    </form>
  </div>

</div><?php /**PATH C:\Users\teodo\personalaccount\src\resources\views/finances/modals/delete_operation.blade.php ENDPATH**/ ?>