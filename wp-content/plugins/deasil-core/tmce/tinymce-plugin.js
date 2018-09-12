(function($){

  tinymce.PluginManager.add('pre_code_button', function( ed, url ) {

    ed.addButton( 'pre_code_button', {
      title: shortcode.addShortcode,
      icon: false,
      image: iconfont.pluginsUrl + 'img/image.png',
      cmd: 'moldPopup'
    });

    /*initial Popup*/
    ed.addCommand("moldPopup", function ( a, params )
    {
      var url = iconfont.pluginsUrl + "tmce/shortcode_list.php";
      /*call thickbox*/
      tb_show(shortcode.addShortcode, url);
    });


  });


  $(document).ready(function() {

    /*on insert click*/
    $('body').on('click', '#insert-shortcode-button', function(e){
      // e.stopPropagation();
      // e.preventDefault();

      var btn_label = $('#btn-label').val();
      var btn_url = $('#btn-url').val();
      var btn_target = $('#btn-target').val();
      var btn_size = $('#btn-size').val();
      var btn_color = $('#btn-color').val();

      if(window.tinyMCE)
      { 
        window.tinyMCE.activeEditor.execCommand('mceInsertContent', false, 
          '[deasil_vc_button label="'+btn_label+'" url="'+btn_url+'" target="'+btn_target+'" size="'+btn_size+'" color="'+btn_color+'"]'
          );
        tb_remove();
      }
      $('#TB_window').remove();
    });

     $('body').on('click', '#insert-shortcode-infobox', function(e){

      var infobox_title = $('#infobox-title').val();
      var infobox_bg_color = $('#infobox-bg-color').val();
      var infobox_text_color = $('#infobox-text-color').val();
      var infobox_css_class = $('#infobox-css-class').val();

      if(window.tinyMCE)
      { 
        window.tinyMCE.activeEditor.execCommand('mceInsertContent', false, 
          '[deasil_vc_infobox title="'+infobox_title+'" type="'+infobox_bg_color+'" color="'+infobox_text_color+'" cssclass="'+infobox_css_class+'"] Add info content here [/deasil_vc_infobox]'
          );
        tb_remove();
      }
      $('#TB_window').remove();
    });
    
  });

})(jQuery);