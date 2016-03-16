<?php
/**
 * Copyright (c) 2016 Micorosft Corporation
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @author Aashay Zajriya <aashay@introp.net>
 * @license MIT
 * @copyright (C) 2016 onwards Microsoft Corporation (http://microsoft.com/)
 */

namespace microsoft\adalphp\samples\Demo;

use microsoft\adalphp\samples\Demo;

require(__DIR__.'/../../../vendor/autoload.php');

// Construct.
$dbFunc = new \microsoft\adalphp\samples\Demo\dbfunctions;

$result = $dbFunc->verifyUser($_POST['localemail'], $_POST['localpassword']);

if($result){
    // Output.
?>   

<html>
    <head>
        <?php include './header.php'; ?>
    </head>
    <body>
        <div class="container">
            <br />
            <h1>Welcome to the PHP Azure AD Demo</h1>
            <h2>Hello, <?php mysql_result($result,0,1) ?> <?php mysql_result($result,0,2) ?>. </h2>
            <h4>You have successfully authenticated with local account.</h4>
            <?php
                $resultAdUser = $dbFunc->verifyAdUser(mysql_result($result,0,0));

                if(mysql_num_rows($resultAdUser) > 0)  {
                ?> 
                    <table border="1" style="width:100%">
                        <tr>
                            <th>User Id</th>
                            <th>Access Token Response</th>
                            <th>Id Token Response</th>
                        </tr>
                        <?php 
                            while($row = mysql_fetch_array($resultAdUser)) {
                        ?>
                        <tr>
                          <td><?php $row['userId'] ?></td>
                          <td><?php $row['accessTokenResponse'] ?></td>
                          <td><?php $row['idTokenResponse'] ?></td>
                        </tr>
                    <?php 
                    }
                    ?>
                    </table>
             <?php
             }
            }
            ?> 
            <a class="btn btn-primary" href="index.php">Click here start again.</a>
        </div>
    </body>
</html>