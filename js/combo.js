function montaComboSubCate(idsubcate) {
                $.ajax (
                {
                    type: "POST",
                    url:"comboSubcategoria.php",
                    data: "id_categoria="+idsubcate,

                    beforeSend: function() {
                        //$('#status').html("carregando!");
                    },
                    success: function (txt) {

                        $('#ajax_subcategoria').html(txt);
                    },
                    error: function(txt) {
                        alert('erro.');
                    }
                }
            );

            }