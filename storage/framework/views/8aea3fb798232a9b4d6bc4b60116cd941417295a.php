<div id="repay-lending-modal" class="modal-box">

  <div class="modal">
    <span class="close-modal"><i class="bi bi-x"></i></span>

    <h2>Splatenie pôžičky</h2>

    <form id="repay-lending-form">
      
        <div class="input-box">
            <div class="field">
                <input type="date" id="repay-lending-date">
                <label for="repay-lending-date">Dátum splatenia pôžičky</label>
            </div>
            <div class="error-box" id="repay-lending-date-errors"></div>
        </div>

      <button type="submit" data-csrf="<?php echo e(csrf_token()); ?>"  id="repay-lending-button">Označiť pôžičku za splatenú</button>
    </form>
  </div>

</div><?php /**PATH C:\Users\teodo\personalaccount\src\resources\views/finances/modals/repayment.blade.php ENDPATH**/ ?>