<html>
    <head>
        <title>Mostrar Ocultar</title>
        <script type="text/javascript" language="javascript" src="js/jquery-1.2.2.pack.js"></script>  
    </head>
    <body>
        <form>
            <script>
                $(document).ready(function () {
                    $("#demaior_idade").click(function (evento) {
                        if ($("#demaior_idade").attr("checked")) {
                            $("#formulariomaiores").css("display", "block");
                        } else {
                            $("#formulariomaiores").css("display", "none");
                        }
                    });
                });
            </script>
            Nome: <input type="text" name="nome">
            <br>
            <input type="checkbox" name="maior_idade" value="1" id="demaior_idade"> Sou maior de idade
            <br>
            <div id="formulariomaiores" style="display: none;">
                Dado para maiores de idade: <input type="text">
            </div>
        </form>

    </body>
</html> 

