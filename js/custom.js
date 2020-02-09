(function ($, Drupal) {
  Drupal.behaviors.jsPopupSimple = {
    attach: function (context, settings) {
      $("body").click(function (){
        $('.pop-up').once('popped').each(function (i, popupElement) {
          var myPopup = Drupal.dialog(popupElement);
          myPopup.showModal();
        });
      });
    }
  };
})(jQuery, Drupal);
