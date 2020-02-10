(function ($, Drupal) {
  Drupal.behaviors.jsPopupSimple = {
    attach: function (context, settings) {
      // Check exist class.
      if ($(".pop-up")[0]){
        $(".field--name-field-url-video").hide();
        $(".field--name-field-img img").css("cursor", "pointer");
        $(".field--name-field-img").click(function (){
          $(".pop-up").once("popped").each(function (i, popupElement) {
            var myPopup = Drupal.dialog(popupElement, {width: "auto"});
            myPopup.showModal();
          });
        });
      } else if ($(".default-video")[0]) {
        $(".field--name-field-img").hide();
      }
    }
  };
})(jQuery, Drupal);
