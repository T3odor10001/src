<div id="create-user-modal" class="modal-box">

  <div class="modal">
    <span class="close-modal"><i class="bi bi-x"></i></span>

    <h2>Nový používateľ</h2>

    <form id="create-user-form">

      <div class="input-box">
        <div class="field">
          <input type="email" id="create-user-email">
            <label for="create-user-email">E-mailová adresa</label>
        </div>
        <div class="error-box" id="create-user-email-errors"></div>
      </div>
    
      <button type="submit" data-csrf="<?php echo e(csrf_token()); ?>" id="create-user-button">Vytvoriť</button>
    </form>
  </div>

</div><?php /**PATH C:\Users\teodo\personalaccount\src\resources\views/auth/modals/create_user.blade.php ENDPATH**/ ?>