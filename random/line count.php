<html>
    <title>Redirect</title>
    <body>
        <p>this will count lines in this page</p>
        <?php
        $file = basename($_SERVER['PHP_SELF']);

        $no_of_lines = count(file($file));

        echo '' .$no_of_lines. '';
        ?>
    </body>
</html>